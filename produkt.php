<?php

$produktid = $_GET['produktid'];

//Variabler för databaskoppling
$dbhost     = "localhost";
$dbname     = "webbshop";
$dbuser     = "root";
$dbpass     = "";
//Koppla till databasen
$DBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
// Välj felhantering (här felsökningsläge)
$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
// Förbered databasfråga med placeholders (markerade med : i början)
$STH = $DBH->prepare("SELECT * FROM tbl_produkter WHERE ID = :id");

$STH->bindParam(':id', $produktid);

//Utför frågan
$STH->execute();
//Stänger databaskopplingen
$DBH = null;
//Hämtar rätt produkt
$row = $STH->fetch();

?>

<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <h1><?php echo $row['titel'] . " " . $row['pris'] . ':- SEK';?></h1>
    <br>
    <br>
    <p> <?php echo $row['beskrivning']; ?></p>
    <img src='<?php echo $row['bildfil']; ?>'><br>
    <br>
    <p><?php echo $row['lagersaldo'] ?></p>
 </body>
</html>