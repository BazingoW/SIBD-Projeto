<?php session_start(); ?>
<html>
	<body>
	<h3><strong><font color= '#66CC00'>Devices</font></strong></h3>
	<hr/>
<?php
		if(isset($_GET['patient_number']))
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
			$_SESSION['patient_number'] = $patient_number;

			$stmt = $connection->prepare("SELECT * FROM Wears WHERE patient_number='$patient_number' ORDER BY end_date DESC");
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
				echo("<table border=\"0\" cellspacing=\"5\" bordercolor='#66CC00'>");
				echo("<tr><td bgcolor='#66CC00'><font color= '#FFFFFF'>Serial Number</font></td><td bgcolor='#66CC00'><font color= '#FFFFFF'>Manufacturer</font></td><td bgcolor='#66CC00'><font color= '#FFFFFF'>Start Date</font></td><td bgcolor='#66CC00'><font color= '#FFFFFF'>End Date</font></td></tr>");

				foreach($stmt as $row)
				{
					if($row['end_date'] >= date("Y-m-d"))
					{
						echo("<tr><td><strong>");
						$serialnum = $row['serialnum'];
						echo($row['serialnum']);
						echo("</strong></td><td><strong>");
						$manufacturer = $row['manufacturer'];
						echo($row['manufacturer']);
						echo("</strong></td><td><strong>");
						$start_date = $row['start_date'];
						echo($row['start_date']);
						echo("</strong></td><td><strong>");
						$end_date = $row['end_date'];
						echo($row['end_date']);
						echo("</strong></td><td>");
						echo("<form action=\"replaceDevices.php\" method=\"get\">");
						echo("<input type=\"hidden\" name=\"serialnum\" value=\"$serialnum\"/>");
						echo("<input type=\"hidden\" name=\"manufacturer\" value=\"$manufacturer\"/>");
						echo("<input type=\"hidden\" name=\"start_date\" value=\"$start_date\"/>");
						echo("<input type=\"hidden\" name=\"end_date\" value=\"$end_date\"/>");
						echo("<input type=\"submit\" value=\"Replace\"/>");
						echo("</form>");
						echo("</td></tr>");
					}
					else
					{
						echo("<tr><td>");
						echo($row['serialnum']);
						echo("</td><td>");
						echo($row['manufacturer']);
						echo("</td><td>");
						echo($row['start_date']);
						echo("</td><td>");
						echo($row['end_date']);
						echo("</td></tr>");
					}
					
				}

				echo("</table>");
			}
			else
			{
				echo("<p>Patient never wore any device!</p>");
			}
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