<?php
//gestion des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//connecter bdd
$pdo = mysqli_connect("localhost", "root", "proot", "simplon_test");

//insérer csv dans bdd
if(isset($_POST["submit"])) {
    if($_FILES['file']['name']) {
        $filename = explode(".", $_FILES['file']['name']);
        if($filename[1] == 'csv') {
            $handle = fopen($_FILES['file']['tmp_name'], "r");
            while($data = fgetcsv($handle)) {
                $item1 = mysqli_real_escape_string($pdo, $data[0]);
                $item2 = mysqli_real_escape_string($pdo, $data[1]);
                $item3 = mysqli_real_escape_string($pdo, $data[2]);
                $item4 = mysqli_real_escape_string($pdo, $data[3]);
                $item5 = mysqli_real_escape_string($pdo, $data[4]);
                $item6 = mysqli_real_escape_string($pdo, $data[5]);
                $item7 = mysqli_real_escape_string($pdo, $data[6]);
                $item8 = mysqli_real_escape_string($pdo, $data[7]);
                $sql = "INSERT INTO people (id, firstname, lastname, email, profession, birthdate, country, phone) Values ('$item1', '$item2', '$item3', '$item4', '$item5', '$item6', '$item7', '$item8')";
                mysqli_query($pdo, $sql);
            }
            fclose($handle);
            print "Succès !";
        }
    }
}


// form html
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import.csv</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <div>
            <p>Importer CSV: <input type="file" name="file" /></p>
            <p><input type="submit" name="submit" value="import" /></p>
        </div>
    </form>
</body>
</html>