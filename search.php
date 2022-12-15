<html>
<?PHP
include "includes/database_functions.php";
include "includes/header.php";
include "includes/navbar.php";
?>

<head>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <style>

    </style>

</head>
<?PHP

$data = $_POST["term"];

echo "<BR>";
$answer = explode(" ", $data);
//print_r($answer);
echo "<BR>";
echo $answer[2];
//send a SQL statement and get results in to teams
$sql = "SELECT m.playerID playerID, m.nameLast,m.nameFirst FROM master m WHERE m.nameFirst LIKE :term OR m.nameLast LIKE :term OR concat(nameFirst,' ',nameLast) LIKE :term ORDER BY m.nameLast,m.nameFirst";
$params = [":term" => '%' . $data . '%'];
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
