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
        <h2>Top 25 All-Time Earnings</h2>
    </div>

    <?php

    //send a SQL statement and get results in to teams
    $sql = "SELECT s.playerID playerID, m.nameFirst, m.nameLast, SUM(salary) salary
    FROM salaries s
    JOIN master m ON (s.playerID = m.playerID)
    GROUP BY s.playerID
    order by 4 DESC
    LIMIT 25";

    $salaries = getDataFromSQL($sql);
    $average = number_format($salaries[0]['salary'], 2);

    echo "<div class= 'center'>";
    echo "<table class= 'center'>";
    echo "<tr><th></th><th>Name</th><th>Salary</th></tr>";
    $i = 0;
    $rank = $i + 1;
    foreach ($salaries as $salary) {
        $average = number_format($salaries[$i]['salary'], 2);
        echo "<tr><td>$rank</td><td><a class= 'red' href='player.php?playerID=" . $salary["playerID"] . "'>";
        echo $salary["nameFirst"] . " " . $salary["nameLast"] . "</td>";
        echo "</a> ";
        echo "<td>$" . $average . "</td>";
        echo "</tr>";
        $i++;
        $rank++;
    }
    echo "</table>";
    echo "</div>";

    include "includes/footer.php";

    ?>
</body>