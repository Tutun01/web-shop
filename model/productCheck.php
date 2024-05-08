<?php

    if (!isset ($_POST['productSearch']) || empty($_POST['productSearch']) ) {
        die ("Product name is missing");
    }

    require_once "database.php";

    $name =  $_POST['productSearch'];

    $query = "SELECT * FROM products WHERE name LIKE '%$name%' ";
    $result = $database->query($query);

    if (!($result -> num_rows >= 1) )
    {
        echo "The user not exist in our database ";
    } else
    {
        echo  "The user exist in our database";
    }










