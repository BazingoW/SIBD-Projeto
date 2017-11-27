<html>
	<body>
	<h3><strong><font color= '#66CC00'>New Study</font></strong></h3>
	<hr/>
	<form action="insertStudy.php" method="post">
		<?php
			require 'connectDB.php';
		?>
			<p>Patient Number:
				<select name="patient_number">	
		<?php
					$sql = "SELECT * FROM Patient";
					$result = $connection->query($sql);

					if($result == FALSE)
					{
						$info = $connection->errorInfo();
						echo("<p>Error: {$info[2]}</p>");
						exit();
					}
		
					foreach($result as $row)
					{
						$patient_number = $row['patient_number'];
						$patient_name = $row['name'];
						echo("<option value=\"$patient_number\">$patient_number | $patient_name</option>");
					}
		?>		
				</select>
			</p>
			<p>Request Number: <input type="text" name="request_number" required/></p>
			<p>Description: <input type="text" name="description" required/></p>
			<p>Study Date: <input type="text" name="study_date" required/></p>
			<p>Doctor:
				<select name="doctor_id">			
		<?php
					$stmt = $connection->prepare("SELECT doctor_id FROM Doctor;");
					$stmt->execute();

					if($stmt == FALSE)
					{
						$info = $connection->errorInfo();
						echo("<p>Error: {$info[2]}</p>");
						exit();
					}
		
					foreach($stmt as $row)
					{
						$doctor_id = $row['doctor_id'];
						echo("<option value=\"$doctor_id\">$doctor_id</option>");
					}
	?>
				</select>
			</p>
			<p>Device:
				<select name="serialnum">
	<?php
					$stmt = $connection->prepare("SELECT serialnum, manufacturer FROM Device WHERE (serialnum NOT IN(SELECT serialnum FROM Wears WHERE patient_number <> :patient_number)) OR (serialnum IN (SELECT serialnum FROM Wears WHERE patient_number = :patient_number) AND manufacturer NOT IN(SELECT manufacturer FROM Wears WHERE patient_number = :patient_number))");
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

						echo("<option value=\"$serialnum\">$serialnum | $manufacturer</option>");
					}
	?>
				</select>
			</p>
			<p><input type="submit" value="Add New Study"/></p>
	<?php
			echo("<p>Turn to the <a href=\"homePage.php\">Home page</a></p>");
			$connection = null;
	?>
	</form>
 	</body>
</html>