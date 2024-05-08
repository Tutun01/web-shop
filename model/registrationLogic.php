<?php

    if (!isset($_POST['email']) || empty($_POST['email']) )
    {
        die("You have not entered an email!");
    }

    if (!isset($_POST['password'])  || empty($_POST['password']) )
    {
        die("You have not entered a password!");
    }

    $email = $_POST['email'];
    $password =password_hash($_POST['password'],PASSWORD_BCRYPT);

    require_once "database.php";

    $query =  "SELECT * FROM users WHERE email = '$email'";
    $result = $database-> query($query);

if ($result-> num_rows == 1) {
    $user = $result->fetch_assoc();


    //Poredimo podatak $sifra iz forma (sifra iz forme 12345)
    // sa podatkom iz baze
    $validPass = password_verify($_POST['password'], $user['password']);

    if ($validPass == true) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['loggedIn'] = true;
        $_SESSION['user_id'] = $user['id'];

        header("Location: ../displayProducts.php");
    } else {
        echo "The code is not correct";
    }
}



