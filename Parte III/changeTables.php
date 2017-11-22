<?php session_start(); ?>
<html>
	<body>
		<?php
			$host = "db.tecnico.ulisboa.pt";
			$user = "ist181731";
			$pass = "ahcu2726";
			$dsn = "mysql:host=$host;dbname=$user";
			try
			{
				$connection = new PDO($dsn, $user, $pass);
			}
			catch(PDOException $exception)
			{
				echo("<p> Error: ");
				echo($exception->getMessage());
				echo("</p>");
				exit();
			}

			$patient_number = $_SESSION['patient_number'];
			$oldSerialNum = $_SESSION['serialnum'];
			$oldManufacturer = $_SESSION['manufacturer'];
			$oldStartDate = $_SESSION['start_date'];
			$oldEndDate = $_SESSION['end_date'];

			$currentTimeDate = date("Y-m-d H:i:s");

			$sql = "SELECT * FROM Period";
			$result = $connection->query($sql);

			if($result == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}

			$periodExists = 0; /* To check if the period of the new device exists */

			foreach($result as $row)
			{
				/* Confirms if the new period already exists in Database */
				if($currentTimeDate == $row['start_date'] && $oldEndDate == $row['end_date'])
				{
					$replacePeriodExists = 1;
				}
			}

			if($periodExists == 0)
			{
				$stmt = $connection->prepare("INSERT INTO Period VALUES (:start_date, :end_date)");
				$stmt->bindParam(':start_date', $currentTimeDate);
				$stmt->bindParam(':end_date', $oldEndDate);
				$stmt->execute();

				if($stmt == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}
			}


			/*$sql = "UPDATE Period" . "SET end_date = :currentTimeDate" . "WHERE start_date = :oldStartDate AND end_date = :oldEndDate":
			$stmt = $connection->prepare($sql);
			$stmt->bindParam(':currentTimeDate', $currentTimeDate);
			$stmt->bindParam(':oldStartDate', $oldStartDate);
			$stmt->bindParam(':oldEndDate', $oldEndDate);
			$stmt->execute();

			if($stmt == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}*/


			/* Updates the date of the replaced device to the current date */
			$sql = "UPDATE Wears SET end_date = :currentTimeDate WHERE patient_number = :patient_number AND start_date = :oldStartDate AND end_date = :oldEndDate";
			$stmt = $connection->prepare($sql);
			$stmt->bindParam(':currentTimeDate', $currentTimeDate);
			$stmt->bindParam(':patient_number', $patient_number);
			$stmt->bindParam(':oldStartDate', $oldStartDate);
			$stmt->bindParam(':oldEndDate', $oldEndDate);
			$stmt->execute();

			if($stmt == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}

			/*$newDevice = $_REQUEST['serialnum'];

			$stmt = $connection->prepare("INSERT INTO Wears VALUES (:start_date, :end_date, :patient_number, :serialnum, :manufacturer)");
			$stmt->bindParam(':start_date', $currentTimeDate);
			$stmt->bindParam(':end_date', $oldEndDate);
			$stmt->bindParam(':patient_number', $patient_number);
			$stmt->bindParam(':serialnum', $newDevice);
			$stmt->bindParam(':manufacturer', $oldManufacturer);

			$stmt->execute();

			if($stmt == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}*/

			echo("<p>Device was replaced!</p>");
			echo("<p><a href=\"getPatient.php\">Search for another patient</a></p>");

			$connection = null;
		?>
	</body>
</html>