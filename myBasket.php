<?php



    if( session_status()==PHP_SESSION_NONE)
    {
        session_start();
    }

    if(!isset($_SESSION['loggedIn']))
    {
        die ("You must be logged in");
    }

    require_once "model/database.php";

    $userId = $_SESSION['user_id'];

    $query = "SELECT * FROM orders WHERE users_id = $userId ";

    $result = $database->query($query);


    $orders = $result -> fetch_all(MYSQLI_ASSOC);


    ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php  if ($result->num_rows == 0): ?>
    <p>You do not have any products in your cart</p>
    <?php else: ?>

        <?php foreach ($orders as $order): ?>
            <div>

                <p>Quantity: <?= $order['quantity'] ?> </p>
                <p>Price: <?= $order['price'] ?> </p>
            </div>

        <?php endforeach; ?>

    <?php endif; ?>


</body>

</html>

