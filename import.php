<?php
// connecter DB
$dbhost = "localhost";
$dbname = "simplon_test";
$dbchar = "utf8";
$dbuser = "root";
$dbpass = "proot";

$pdo = new PDO(
    "mysql:host = $dbhost; dbname = $dbname; charset = $dbchar", $dbuser, $dbpass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
);

//lecture fichier csv
$fh = fopen($_FILES["upcsv"]["tmp_name"], "r");
if($fh === false) {
    exit("Erreur lors de l'importation du fichier.");
}

//importation des fichiers ligne par ligne
while(($ligne = fgetcsv($fh)) !== false) {
    try {
        $stmt = $pdo->prepare("INSERT INTO `people` (`id`, `firstname`, `lastname`, `email`, `profession`, `birthdate`, `country`, `phone`) VALUES (?, ?, ?, ?, ?, ?, ?, ?");
        $stmt->execute([
            $ligne[0], $ligne[1], $ligne[2], $ligne[3], $ligne[4], $ligne[5], $ligne[6], $ligne[7]
        ]);
    } catch(Exception $ex) {
        echo $ex->getMessage();
    }
}

//DONE !
fclose($fh);
echo "FAIT !";