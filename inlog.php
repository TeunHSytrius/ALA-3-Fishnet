<?php
include 'config/conn.php';
include 'config/header.php';
include 'config/body.php';

//it will start the session 
session_start();
$username = "";
if (isset($_POST["login"])) {
    $melding = "";
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
}


try {
    //here it will select the username from the table user in the database 
    $sql = "SELECT * FROM `user` WHERE `username` = :username ";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(":username" => $username));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $passwordDB = $result["password"];

        // it will check the password and compare it 
        if (password_verify(@$password,  $passwordDB)) {

            $_SESSION["id"] = session_id();
            $_SESSION["USER_ID"] = $result["id"];
            $_SESSION["username"] = $result["username"];
            $_SESSION["is_admin"] = $result["is_admin"];

            echo "<script>location.href='main.php';</script>";
        } else {
            echo "<br>Gebruikersnaam of wachtwoord is fout";
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>

<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="form_login">
        <!-- the form with information to be posted  -->
        <form action="" method="POST">
            <label>Gebruikersnaam:</label>
            <input type="text" vlaue="username" name="username">
            <label>Wachtwoord:</label>
            <input type="password" vlaue="password" name="password">
            <input style="cursor:pointer; width:4em;" type="submit" name="login" value="login">

        </form>
        <div class="twobtns">
            <a href="register.php"><button> Registreren </button></a>
            <a href="forget.php"><button> Wachtwoord vergeten!</button></a>
        </div>
    </div>
</body>

</html>