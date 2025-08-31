<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <label for="">Product Name: <?php echo htmlspecialchars($_POST["product_name"]); ?></label><br>
    <label for="">Category: <?php echo htmlspecialchars($_POST["category"]); ?></label><br>
    <label for="">Price: ₱<?php echo number_format($_POST["price"], 2); ?></label><br>
    <label for="">Stock Quantity: <?php echo htmlspecialchars($_POST["stock_quantity"]); ?></label><br>
    <label for="">Expiration Date: <?php echo date("M-d-Y", strtotime($_POST["expiration_date"])); ?></label><br>
    <label for="">Status: <?php echo htmlspecialchars($_POST["status"]); ?></label><br>
</body>
</html>