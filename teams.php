<html>
<?php
error_reporting(0);
require_once "includes/database_functions.php";
include "includes/header.php";
include "includes/navbar.php";

?>

<head>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<style>
		#teams {
			margin-top: 25px;
		}
	</style>
</head>

<body>
	<div id="teams" class='center'>
		<h2>Teams</h2>
	</div>

	<?php

	//send a SQL statement and get results in to teams
	$sql = "SELECT DISTINCT name FROM teams ORDER BY name";

	$teams = getDataFromSQL($sql);

	echo "<div class= 'center'>";
	foreach ($teams as $team) {
		echo "<a class='teams' href='years.php?team=" . $team["name"] . "'>";
		echo $team["name"];
		echo "</a> ";
		echo "<BR>";
	}
	echo "</div>";

	include "includes/footer.php";

	?>
</body>