<?php
include 'config/header.php';
include 'config/body.php';
session_start();
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=netfish", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";


    if (isset($_POST["login"])) {
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            $message = '<label style="color:red">Alle velden moeten ingevuld zijn</label>';
        } else {
            $query = "SELECT * FROM user WHERE username = :username AND password = :password";
            $statement = $conn->prepare($query);
            $statement->execute(
                array(
                    'username'     =>     $_POST["username"],
                    'password'     =>     $_POST["password"]
                )
            );
            $count = $statement->rowCount();
            if ($count > 0) {
                $_SESSION["username"] = $_POST["username"];
                header("location:index.php");
            } else {
                $message = '<label style="color:red">Vul een geldig account in</label>';
            }
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>NETFISH | Inloggen</title>
</head>

<body>

    <div id="main" style="margin-top: 10%;">
        <br />
        <?php
        if (isset($message)) {
            echo '<label style="display:inline-block;" class="text-danger">' . $message . '</label>';
        }
        ?>
        <form method="post" id="form_login">
            <label>Gebruikersnaam</label>
            <input type="text" name="username" class="options" />
            <br />
            <label>Wachtwoord</label>
            <input type="password" name="password" class="options" />
            <br />
            <input type="submit" name="login" id="btn_login" value="Login">

        </form>
    </div>
</body>

</html>