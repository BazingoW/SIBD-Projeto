<html>
	<body>
		<h3><strong><font color= '#66CC00'>Confirm Registration</font></strong></h3>
		<hr/>
		<?php
			
			if(isset($_REQUEST['newName']) && isset($_REQUEST['newBirthday']) && isset($_REQUEST['newAddress']))
			{
				if($_REQUEST['newBirthday'] > date("Y-m-d"))
				{
					echo("<p>Please enter a valid birthday date</p>");
					echo("<p>Turn to the <a href=\"getNewPatient.php\">previous page</a></p>");
					exit();
				}

				require 'connectDB.php';

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

				/* Prepare against SQL injection */
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
				echo("<p>Turn to the <a href=\"homePage.php\">Home page</a></p>");
			}
			else
			{
				echo("<p>No patient was searched</p>");
				echo("<p><a href=\"getPatient.php\">Search for a patient</a></p>");
			}

			$connection = null;
		?>
	</body>
</html>