<?php session_start(); ?>
<html>
	<body>
		<h3><strong><font color= '#66CC00'>New Study</font></strong></h3>
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

			$patient_number = $_SESSION['patient_number'];
			$patient_name = $_SESSION['patient_name'];
			$request_number = $_REQUEST['request_number'];
			$description = $_REQUEST['description'];
			$study_date = $_REQUEST['study_date'];
			$doctor_id = $_REQUEST['doctor_id'];
			$serialnum = $_REQUEST['serialnum'];
			$series_name = $_REQUEST['series_name'];

			if($_REQUEST['study_date'] < date("Y-m-d"))
			{
				echo("<p>Please enter a valid date</p>");
				echo("<p>Study not created</p>");
				echo("<p>Turn to the <a href=\"newStudy.php?patient_number=$patient_number&patient_name=$patient_name\">previous page</a></p>");
			}
			else
			{
				/* Begins transaction */
				$connection->beginTransaction();

				$sql = "SELECT * FROM Request";
				$result = $connection->query($sql);

				if($result == FALSE)
				{
					$connection->rollback();
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				$requestExists = 0;

				foreach($result as $row)
				{
					$request_id = $row['request_number'];
					if($request_id == $request_number)
					{
						$requestExists = 1;
						/* Date of the request has to be previous than the study date */
						$request_date = $row['request_date'];
					}
				}

				/* Checks what is the manufacturer of the device with that serial number */
				$getManufacturer = "SELECT manufacturer FROM Device WHERE serialnum = 'B3'";
				$result = $connection->query($getManufacturer);

				if($result == FALSE)
				{
					$connection->rollback();
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				foreach($result as $row)
				{	
					$manufacturer = $row['manufacturer'];
				}

				/* Add new study */
				$stmt = $connection->prepare("INSERT INTO Study VALUES (:request_number, :description, :study_date, :doctor_id, :manufacturer, :serialnum)");
				$stmt->bindParam(':request_number', $request_number);
				$stmt->bindParam(':description', $description);
				$stmt->bindParam(':study_date', $study_date);
				$stmt->bindParam(':doctor_id', $doctor_id);
				$stmt->bindParam(':manufacturer', $manufacturer);
				$stmt->bindParam(':serialnum', $serialnum);

				$stmt->execute();

				if($stmt == FALSE)
				{
					$connection->rollback();
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				/* Checks what is the last number of the series added */
				$getSeries = "SELECT series_id FROM Series";
				$result = $connection->query($getSeries);

				if($result == FALSE)
				{
					$connection->rollback();
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				$series_id = ($result->rowCount()) + 1;
				$base_url = "http://web.tecnico.ulisboa.pt/ist181731/series/" . $series_id;

				/* Add new series */
				$stmt = $connection->prepare("INSERT INTO Series VALUES (:series_id, :series_name, :base_url, :request_number, :description)");
				$stmt->bindParam(':series_id', $series_id);
				$stmt->bindParam(':series_name', $series_name);
				$stmt->bindParam(':base_url', $base_url);
				$stmt->bindParam(':request_number', $request_number);
				$stmt->bindParam(':description', $description);
				
				$stmt->execute();

				if($stmt == FALSE)
				{
					$connection->rollback();
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				/* Study date has to be after request date and the request number should exists */
				if($study_date < $request_date)
				{
					$connection->rollback();
					echo("<p><The request date has to precede the study date/p>");
					echo("<p>Study not created</p>");	
				}
				else if($requestExists == 0)
				{
					$connection->rollback();
					echo("<p><The request number doesn't exist/p>");
					echo("<p>Study not created</p>");
				}
				else
				{
					$connection->commit();
					echo("<p>Study created</p>");
				}
				
				echo("<p><a href=\"getPatient.php\">Search for another patient</a></p>");
			}

			$connection = null;
		?>
	</body>
</html>