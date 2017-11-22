<html>
	<body>
	<h3><strong><font color= '#66CC00'>Check Patient Existence</font></strong></h3>
	<hr/>
	<form action="getNewPatient.php" method="post">
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

		$stmt = $connection->prepare("SELECT * FROM Patient WHERE name LIKE '%$_REQUEST[name]%'");
		$stmt->execute();
		//$stmt->bindParam(':name', $name);

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
			echo("<tr><td bgcolor='#66CC00'><font color= '#FFFFFF'>Patient Number</font></td><td bgcolor='#66CC00'><font color= '#FFFFFF'>Patient Name</font></td><td bgcolor='#66CC00'><font color= '#FFFFFF'>Birthday</font></td><td bgcolor='#66CC00'><font color= '#FFFFFF'>Address</font></td></tr>");

			foreach($stmt as $row)
			{
				echo("<tr><td>");
				$patient_number=$row['patient_number'];
				echo($patient_number);
				echo("</td><td>");
				$name=$row['name'];
				echo("<a href=\"getDevices.php?patient_number=$patient_number\">$name</a>");
				echo("</td><td>");
				$birthday=$row['birthday'];
				echo($birthday);
				echo("</td><td>");
				$address=$row['address'];
				echo($address);
				echo("</td></tr>");
			}

			echo("</table>");
		}
		else
		{
			echo("<p>Patient not found!</p>");
		}
		
		echo("<p><input type=\"submit\" value=\"Register a New Patient\"/></p>");
		echo("<p>Turn to the <a href=\"getPatient.php\">previous page</a></p>");

	$connection = null;
?>
 	</body>
</html>