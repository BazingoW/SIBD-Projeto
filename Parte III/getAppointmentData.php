<?php session_start(); ?>
<html>
	<body>
		<h3><strong><font color= '#66CC00'>Schedule Appointment</font></strong></h3>
		<hr/>
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

			$_SESSION['pushButton'] = $_REQUEST['pushButton'];
		?>
		<form action="scheduleAppointment.php" method="post">
		<?php
 		
	 		if($_SESSION['pushButton'] == 1)
	 		{
	 			echo("<p>Name: <input type=\"text\" name=\"newName\"/></p>");
	 			echo("<p>Birthday: <input type=\"date\" name=\"newBirthday\"/></p>");
	 			echo("<p>Address: <input type=\"text\" name=\"newAddress\"/></p>");
	 		}
	 		else
	 		{
	 			$_SESSION['patient_number']=$_REQUEST['patient_number'];
	 			$_SESSION['name']=$_REQUEST['name'];
	 			$_SESSION['birthday']=$_REQUEST['birthday'];
	 			$_SESSION['address']=$_REQUEST['address'];
	 		}
		?>
		<p>Doctor:
			<select name="doctor_id">
			<?php
				$doctors = "SELECT doctor_id FROM Doctor ORDER BY doctor_id";
				$result = $connection->query($doctors);
				foreach ($result as $row)
				{
					$doctor_id = $row['doctor_id'];
					echo("<option value=\"$doctor_id\">$doctor_id</option>");
				}

			?>
			</select>
		</p>
			<p><input type="submit" value="Continue"/></p>
			<?php
				$connection = NULL;
			?>
		</form>
	</body>
</html>