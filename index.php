<?php

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
$STH = $DBH->prepare("SELECT * FROM tbl_produkter");


//Utför frågan
$STH->execute();
//Stänger databaskopplingen
$DBH = null;
//Hämta alla produkter i en array
$results = $STH->fetchAll();

?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <?php
        // loopa igenom produkter och skriv ut länkar
        foreach($results as $product){

            ?>
            <a href="produkt.php?produktid=<?php echo $product["id"]; ?>">
                <img src="<?php echo $product["bildfil"]; ?>" width="200" height="150">
                <?php echo $product["titel"]; ?></a>
                <?php echo $product["pris"] . ":-" . " " . "Lagersaldo" . " " . "x" . $product["lagersaldo"]; ?><br><br>
            <?php

        }
    ?>
</body>
</html>