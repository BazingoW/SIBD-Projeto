<html>
	<body>
		<h3><strong><font color= '#66CC00'>Add New Region</font></strong></h3>
		<hr/>
		<form action="newRegion.php" method="post">
 			<p>Series ID: <input type="text" name="series_id" required/></p>
 			<p>Elemente Index: <input type="text" name="elem_index" required/></p>
 			<p>X1: <input type="text" name="x1" required/></p>
 			<p>Y1: <input type="text" name="y1" required/></p>
 			<p>X2: <input type="text" name="x2" required/></p>
 			<p>Y2: <input type="text" name="y2" required/></p>
 			<?php
				echo("<p><strong>Note:</strong> x2 and y2 have to be greater or equal than x1 and y2, respectively</p>");
			?>
			<p><input type="submit" value="Add Region"/></p>
		</form>
	</body>
</html>