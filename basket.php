<?php

    if( session_status()==PHP_SESSION_NONE)
    {
        session_start();
    }

    if(!isset($_POST['productId']) || empty($_POST['productId']))
    {
        die ("Missing product id");
    }

    if(!isset($_POST['quantity']) || empty($_POST['quantity']))
    {
        die ("Quantity is missing");
    }

    require_once "model/database.php";

    $productID = $_POST['productId'];
    $quantity = $_POST['quantity'];
    $userID = $_SESSION['user_id'];

    $result = $database -> query("SELECT price FROM products WHERE id = $productID ");

     $lineFromBase = $result->fetch_assoc();
     $price = $lineFromBase['price'];
     $price = $price * $quantity;

    $productID = $database->real_escape_string($productID);
    $quantity = $database->real_escape_string($quantity);
    $userID = $database->real_escape_string($userID);
    $price = $database->real_escape_string($price);


    $database->query("INSERT INTO orders (product_id, users_id, price, quantity) VALUES ($productID, $userID, $price, $quantity)");

    header("Location: displayProducts.php");





