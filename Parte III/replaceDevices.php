<?php session_start(); ?>
<html>
	<body>
	<h3><strong><font color= '#66CC00'>Replace Device</font></strong></h3>
	<hr/>
	<form action="changeTables.php" method="post">
		<?php
			if(isset($_GET['serialnum']) && isset($_GET['manufacturer']) && isset($_SESSION['patient_number']) && isset($_GET['start_date']) && isset($_GET['end_date']))
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

				$serialnum = $_GET['serialnum'];
				$manufacturer = $_GET['manufacturer'];
				$patient_number = $_SESSION['patient_number'];
				$_SESSION['serialnum'] = $serialnum;
				$_SESSION['manufacturer'] = $manufacturer;
				$_SESSION['start_date'] = $_GET['start_date'];
				$_SESSION['end_date'] = $_GET['end_date'];

				$stmt = $connection->prepare("SELECT serialnum FROM Device WHERE serialnum<>'$serialnum' AND manufacturer='$manufacturer' AND serialnum NOT IN(SELECT serialnum FROM Wears WHERE serialnum<>'$serialnum' AND manufacturer='$manufacturer' AND TIMESTAMPDIFF(SECOND, end_date, CURRENT_TIMESTAMP()) <= 0)");
				$stmt->execute();

				if($stmt == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				$nrows= $stmt->rowCount();

				if($nrows > 0)
				{	
		?>
 					<p>Devices available:
 					<select name="serialnum">
 		<?php				
					foreach($stmt as $row)
					{
						$serialnum=$row['serialnum'];
						echo("<option value=\"$serialnum\">$serialnum</option>");
					}

				}
				else
				{
					echo("<p>No devices of that manufacturer are available at the current time!</p>");
					echo("<p>Turn to the <a href=\"getDevices.php?patient_number=$patient_number\">previous page</a></p>");
				}
			}
			else
			{
				echo("<p>No patient was searched</p>");
				echo("<p><a href=\"getPatient.php\">Search for a patient</a></p>");
			}
			
			$connection = null;
		?>
					</select>
					</p>
					<p><input type="submit" value="Replace"/></p>
	</form>
 	</body>
</html>