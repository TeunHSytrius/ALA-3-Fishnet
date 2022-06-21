<?php
include 'config/conn.php';
if (isset($_POST['btnSubmit'])) {
    if ($_POST['password'] !== $_POST['password2']) {
        $usermessage = "Het wachtwoord moet hetzelfde zijn.";
    } else {
        echo "<pre>" . print_r($_POST, true) . "</pre>";

        foreach ($_POST as $key => $value)
            $$key = $value;

        $sql = " INSERT INTO user (username, email, password)
                    VALUES (:username, :email, :password )";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":username"        => $username,
            ":email"           => $email,
            ":password"        => $password
        ]);

        $database = null;

        header("location: ./login.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    include 'config/header.php';
    include 'config/body.php';
    ?>
    <title>NETFISH | Registreren</title>
</head>

<body id="registreren">

    <div id="main" style="margin-top: 10%;">
        <br />
        <?php
        if (isset($usermessage)) {
            echo '<label class="text-danger" style="color:red">' . $usermessage . '</label>';
        }
        ?>
        <form method="post" id="form_register">
            <label>Naam: </label>
            <input type="text" name="name" required />
            <br />
            <label>Gebruikersnaam: </label>
            <input type="text" name="username" required />
            <br />
            <label>Email: </label>
            <input type="email" name="email" required />
            <br />
            <label>Wachtwoord: </label>
            <input type="password" name="password" required />
            <br />
            <label>Wachtwoord ter controle: </label>
            <input type="password" name="password2" required />
            <br />
            <input type="submit" name="btnSubmit" id="btn_register" value="Registreren">
        </form>
    </div>
</body>

</html>