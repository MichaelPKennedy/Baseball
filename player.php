<!DOCTYPE html>
<html>
<?php
error_reporting(0);
require_once "includes/./database_functions.php";
include "includes/header.php";
include "includes/navbar.php";
?>

<head>
    <title>Player</title>

    <link rel="stylesheet" type="text/css" href="./css/style.css">

</head>

<body>
    <?PHP

    $playerID = $_GET["playerID"];
    //send a SQL statement and get results in to player


    $sql = "Select nameLast, nameFirst FROM master where playerID='" . $playerID . "'";

    $player = getDataFromSQL($sql);

    //Since only one player row should be returned
    //access the first player row of the array at position [0]

    echo "<h2>{$player[0]["nameFirst"]} {$player[0]["nameLast"]}</h2>";
    if (file_exists("images/{$playerID}.jpeg")) {
        echo "<img src='images/{$playerID}.jpeg' width='200px'>";
    } else {
        echo "<img src='images/missing.jpeg'>";
    }


    //Query the database again for all the batting stats for this player
    $sql2 = "Select nameLast, nameFirst, nameGiven, birthYear, birthDay, birthMonth, birthCity, birthCountry, height, weight, throws, bats, deathYear FROM master where playerID= :p";

    $params = [
        ":p" => $playerID
    ];

    $stats = getDataFromSQL($sql2, $params);

    echo "<table style='margin-left:auto;margin-right:auto;'>";

    //Loop over all seasons and send batting stats out as a table row.
    foreach ($stats as $stat) {

        echo "<tr><th>Name</th> <td>{$stat["nameFirst"]}" . " " . "{$stat["nameLast"]}</td></tr>";
        echo "<tr><th>Given Name</th><td>{$stat["nameGiven"]}</td></tr>";
        echo "<tr><th>Birth Date</th><td>{$stat["birthMonth"]}" . ", " . "{$stat["birthDay"]}" . ", " . "{$stat["birthYear"]}</td></tr>";
        echo "<tr><th>Birth City</th><td>{$stat["birthCity"]}</td></tr>";
        if ($stat["birthCountry"] != "USA") echo "<tr><th>Birth Country</th><td>{$stat["birthCountry"]}</td></tr>";
        echo "<tr><th>Height</th><td>{$stat["height"]} inches</td></tr>";
        echo "<tr><th>Weight</th><td>{$stat["weight"]} pounds</td></tr>";
        echo "<tr><th>Throws</th><td>{$stat["throws"]}</td></tr>";
        echo "<tr><th>Bats</th><td>{$stat["bats"]}</td></tr>";

        if ($stat['deathYear']) {
            echo "<tr><th>Age at death</th><td>" . ($stat['deathYear'] - $stat['birthYear']) . "</td></tr>";
        } else echo "<tr><th>Current Age</th><td>" . (date("Y") - "{$stat["birthYear"]}") . "</td></tr>";
    }
    ?>
    </table>

    <?PHP
    //YEARS TEAM HAS PLAYED 

    $sql2 = "Select b.*,t.name FROM batting b join teams t on t.yearID=b.yearID and t.teamID=b.teamID where b.playerID=:p";

    $params = [
        ":p" => $playerID
    ];

    $stats = getDataFromSQL($sql2, $params);
    echo "<h2>Teams Player Has Played For</h2>";
    echo "<table style='margin-left:auto;margin-right:auto;'>";
    echo "<tr><th>Year</th><th>Team</th></tr>";

    //Loop over all seasons and send batting stats out as a table row.
    foreach ($stats as $stat) {
    ?>
        <tr>
            <td> <?php echo "{$stat["yearID"]}"; ?> </td>
            <td> <?php echo "{$stat["name"]}"; ?> </td>

        </tr>
    <?PHP
    }
    ?>
    </table>





    <?PHP



    //BATTING STATS



    //Since only one player row should be returned
    //access the first player row of the array at position [0]



    echo "<h2>Batting Stats</h2>";
    //Query the database again for all the batting stats for this player
    $sql2 = "SELECT playerID, yearID, SUM(G) G, SUM(AB) AB, SUM(R) R, SUM(H) H, SUM(2B) 2B, SUM(3B) 3B, HR
FROM (SELECT playerID, yearID, G, AB, R, H, 2B, 3B, HR
FROM batting
UNION ALL
SELECT playerID, yearID, G, AB, R, H, 2B, 3B, HR
FROM battingpost) x
where playerID= :p
GROUP BY yearID;";

    $params = [
        ":p" => $playerID
    ];

    $seasons = getDataFromSQL($sql2, $params);
    ?>
    <table style="margin-left:auto;margin-right:auto;">
        <tr>
            <th>Year</th>
            <th>Games Played</th>
            <th>At Bat</th>
            <th>Runs</th>
            <th>Hit</th>
            <th>Double</th>
            <th>Triple</th>
            <th>Home Run</th>
        </tr>
        <?php
        //Loop over all seasons and send batting stats out as a table row.
        foreach ($seasons as $season) {
        ?>

            <tr>
                <td> <?php echo "{$season["yearID"]}"; ?> </td>
                <td> <?php echo "{$season["G"]}"; ?> </td>
                <td> <?php echo "{$season["AB"]}"; ?> </td>
                <td> <?php echo "{$season["R"]}"; ?> </td>
                <td> <?php echo "{$season["H"]}"; ?> </td>
                <td> <?php echo "{$season["2B"]}"; ?> </td>
                <td> <?php echo "{$season["3B"]}"; ?> </td>
                <td> <?php echo "{$season["HR"]}"; ?> </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <?PHP
    echo "<h2>Pitching Stats</h2>";
    //Query the database again for all the batting stats for this player
    $sql2 = "SELECT playerID, yearID, SUM(G) G, SUM(W) W, SUM(L) L, SUM(SO) SO, SUM(SHO) SHO
FROM (SELECT playerID, yearID, G, W, L, SO, SHO
      FROM pitching
      UNION ALL
      SELECT playerID, yearID, G, W, L, SO, SHO
      FROM pitchingpost) x
      where playerID=:p
      GROUP BY yearID";

    $params = [
        ":p" => $playerID
    ];

    $seasons = getDataFromSQL($sql2, $params);
    ?>
    <table style="margin-left:auto;margin-right:auto;">
        <tr>
            <th>Year</th>
            <th>Games</th>
            <th>Wins</th>
            <th>Losses</th>
            <th>Strikeouts</th>
            <th>Shutouts</th>
        </tr>
        <?php
        //Loop over all seasons and send batting stats out as a table row.
        foreach ($seasons as $season) {
        ?>

            <tr>
                <td> <?php echo "{$season["yearID"]}"; ?> </td>
                <td> <?php echo "{$season["G"]}"; ?> </td>
                <td> <?php echo "{$season["W"]}"; ?> </td>
                <td> <?php echo "{$season["L"]}"; ?> </td>
                <td> <?php echo "{$season["SO"]}"; ?> </td>
                <td> <?php echo "{$season["SHO"]}"; ?> </td>
            </tr>
        <?php
        }
        ?>
    </table>

    <?PHP
    echo "<h2>Fielding Stats</h2>";
    //Query the database again for all the batting stats for this player
    $sql2 = "SELECT playerID, yearID, POS, SUM(G) G, SUM(PO) PO, SUM(E) E, SUM(DP) DP, SUM(A) A
FROM (SELECT playerID, yearID, POS, G, PO, E, DP, A
FROM fielding
UNION ALL
SELECT playerID, yearID, POS, G, PO, E, DP, A
FROM fieldingpost) x
where playerID=:p
GROUP BY yearID, POS;";

    $params = [
        ":p" => $playerID
    ];

    $seasons = getDataFromSQL($sql2, $params);
    ?>
    <table style="margin-left:auto;margin-right:auto;">
        <tr>
            <th>Year</th>
            <th>Position</th>
            <th>Games</th>
            <th>Errors</th>
            <th>Double Plays</th>
            <th>Assists</th>
        </tr>
        <?php
        //Loop over all seasons and send batting stats out as a table row.
        foreach ($seasons as $season) {
        ?>

            <tr>
                <td> <?php echo "{$season["yearID"]}"; ?> </td>
                <td> <?php echo "{$season["POS"]}"; ?> </td>
                <td> <?php echo "{$season["G"]}"; ?> </td>
                <td> <?php echo "{$season["E"]}"; ?> </td>
                <td> <?php echo "{$season["DP"]}"; ?> </td>
                <td> <?php echo "{$season["A"]}"; ?> </td>
            </tr>
        <?php
        }
        ?>
    </table>


    <?php

    include "includes/footer.php";

    ?>
</body>