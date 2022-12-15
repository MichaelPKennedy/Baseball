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
        <h2>Top 25 Home Runs in a Season</h2>
    </div>

    <?php

    //send a SQL statement and get results in to teams
    $sql = "SELECT m.nameFirst, m.nameLast, b.yearID, t.name, b.playerID, b.HR
    FROM batting b
    JOIN master m ON(b.playerID = m.playerID)
    JOIN teams t ON (t.yearID = b.yearID AND b.teamID = t.teamID)
    UNION ALL
    SELECT null, null, null, null, playerID, HR
    FROM battingpost x
    GROUP BY x.playerID
    ORDER BY 6 DESC
    LIMIT 25";

    $homeruns = getDataFromSQL($sql);

    echo "<div class= 'center'>";
    echo "<table class= 'center'>";
    echo "<tr><th></th><th>Name</th><th>Year</th><th>Team</th><th>Home Runs</th></tr>";
    $i = 0;
    $rank = $i + 1;
    foreach ($homeruns as $HR) {
        echo "<tr><td>$rank</td><td><a class = 'red' href='player.php?playerID=" . $HR["playerID"] . "'>";
        echo $HR["nameFirst"] . " " . $HR["nameLast"] . "</td>";
        echo "</a> ";
        echo "<td>" . $HR['yearID'] . "</td>";
        echo "<td>" . $HR['name'] . "</td>";
        echo "<td>" . $HR['HR'] . "</td>";
        echo "</tr>";
        $i++;
        $rank++;
    }
    echo "</table>";
    echo "</div>";

    echo  "<div id='teams' class='center'><h2>Top 25 Home Runs of all Time</h2></div>";
    $sql = "SELECT x.playerID, SUM(x.HR) HR, m.nameLast, m.nameFirst
    FROM
      (SELECT playerID, HR
       FROM batting
       UNION ALL
       SELECT playerID, HR
       FROM battingpost) x
    JOIN master m on (m.playerID = x.playerID)
    GROUP BY x.playerID
    ORDER BY 2 DESC
    LIMIT 25;";

    $homeruns = getDataFromSQL($sql);

    echo "<div class= 'center'>";
    echo "<table class= 'center'>";
    echo "<tr><th></th><th>Name</th><th>Home Runs</th></tr>";
    $i = 0;
    $rank = $i + 1;
    foreach ($homeruns as $HR) {
        echo "<tr><td>$rank</td><td><a class = 'red' href='player.php?playerID=" . $HR["playerID"] . "'>";
        echo $HR["nameFirst"] . " " . $HR["nameLast"] . "</td>";
        echo "</a> ";
        echo "<td>" . $HR['HR'] . "</td>";
        echo "</tr>";
        $i++;
        $rank++;
    }
    echo "</table>";
    echo "</div>";



    include "includes/footer.php";

    ?>
</body>