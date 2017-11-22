<?php session_start(); ?>
<html>
	<body>
	<h3><strong><font color= '#66CC00'>New Study</font></strong></h3>
	<hr/>
	<form action="addNewStudy.php" method="post">
		<?php
			if(isset($_GET['patient_number']) && isset($_GET['patient_name']))
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

				$patient_number = $_GET['patient_number'];
				$patient_name = $_GET['patient_name'];
			}	
		?>
				<p>Request Number: <input type="text" name="request_number" required/></p>
				<p>Description: <input type="text" name="description" required/></p>
				<p>Date: <input type="date" name="study_date" required/></p>
				<p>Doctor:
					<select name="doctor_id">			
 		<?php
						$stmt = $connection->prepare("SELECT doctor_id FROM Doctor WHERE patient_number <> :patient_number");
						$stmt->bindParam(':patient_number', $patient_number);
						$stmt->execute();

						if($stmt == FALSE)
						{
							$info = $connection->errorInfo();
							echo("<p>Error: {$info[2]}</p>");
							exit();
						}
			
						foreach($stmt as $row)
						{
							$doctor_id=$row['doctor_id'];
							echo("<option value=\"$doctor_id\">$doctor_id</option>");
						}
		?>
					</select>
				</p>
				<p>Device:
					<select name="serialnum">
		<?php
						$stmt = $connection->prepare("SELECT serialnum, manufacturer FROM Device WHERE (serialnum NOT IN(SELECT serialnum FROM Wears WHERE patient_number <> :patient_number)) OR (serialnum IN (SELECT serialnum FROM Wears WHERE patient_number = :patient_number))");
						$stmt->bindParam(':patient_number', $patient_number);
						$stmt->execute();

						if($stmt == FALSE)
						{
							$info = $connection->errorInfo();
							echo("<p>Error: {$info[2]}</p>");
							exit();
						}
			
						foreach($stmt as $row)
						{
							$serialnum = $row['serialnum'];
							$manufacturer = $row['manufacturer'];

							echo("<option value=\"$serialnum\">Serial Number: $serialnum | Manufacturer: $manufacturer</option>");
						}
		?>
					</select>
				</p>
				<p><input type="submit" value="Add New Study"/></p>
<?php
		echo("<p>Turn to the <a href=\"checkExistance.php?patient_name=$patient_name\">previous page</a></p>");
		$connection = null;
?>
	</form>
 	</body>
</html>