<html>
	<body>
		<h3><strong><font color= '#66CC00'>Confirm Registration</font></strong></h3>
		<hr/>
		<?php
			/* Check if all fields were filled */
			if(empty($_REQUEST['newName']) or empty($_REQUEST['newBirthday']) or empty($_REQUEST['newAddress']))
			{
				echo("<p>Missing information needed. Please fill all fields in the form.</p>");
				echo("<p>Turn to the <a href=\"getNewPatient.php\">previous page</a></p>");
			}
			else if($_REQUEST['newBirthday'] > date("Y-m-d"))
			{
				echo("<p>Please enter a valid birthday date</p>");
				echo("<p>Turn to the <a href=\"getNewPatient.php\">previous page</a></p>");
			}
			else
			{
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

				$sql = "SELECT patient_number FROM Patient";
				$result = $connection->query($sql);

				if($result == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				/* Assign the next number, of the last one that exists, to the new patient */
				$patient_number = "P-" . (($result->rowCount())+1);

				$name = $_REQUEST['newName'];
				$birthday = $_REQUEST['newBirthday'];
				$address = $_REQUEST['newAddress'];

				$stmt = $connection->prepare("INSERT INTO Patient VALUES (:patient_number, :name, :birthday, :address)");
				$stmt->bindParam(':patient_number', $patient_number);
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':birthday', $birthday);
				$stmt->bindParam(':address', $address);

				$stmt->execute();

				if($stmt == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				echo("<p>Patient registered!</p>");
				echo("<p><a href=\"getPatient.php\">Search for another patient</a></p>");
			}

			$connection = null;
		?>
	</body>
</html>