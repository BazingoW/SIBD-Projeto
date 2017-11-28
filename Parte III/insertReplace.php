<?php session_start(); ?>
<html>
	<body>
		<h3><strong><font color= '#66CC00'>Replacement Confirmation</font></strong></h3>
		<hr/>
		<?php
		/* Protects against going direclty to this web page */
		if(isset($_SESSION['patient_number']) && isset($_SESSION['serialnum']) && isset($_SESSION['manufacturer']) && isset($_SESSION['start_date']) && isset($_SESSION['end_date']))
		{
			/* Connects to database */
			require 'connectDB.php';

			/* Begins transaction */
			$connection->beginTransaction();

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
				$connection->rollback();
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}

			$newPeriodExists = 0; /* To check if the period of the new current device exists */
			$updatePeriodExists = 0; /* To check if the period of the replaced device exists */

			foreach($result as $row)
			{
				if($currentTimeDate == $row['start_date'] && $oldEndDate == $row['end_date'])
				{
					$newPeriodExists = 1;
				}
			}

			if($newPeriodExists == 0)
			{
				$stmt = $connection->prepare("INSERT INTO Period VALUES (:start_date, :end_date)");
				$stmt->bindParam(':start_date', $currentTimeDate);
				$stmt->bindParam(':end_date', $oldEndDate);
				$stmt->execute();

				if($stmt == FALSE)
				{
					$connection->rollback();
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}
			}
			
			foreach($result as $row)
			{
				if($oldStartDate == $row['start_date'] && $currentTimeDate = $row['end_date'])
				{
					$updatePeriodExists = 1;
				}
			}

			if($updatePeriodExists == 0)
			{
				$stmt = $connection->prepare("INSERT INTO Period VALUES (:start_date, :end_date)");
				$stmt->bindParam(':start_date', $oldStartDate);
				$stmt->bindParam(':end_date', $currentTimeDate);
				$stmt->execute();

				if($stmt == FALSE)
				{
					$connection->rollback();
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}
			}

			/* Updates the end date of the replaced device to the current date */
			$stmt = $connection->prepare("UPDATE Wears SET start_date = :oldStartDate, end_date = :currentTimeDate WHERE patient_number = :patient_number AND start_date = :oldStartDate AND end_date = :oldEndDate");
			$stmt->bindParam(':currentTimeDate', $currentTimeDate);
			$stmt->bindParam(':patient_number', $patient_number);
			$stmt->bindParam(':oldStartDate', $oldStartDate);
			$stmt->bindParam(':oldEndDate', $oldEndDate);
			$stmt->bindParam(':serialnum', $oldSerialNum);
			$stmt->execute();

			if($stmt == FALSE)
			{
				$connection->rollback();
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}

			$newDevice = $_REQUEST['serialnum'];

			$stmt = $connection->prepare("INSERT INTO Wears VALUES (:start_date, :end_date, :patient_number, :serialnum, :manufacturer)");
			$stmt->bindParam(':start_date', $currentTimeDate);
			$stmt->bindParam(':end_date', $oldEndDate);
			$stmt->bindParam(':patient_number', $patient_number);
			$stmt->bindParam(':serialnum', $newDevice);
			$stmt->bindParam(':manufacturer', $oldManufacturer);

			$stmt->execute();

			if($stmt == FALSE)
			{
				$connection->rollback();
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}

			$connection->commit();

			echo("<p>Device was replaced!</p>");
			echo("<p>Turn to the <a href=\"homePage.php\">Home page</a></p>");

			$connection = null;
		}
		else
		{
			echo("<p>No patient was searched</p>");
			echo("<p><a href=\"getPatient.php\">Search for a patient</a></p>");
		}
		?>
	</body>
</html>