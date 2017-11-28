<html>
	<body>
		<h3><strong><font color= '#66CC00'>New Study</font></strong></h3>
		<hr/>
		<?php

			require 'connectDB.php';

			$patient_number = $_REQUEST['patient_number'];
			$request_number = $_REQUEST['request_number'];
			$description = $_REQUEST['description'];
			$study_date = $_REQUEST['study_date'];
			$doctor_id = $_REQUEST['doctor_id'];
			$serialnum = $_REQUEST['serialnum'];
			$series_name = $description;

			/* Protects against going direclty to this web page */
			if(isset($_REQUEST['patient_number']) && isset($_REQUEST['request_number']) && isset($_REQUEST['description']) && isset($_REQUEST['study_date']) && isset($_REQUEST['doctor_id']) && isset($_REQUEST['serialnum']))
			{
				/* Study date couldn't be greater than today */
				if($_REQUEST['study_date'] > date("Y-m-d"))
				{
					echo("<p>Please enter a valid date</p>");
					echo("<p>Study not created</p>");
					echo("<p>Turn to the <a href=\"newStudy.php\">previous page</a></p>");
					exit();
				}

				/* Begins transaction */
				$connection->beginTransaction();

				/* Verifies if the resquest number exists */
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
						$patientOfRequest = $row['patient_number'];
					}
				}

				/* Checks if the doctor that made the request isn't the same that is going to perform the study */
				$doctor = "SELECT doctor_id FROM Request WHERE request_number = $request_number";
				$result = $connection->query($doctor);

				if($result == FALSE)
				{
					$connection->rollback();
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				foreach($result as $row)
				{
					$requestDoctor = $row['doctor_id'];
				}

				/* Checks what is the manufacturer of the device with that serial number */
				$getManufacturer = "SELECT manufacturer FROM Device WHERE serialnum = '$serialnum'";
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
					echo("<p>The request date has to precede the study date!</p>");
					echo("<p>Study not created</p>");
					echo("<p>Turn to the <a href=\"newStudy.php\">previous page</a></p>");
				}
				else if($requestExists == 0) /* Roll back if the request doesn't exist */
				{
					$connection->rollback();
					echo("<p>The request number doesn't exist!</p>");
					echo("<p>Study not created</p>");
					echo("<p>Turn to the <a href=\"newStudy.php\">previous page</a></p>");
				}
				else if($requestDoctor == $doctor_id) /* Roll back if the doctor who made the request is the same as the study */
				{
					$connection->rollback();
					echo("<p>The doctor who makes the request can't make studies about it!</p>");
					echo("<p>Study not created</p>");
					echo("<p>Turn to the <a href=\"newStudy.php\">previous page</a></p>");
				}
				else if($patientOfRequest != $patient_number)
				{
					$connection->rollback();
					echo("<p>The request number doesn't belong to patient number $patient_number!</p>");
					echo("<p>Study not created</p>");
					echo("<p>Turn to the <a href=\"newStudy.php\">previous page</a></p>");
				}
				else
				{
					$connection->commit();
					echo("<p>Study created</p>");
					echo("<p>Turn to the <a href=\"homePage.php\">Home page</a></p>");
				}
			}
			else
			{
				echo("<p>No form was filled!</p>");
				echo("<p><a href=\"newStudy.php\">Create a new study</a></p>");

			}

			$connection = null;
		?>
	</body>
</html>