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

    </style>
</head>

<body>
    <div id="years" class='center'>
        <h2>Years</h2>
    </div>
    <?php
    //Get a variable out of the website URL
    $team = $_GET["team"];
    //send a SQL statement and get results in to teams
    $sql = "SELECT yearID,teamID,name FROM teams where name=:team ORDER BY name";
    $params = [":team" => $team];
    $teams = getDataFromSQL($sql, $params);

    echo "<div class= 'center'>";

    foreach ($teams as $team) {
        echo "<a class='teams' href='roster.php?teamID=" . $team["teamID"] . "&yearID=" . $team["yearID"] . "'>";
        echo $team["yearID"] . " " . $team["name"];
        echo "</a> ";
        echo "<BR>";
    }
    echo "</div>";

    include "includes/footer.php";
    ?>
</body>