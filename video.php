<?php
//!Important don't remove!
require 'config/body.php';
include_once 'config/conn.php';
include_once 'config/header2.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NETFISH | Video</title>
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <div id="container">
        <?php
        $sql = "SELECT title, url  
                    FROM `movie`";

        $videos = $conn->prepare($sql);

        $videos->execute();


        $str = "<form id='form_video' action='' method='post'><br>";

        $str .= "<table>";
        $str .= "<label>Video's</label><br>";

        while ($row = $videos->fetch(PDO::FETCH_OBJ)) {
            $str .= "<tr>
                            <td></td>
                            <td><a href='{$row->url} 'target='_blank'>$row->title</a></td>
                        </tr>";
        }
        $str .= "</table>";
        $str .= "</form>";

        echo $str;
        ?>
    </div>
</body>

</html>