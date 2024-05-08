<?php

    if (!isset ($_GET['id']) || empty($_GET['id'])) {
        die ("Product id is missing");
    }

    require_once "model/database.php";

    $productID = $_GET ['id'];

    $query = "SELECT * FROM products WHERE id = $productID";
    $result = $database->query($query);

    if ($result->num_rows == 0) {
        die ("The product does not exist");
    }

    $product = $result->fetch_assoc();

    if( session_status()==PHP_SESSION_NONE)
    {
        session_start();
    }
    ?>

    <!doctype html>

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>More about the product</title>
    </head>
    <body>
        <h1><?= $product['name'] ?> </h1>
        <p> <?= $product['description'] ?> </p>
        <p>Price: <?= $product['price']?> </p>


        <?php if($product['quantity'] == 0): ?>
            <p>Not available</p>
        <?php else: ?>
            <p>Is available</p>
        <?php endif; ?>

        <?php if (isset($_SESSION['loggedIn'])): ?>
            <form method="POST" action="basket.php">
                <input type="number" name="quantity" placeholder="Enter a quantity of product">
                <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                <button>Add to cart</button>
            </form>
        <?php else: ?>
            <a href="registration.php">Click to login</a>
        <?php endif; ?>
    </body>

    </html>
