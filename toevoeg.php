<?php

//!Important don't remove!
require 'config/body.php';
include_once 'config/conn.php';
include_once 'config/header2.php';



if (isset($_POST['btnSubmit'])) {

    echo "<h1>POST</h1><pre>" . print_r($_POST, true) . "</pre>";

    foreach ($_POST as $key => $value)
        $$key = $value;


    $sql = " INSERT INTO movie (title, url, year, description, cover)
                VALUES (:title, :url, :year, :description, :cover)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ":title"            => $title,
        ":url"              => $url,
        ":year"             => $year,
        ":description"      => $description,
        ":cover"            => $cover
    ]);


    // exit("<h1>$msg</h1><h1>tempname: $RIKtempname ::: target_dir: $folder</h1>");

    $database = null;
    header("location: ./video.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NETFISH | Toevoegen</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <div id="main" style="margin-top: 10%">
        <br />
        <?php
        if (isset($usermessage)) {
            echo '<label class="text-danger" style="color:red">' . $usermessage . '</label>';
        }
        ?>
        <form id="form_toevoegen" action="" method="post" enctype="multipart/form-data">
            <label>Titel: </label>
            <input type="text" name="title" class="form" required />
            <br />
            <label>Video-Url: </label>
            <input type="text" name="url" class="form" required />
            <br />
            <label>Cover afbeelding: </label>
            <input type="text" name="cover" class="form" required />
            <br />
            <label>Jaar: </label>
            <input type="text" name="year" class="form" required />
            <br />
            <label>Beschrijving: </label>
            <input type="text" name="description" class="form" required />
            <br />
            <input type="submit" name="btnSubmit" class="btn" value="Toevoegen" style="margin-right: 80%; cursor: pointer">
        </form>
    </div>
</body>

</html>