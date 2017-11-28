<html>
	<body>
	<h3><strong><font color= '#66CC00'>Check Patient Existence</font></strong></h3>
	<hr/>
<?php

	if(isset($_REQUEST['name']))
	{
		require 'connectDB.php';

		$name = $_REQUEST['name'];
		$findName = "%" . $name . "%";

		$stmt = $connection->prepare("SELECT * FROM Patient WHERE name LIKE :findName");
		$stmt->bindParam(':findName', $findName);
		$stmt->execute();
		
		if($stmt == FALSE)
		{
			$info = $connection->errorInfo();
			echo("<p>Error: {$info[2]}</p>");
			exit();
		}

		$nrows= $stmt->rowCount();

		/* If there are patients that contain the substring */
		if($nrows > 0)
		{
			echo("<table border=\"0\" cellspacing=\"5\" bordercolor='#66CC00'>");
			echo("<tr><td bgcolor='#66CC00'><font color= '#FFFFFF'>Patient Number</font></td><td bgcolor='#66CC00'><font color= '#FFFFFF'>Patient Name</font></td><td bgcolor='#66CC00'><font color= '#FFFFFF'>Birthday</font></td><td bgcolor='#66CC00'><font color= '#FFFFFF'>Address</font></td></tr>");

			foreach($stmt as $row)
			{
				echo("<tr><td>");
				echo("{$row['patient_number']}");
				echo("</td><td>");
				echo("<a href=\"getDevices.php?patient_number={$row['patient_number']}&findName=$findName\">{$row['name']}</a>");
				echo("</td><td>");
				echo("{$row['birthday']}");
				echo("</td><td>");
				echo("{$row['address']}");
				echo("</td></tr>");
			}

			echo("</table>");
		}
		else
		{
			echo("<p>Patient not found!</p>");
		}
?>	
		<form action="getNewPatient.php" method="post">
		<p><input type="submit" value="Register a New Patient"/></p>
		</form>
<?php
		echo("<p>Turn to the <a href=\"getPatient.php\">previous page</a></p>");
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