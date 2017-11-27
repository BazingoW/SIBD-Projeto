<html>
	<body>
		<h3><strong><font color= '#66CC00'>Search for a Patient</font></strong></h3>
		<hr/>
		<form action="checkExistance.php" method="post">
 			<p>Patient Name:
				<input type ="text" name="name" require/>
				<input type="submit" value="Search"/>
			</p>
		</form>
	<?php
		echo("<p> Turn to the <a href=\"homePage.php\">home page</a>");
	?>
	</body>
</html>