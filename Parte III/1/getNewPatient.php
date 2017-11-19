<html>
	<body>
		<h3><strong><font color= '#66CC00'>Register New Patient</font></strong></h3>
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
		?>
		<form action="insertPatient.php" method="post">
		<?php
 			echo("<p>Name: <input type=\"text\" name=\"newName\"/></p>");
 			echo("<p>Birthday: <input type=\"date\" name=\"newBirthday\"/></p>");
 			echo("<p>Address: <input type=\"text\" name=\"newAddress\"/></p>");
		?>
			<p><input type="submit" value="Register"/></p>
		<?php
			$connection = NULL;
		?>
		</form>
	</body>
</html>