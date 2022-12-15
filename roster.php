<html>
<?php
ini_set('display_errors', 1);
error_reporting(0);
require_once "includes/database_functions.php";

include "includes/header.php";
include "includes/navbar.php";


?>

<head>
    <link rel="stylesheet" type="text/css" href="./css/style.css">

</head>


<?php
//Get a variable out of the website URL
$teamID = $_GET["teamID"];
$yearID = $_GET["yearID"];

//gets team information
$sql = "SELECT * FROM teams where yearID=:yearID and teamID = :teamID;";
$params = [":teamID" => $teamID, ":yearID" => $yearID];
$teams = getDataFromSQL($sql, $params);

echo "<div class='center'> <h2> {$teams[0]['name']} {$yearID} </h2> </div>";
echo "<div class='center'> <h2 class='nomargin'> Wins: {$teams[0]['W']} Losses: {$teams[0]['L']} </h2> </div>";
echo "<div class='center'> <h2 class='nomargin'> Rank: {$teams[0]['Rank']} </h2> </div>";

//get average player salary
$sql = "SELECT AVG(salary) Total FROM salaries  where teamID=:teamID and yearID=:yearID;";
$params = [":teamID" => $teamID, ":yearID" => $yearID];
$salary = getDataFromSQL($sql, $params);
$average = number_format($salary[0]['Total'], 2);

echo "<div class='center'> <h2 class='nomargin'> Average Player Salary: $ {$average} </h2> </div>";


//send a SQL statement and get results in to teams
$sql = "SELECT a.playerID,m.nameLast,m.nameFirst FROM appearances a JOIN master m on m.playerID=a.playerID where a.teamID=:teamID and a.yearID=:yearID ORDER BY m.nameLast,m.nameFirst";
$params = [":teamID" => $teamID, ":yearID" => $yearID];
$players = getDataFromSQL($sql, $params);

echo "<div class= 'center'>";
foreach ($players as $player) {
    echo "<a class='players' href='player.php?playerID=" . $player["playerID"] . "'>";
    echo $player["nameFirst"] . " " . $player["nameLast"];
    echo "</a> ";
    echo "<BR>";
}
echo "</div>";


include "includes/footer.php";

?>