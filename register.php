<?php
include 'config/conn.php';
include 'config/body.php';
include 'config/header.php';
if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $admin = 0;


    $sql = "INSERT INTO `user` (`id`, `username`, `email`, `password`,`is_admin`) 
                VALUES (NULL, :username, :email, :password, :admin)";
    $stmt = $conn->prepare($sql);
    $userArray = array(
        "username" => $username,
        "email" => $email,
        "password" => $password,
        "admin" => $admin
    );
    $stmt->execute($userArray);
    // als het gelukt is ga verder

    echo "<script>location.href='inlog.php';</script>";
}

?>

<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="rgstrform">
        <!-- the registration form  -->
        <form action="" method="POST">
            <label>naam:</label>
            <input style="background:transparent; border-color:white; color:white;" type="text" name="username" vlaue="username" placeholder="" required>
            <label>E-mail adres: </label>
            <input style="background:transparent; border-color:white; color:white;" type="text" name="email" vlaue="email" placeholder="" required>
            <label>Wachtwoord: </label>
            <input style="background:transparent; border-color:white; color:white;" type="password" name="password" vlaue="password" required>
            <label> Wachtwoord ter controle:</label>
            <input style="background:transparent; border-color:white; color:white;" type="password" vlaue="re_password" required>
            <br>

            <input style="cursor:pointer" type="submit" name="submit" value="Registreer">
        </form>
    </div>
</body>

</html>