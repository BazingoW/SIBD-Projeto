<?php session_start(); ?>
<html>
	<body>
	<h3><strong><font color= '#66CC00'>Devices</font></strong></h3>
	<hr/>
<?php
		if(isset($_GET['patient_number']))
		{
			require 'connectDB.php';

			$patient_number = $_GET['patient_number'];
			$findName = $_GET['findName'];
			$_SESSION['patient_number'] = $patient_number;

			$stmt = $connection->prepare("SELECT * FROM Wears WHERE patient_number = :patient_number ORDER BY end_date DESC");
			$stmt->bindParam(":patient_number", $patient_number);
			$stmt->execute();

			if($stmt == FALSE)
			{
				$info = $connection->errorInfo();
				echo("<p>Error: {$info[2]}</p>");
				exit();
			}

			$nrows= $stmt->rowCount();

			/* If the patient wore and/or wears any device, it will dispaly them */
			if($nrows > 0)
			{
				echo("<table border=\"0\" cellspacing=\"5\" bordercolor='#66CC00'>");
				echo("<tr><td bgcolor='#66CC00'><font color= '#FFFFFF'>Serial Number</font></td><td bgcolor='#66CC00'><font color= '#FFFFFF'>Manufacturer</font></td><td bgcolor='#66CC00'><font color= '#FFFFFF'>Start Date</font></td><td bgcolor='#66CC00'><font color= '#FFFFFF'>End Date</font></td></tr>");

				foreach($stmt as $row)
				{
					if($row['end_date'] >= date("Y-m-d H:i:s"))
					{
						echo("<tr><td><strong>");
						echo($row['serialnum']);
						echo("</strong></td><td><strong>");
						echo($row['manufacturer']);
						echo("</strong></td><td><strong>");
						echo($row['start_date']);
						echo("</strong></td><td><strong>");
						echo($row['end_date']);
						echo("</strong></td><td>");
						echo("<form action=\"replaceDevices.php\" method=\"get\">");
						echo("<input type=\"hidden\" name=\"serialnum\" value=\"{$row['serialnum']}\"/>");
						echo("<input type=\"hidden\" name=\"manufacturer\" value=\"{$row['manufacturer']}\"/>");
						echo("<input type=\"hidden\" name=\"start_date\" value=\"{$row['start_date']}\"/>");
						echo("<input type=\"hidden\" name=\"end_date\" value=\"{$row['end_date']}\"/>");
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
				echo("<p>Turn to the <a href=\"checkExistance.php?findName=$findName\">previous page</a></p>");
			}
			else
			{
				echo("<p>Patient never wore any device!</p>");
				echo("<p>Turn to the <a href=\"checkExistance.php?findName=$findName\">previous page</a></p>");
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
