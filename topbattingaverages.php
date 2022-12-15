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
    <div id="teams" class='center'>
        <h2>Top 25 Batting Averages in a Season</h2>
    </div>

    <?php

    //send a SQL statement and get results in to teams
    $sql = "SELECT b.yearID, t.name,m.nameFirst, m.nameLast, ROUND(b.H/b.AB, 3)average
    FROM batting b
    JOIN master m ON (b.playerID = m.playerID)
    JOIN teams t ON (t.yearID = b.yearID AND b.teamID = t.teamID)
    WHERE b.AB >200
    ORDER BY average DESC
    LIMIT 25";

    $battingaverages = getDataFromSQL($sql);

    echo "<div class= 'center'>";
    echo "<table class= 'center'>";
    echo "<tr><th></th><th>Name</th><th>Team</th><th>Year</th><th>Average</th></tr>";
    $i = 0;
    $rank = $i + 1;
    foreach ($battingaverages as $BA) {
        echo "<tr><td>$rank</td><td><a class = 'red' href='player.php?playerID=" . $BA["playerID"] . "'>";
        echo $BA["nameFirst"] . " " . $BA["nameLast"] . "</td>";
        echo "</a> ";
        echo "<td>" . $BA['name'] . "</td>";
        echo "<td>" . $BA['yearID'] . "</td>";
        echo "<td>" . $BA['average'] . "</td>";
        echo "</tr>";
        $i++;
        $rank++;
    }
    echo "</table>";
    echo "</div>";


    ?>

    <div id="teams" class='center'>
        <h2>Top 25 Batting Averages All Time</h2>
    </div>

    <?php

    //send a SQL statement and get results in to teams
    $sql = "SELECT b.playerID, m.nameFirst, m.nameLast, ROUND(SUM(b.H)/SUM(b.AB), 3) average
    FROM (SELECT playerID, H, AB
          FROM batting
          UNION ALL 
          SELECT playerID, H, AB
          FROM battingpost) b
    JOIN master m ON (b.playerID = m.playerID)
    GROUP BY b.playerID
	HAVING SUM(b.AB) >2000
    ORDER BY average DESC
    LIMIT 25";

    $battingaverages = getDataFromSQL($sql);

    echo "<div class= 'center'>";
    echo "<table class= 'center'>";
    echo "<tr><th></th><th>Name</th><th>Average</th></tr>";
    $i = 0;
    $rank = $i + 1;
    foreach ($battingaverages as $BA) {
        echo "<tr><td>$rank</td><td><a class = 'red' href='player.php?playerID=" . $BA["playerID"] . "'>";
        echo $BA["nameFirst"] . " " . $BA["nameLast"] . "</td>";
        echo "</a> ";
        echo "<td>" . $BA['average'] . "</td>";
        echo "</tr>";
        $i++;
        $rank++;
    }
    echo "</table>";
    echo "</div>";



    include "includes/footer.php";

    ?>
</body>