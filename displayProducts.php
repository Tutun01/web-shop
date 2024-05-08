<?php

    require_once "model/database.php";

    $q = "SELECT * FROM products";
    $result = $database ->query($q);

    $products = $result-> fetch_all(MYSQLI_ASSOC);

    ?>

<!doctype html>

<html lang="">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>List of products</title>
    </head>
    <body>
            <a href="displayProducts.php">Main</a>

            <?php if(!isset($_SESSION['loggedIn'])): ?>
                <a href="logout.php">Logout</a>
                <a href="productSearch.php">Product Search</a>
                <a href="myBasket.php">Basket</a>
            <?php else: ?>
                <a href="registration.php">Login</a>

            <?php endif; ?>



        <?php foreach ($products as $product):  ?>
            <div>
                <h1> <?=$product['name'] ?> </h1>
                <p> <?= $product['description']?> </p>
                <p>Price: <?= $product['price']?> </p>
                <p>In stock: <?= $product['quantity']?> </p>

                <?php if($product['quantity'] == 0): ?>
                    <p>Not available</p>
                <?php else: ?>
                    <p>Is available</p>
                <?php endif; ?>

                <a href="lookProduct.php?id=<?= $product['id'] ?>">Look at the product</a>
        <?php endforeach; ?>


    </body>

</html>
