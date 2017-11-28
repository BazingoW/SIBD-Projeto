<html>
	<body>
		<h3><strong><font color= '#66CC00'>New Region</font></strong></h3>
		<hr/>
		<?php

			require 'connectDB.php';

			$series_id = $_REQUEST['series_id'];
			$elem_index = $_REQUEST['elem_index'];
			$x1 = $_REQUEST['x1'];
			$y1 = $_REQUEST['y1'];
			$x2 = $_REQUEST['x2'];
			$y2 = $_REQUEST['y2'];

			
			if(isset($_REQUEST['series_id']) && isset($_REQUEST['elem_index']) && isset($_REQUEST['x1']) && isset($_REQUEST['y1']) && isset($_REQUEST['x2']) && isset($_REQUEST['y2']))
			{
				if($_REQUEST['series_id'] <= 0 || $_REQUEST['elem_index'] <= 0 || $_REQUEST['x1'] < 0 || $_REQUEST['y1'] < 0 || $_REQUEST['x2'] < 0 || $_REQUEST['y2'] < 0 || $_REQUEST['x1'] > 1 || $_REQUEST['y1'] > 1 || $_REQUEST['x2'] > 1 || $_REQUEST['y2'] > 1 )
				{
					echo("<p>Please enter valid inputs. All inputs have to be greater or equal to zero</p>");
					echo("<p>Turn to the <a href=\"getRegion.php\">previous page</a></p>");
					exit();

				}

				/* Begins transaction */
				$connection->beginTransaction();

				$stmt = $connection->prepare("SELECT * FROM Element WHERE series_id = $series_id AND elem_index = :elem_index");
				$stmt->bindParam(':elem_index', $elem_index);
				$stmt->execute();

				if($stmt == FALSE)
				{
					$connection->rollback();
					$info = $connection->errorInfo();
					echo("<p>Error: {$info[2]}</p>");
					exit();
				}

				$seriesExists = $stmt->rowCount();

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

				/* Series ID has to exist in the database */
				if($seriesExists == 0)
				{
					$connection->rollback();
					echo("<p>The series or/and the element index don't exist</p>");
					echo("<p>New Region not added</p>");
					echo("<p>Turn to the <a href=\"newStudy.php\">previous page</a></p>");
				}
				else if($x1 > $x2 || $y1 > $y2)
				{
					$connection->rollback();
					echo("<p>x2 and y2 have to be greater or equal than x1 and y1, respectively</p>");
					echo("<p>New Region not added</p>");
					echo("<p>Turn to the <a href=\"newStudy.php\">previous page</a></p>");
				}
				else
				{
					$connection->commit();
					echo("<p>New Region Added</p>");

					/* Check the description of the study of the region that was added */
					$stmt = $connection->prepare("SELECT * FROM Study NATURAL JOIN Series WHERE series_id = :series_id");
					$stmt->bindParam(":series_id", $series_id);
					$stmt->execute();

					if($stmt == FALSE)
					{
						$info = $connection->errorInfo();
						echo("<p>Error: {$info[2]}</p>");
						exit();
					}

					foreach($stmt as $row)
					{
						$newestDesc = $row['description'];
						$newestDate = $row['study_date'];
						$newestRequest = $row['request_number'];
					}

					/* Last study of the patient */
					$stmt = $connection->prepare("SELECT MAX(study_date) AS study_date FROM Study WHERE study_date IN (SELECT study_date FROM Study WHERE request_number IN (SELECT request_number FROM Request WHERE patient_number IN (SELECT patient_number FROM Series NATURAL JOIN Request WHERE series_id = :series_id)) AND request_number <> :newestRequest);");
					$stmt->bindParam(":series_id", $series_id);
					$stmt->bindParam(":newestRequest", $newestRequest);
					$stmt->execute();

					if($stmt == FALSE)
					{
						$info = $connection->errorInfo();
						echo("<p>Error: {$info[2]}</p>");
						exit();
					}

					$numberRows = $stmt->rowCount();

					/* If there is any previous study of the patient */
					if($numberRows == 1)
					{
						foreach($stmt as $row)
						{
							$lastDate = $row['study_date'];
						}

						/* If the last study date precedes the study date where the new region is being inserted then the regions will be compared */
						if($lastDate < $newestDate)
						{
							//echo("<p>ENTROU AQUI!</p>");
							$stmt = $connection->prepare("SELECT * FROM Study NATURAL JOIN Series NATURAL JOIN Element WHERE study_date = :lastDate AND description = :newestDesc");
							$stmt->bindParam(":lastDate", $lastDate);
							$stmt->bindParam(":newestDesc", $newestDesc);
							$stmt->execute();

							$nrows = $stmt->rowCount();

							/* Means that the last study has the same description */
							if($nrows > 0)
							{
								foreach($stmt as $row)
								{
									$lastSeries = $row['series_id'];
									$lastElements[] = $row['elem_index'];
								}

								/* Checks if any region of any element of the last study overlaps with the new region */
								for ($i = 0; $i < count($lastElements); $i++)
								{
									$lastElemmIndex = $lastElements[$i];
								    $stmt = $connection->prepare("SELECT region_overlaps_element(:lastSeries, :lastElemmIndex, :x1, :y1, :x2, :y2) AS overlaps");
								    $stmt->bindParam(":lastSeries", $lastSeries);
								    $stmt->bindParam(":lastElemmIndex", $lastElemmIndex);
								    $stmt->bindParam(":x1", $x1);
								    $stmt->bindParam(":y1", $y1);
								    $stmt->bindParam(":x2", $x2);
								    $stmt->bindParam(":y2", $y2);
									$stmt->execute();

									if($stmt == FALSE)
									{
										$info = $connection->errorInfo();
										echo("<p>Error: {$info[2]}</p>");
										exit();
									}

									foreach($stmt as $row)
									{
										$overlaps = $row['overlaps'];
									}

									/* If any region of a certain element of the last study doesn't overlap with the new region inserted then throws an alert */
									if($overlaps == 0)
									{
										$stmt = $connection->prepare("SELECT name, patient_number FROM Request NATURAL JOIN Series NATURAL JOIN Patient WHERE series_id = :series_id");
										$stmt->bindParam(":series_id", $series_id);
										$stmt->execute();

										if($stmt == FALSE)
										{
											$info = $connection->errorInfo();
											echo("<p>Error: {$info[2]}</p>");
											exit();
										}

										foreach($stmt as $row)
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
					}

					echo("<p>Turn to the <a href=\"homePage.php\">Home page</a></p>");
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