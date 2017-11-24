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

			$series_id = $_REQUEST['series_id'];
			$elem_index = $_REQUEST['elem_index'];
			$x1 = $_REQUEST['x1'];
			$y1 = $_REQUEST['y1'];
			$x2 = $_REQUEST['x2'];
			$y2 = $_REQUEST['y2'];

			if($_REQUEST['series_id'] <= 0 || $_REQUEST['elem_index'] <= 0 || $_REQUEST['x1'] < 0 || $_REQUEST['y1'] < 0 || $_REQUEST['x2'] < 0 || $_REQUEST['y2'] < 0 || $_REQUEST['x1'] > 1 || $_REQUEST['y1'] > 1 || $_REQUEST['x2'] > 1 || $_REQUEST['y2'] > 1 )
			{
				echo("<p>Please enter valid inputs. All inputs have to be greater or equal to zero</p>");
				echo("<p>Turn to the <a href=\"getRegion.php\">previous page</a></p>");

			}
			else if(isset($_REQUEST['series_id']) && isset($_REQUEST['elem_index']) && isset($_REQUEST['x1']) && isset($_REQUEST['y1']) && isset($_REQUEST['x2']) && isset($_REQUEST['y2']))
			{
				/* Begins transaction */
				$connection->beginTransaction();

				$sql = "SELECT * FROM Element WHERE series_id = $series_id AND elem_index = $elem_index";
				$result = $connection->query($sql);

				if($result == FALSE)
				{
					$connection->rollback();
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				$seriesExists = $result->rowCount();

				/* Add new region */
				$stmt = $connection->prepare("INSERT INTO Region VALUES (:series_id, :elem_index, :x1, :y1, :x2, :y2)");
				$stmt->bindParam(':series_id', $series_id);
				$stmt->bindParam(':elem_index', $elem_index);
				$stmt->bindParam(':x1', $x1);
				$stmt->bindParam(':y1', $y1);
				$stmt->bindParam(':x2', $x2);
				$stmt->bindParam(':y2', $y2);

				$stmt->execute();

				if($stmt == FALSE)
				{
					$connection->rollback();
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				/* Series ID has to exists in the database */
				if($seriesExists == 0)
				{
					$connection->rollback();
					echo("<p>The series doesn't exist</p>");
				}
				else if($x1 > $x2 || $y1 > $y2)
				{
					$connection->rollback();
					echo("<p>x2 and y2 have to be greater or equal than x1 and y2, respectively</p>");
					echo("<p>New Region not added</p>");
				}
				else
				{
					$connection->commit();
					echo("<p>New Region Added</p>");
				}

				/* Check the description of the study of the region that was added */
				$sql = "SELECT description FROM Series WHERE series_id = $series_id";
				$result = $connection->query($sql);

				if($result == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				foreach($result as $row)
				{
					$newestDesc = $row['description'];
				}

				/* Check if region does not overlap with any of the regions of an element of the last study of the patient */
				$sql = "SELECT * FROM Study NATURAL JOIN Series NATURAL JOIN Element WHERE request_number IN ((SELECT request_number FROM Request WHERE patient_number IN (SELECT patient_number FROM Request WHERE request_number IN (SELECT request_number FROM Series WHERE series_id = 1 )))) AND study_date >= all(SELECT study_date FROM Study)";
				$result = $connection->query($sql);

				if($result == FALSE)
				{
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				foreach($result as $row)
				{
					$lastStudyDesc = $row['description'];
					$lastSeries = $row['series_id'];
					$lastElements[] = $row['elem_index'];
				}

				/* If the description of the last study is the same as the description of the series in which the new region was added */
				if($newestDesc == $lastStudyDesc)
				{
					for ($i = 0; $i < count($lastElements); $i++)
					{
						$lastElemmIndex = $lastElements[$i];
					    $sql = "SELECT region_overlaps_element($lastSeries, $lastElemmIndex, $x1, $y1, $x2, $y2) AS overlaps";
						$result = $connection->query($sql);

						if($result == FALSE)
						{
							$info = $connection->errorInfo();
							echo("<p>Error: {$info[2]}</p>");
							exit();
						}

						foreach($result as $row)
						{
							$overlaps = $row['overlaps'];
						}

						/* If any region of a certain element of the last study doesn't overlap with the new region inserted then throws an alert */
						if($overlaps == 0)
						{
							$sql = "SELECT name, patient_number FROM Request NATURAL JOIN Series NATURAL JOIN Patient WHERE series_id = $series_id";
							$result = $connection->query($sql);

							if($result == FALSE)
							{
								$info = $connection->errorInfo();
								echo("<p>Error: {$info[2]}</p>");
								exit();
							}

							foreach($result as $row)
							{
								$patient_name = $row['name'];
								$patient_number = $row['patient_number'];
							}

							echo("<p>New clinic evidence for patient number $patient_number, $patient_name!</p>");
							break;
						}
					}				
				}
			}
			else
			{
				echo("<p>The form has to be filled to add a new region</p>");
				echo("<p><a href=\"getRegion.php\">Add a new Region</a></p>");
			}

			$connection = null;
		?>
	</body>
</html>