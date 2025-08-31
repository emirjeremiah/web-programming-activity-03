<?php
// Initialize values and error variables
$product_name = "";
$product_name_error = "";

$category = "";
$category_error = "";

$price = "";
$price_error = "";

$stock_quantity = "";
$stock_quantity_error = "";

$expiration_date = "";
$expiration_date_error = "";

$status = "";
$status_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Product Name
    $product_name = trim($_POST["product_name"] ?? "");
    if (empty($product_name)) {
        $product_name_error = "Product name is required";
    } else {
        $product_name = htmlspecialchars($product_name);
    }

    // Category
    $category = trim($_POST["category"] ?? "");
    if (empty($category)) {
        $category_error = "Category is required";
    } else {
        $category = htmlspecialchars($category);
    }

    // Price
    $price = trim($_POST["price"] ?? "");
    if ($price === "") {
        $price_error = "Price is required";
    } elseif (!is_numeric($price)) {
        $price_error = "Price must be a number";
    } elseif (floatval($price) == 0) {
        $price_error = "Price cannot be zero";
    } else {
        $price = number_format(floatval($price), 2, '.', '');
    }

    // Stock Quantity
    $stock_quantity = trim($_POST["stock_quantity"] ?? "");
    if ($stock_quantity === "") {
        $stock_quantity_error = "Stock quantity is required";
    } elseif (!is_numeric($stock_quantity)) {
        $stock_quantity_error = "Stock quantity must be a number";
    } elseif (intval($stock_quantity) < 0) {
        $stock_quantity_error = "Stock quantity cannot be negative";
    } else {
        $stock_quantity = intval($stock_quantity);
    }

    // Expiration Date
    $expiration_date = $_POST["expiration_date"] ?? "";
    if (empty($expiration_date)) {
        $expiration_date_error = "Expiration date is required";
    } elseif (strtotime($expiration_date) < strtotime(date("Y-m-d"))) {
        $expiration_date_error = "Expiration date cannot be in the past";
    }

    // Status
    $status = $_POST["status"] ?? "";
    if (empty($status)) {
        $status_error = "Status is required";
    }

    // Redirect if no errors
    if (
        empty($product_name_error) &&
        empty($category_error) &&
        empty($price_error) &&
        empty($stock_quantity_error) &&
        empty($expiration_date_error) &&
        empty($status_error)
    ) {
        header("Location: redirect.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Product Form</title>
<style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f5f7fa;
        margin: 0;
        padding: 40px 20px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
    }

    form {
        background: #fff;
        padding: 30px 40px;
        border-radius: 8px;
        max-width: 480px;
        width: 100%;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
        font-weight: 700;
        font-size: 1.8rem;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: #222;
        font-size: 1rem;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    select {
        width: 100%;
        padding: 10px 14px;
        border: 1.8px solid #ccc;
        border-radius: 6px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
        outline-offset: 2px;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    input[type="date"]:focus,
    select:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 4px #007bff;
    }

    .radio-group {
        margin-bottom: 12px;
    }

    .radio-group input[type="radio"] {
        margin-right: 8px;
        transform: scale(1.1);
        vertical-align: middle;
    }

    .radio-group label {
        display: inline-block;
        margin-right: 20px;
        font-weight: 500;
        color: #444;
        cursor: pointer;
        font-size: 1rem;
    }

    .error {
        color: #d93025;
        margin: 4px 0 14px 0;
        font-size: 0.9rem;
        font-weight: 600;
        min-height: 20px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: white;
        font-weight: 700;
        border: none;
        padding: 12px 0;
        width: 100%;
        border-radius: 7px;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 10px;
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.4);
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 14px rgba(0, 86, 179, 0.6);
    }

    /* Responsive tweaks */
    @media (max-width: 520px) {
        form {
            padding: 25px 20px;
        }
    }
</style>
</head>
<body>
    <!-- The page just reloads itself and nothing happens -->
    <form action="" method="post" novalidate>
        <h1>Product Entry Form</h1>

        <label for="product_name">Product Name:</label>
        <input id="product_name" type="text" name="product_name" value="<?php echo $product_name; ?>">
        <p class="error"><?php echo $product_name_error; ?></p>

        <label for="category">Category:</label>
        <select id="category" name="category">
            <option value="">-- Select Category --</option>
            <option value="Category A" <?php if ($category === "Category A") echo "selected"; ?>>Category A</option>
            <option value="Category B" <?php if ($category === "Category B") echo "selected"; ?>>Category B</option>
            <option value="Category C" <?php if ($category === "Category C") echo "selected"; ?>>Category C</option>
            <option value="Category D" <?php if ($category === "Category D") echo "selected"; ?>>Category D</option>
        </select>
        <p class="error"><?php echo $category_error; ?></p>

        <label for="price">Price (&#8369;):</label>
        <input id="price" type="number" name="price" step="0.01" value="<?php echo $price; ?>">
        <p class="error"><?php echo $price_error; ?></p>

        <label for="stock_quantity">Stock Quantity:</label>
        <input id="stock_quantity" type="number" name="stock_quantity" min="0" value="<?php echo $stock_quantity; ?>">
        <p class="error"><?php echo $stock_quantity_error; ?></p>

        <label for="expiration_date">Expiration Date:</label>
        <input id="expiration_date" type="date" name="expiration_date" value="<?php echo $expiration_date; ?>">
        <p class="error"><?php echo $expiration_date_error; ?></p>

        <label>Status:</label>
        <div class="radio-group">
            <label>
                <input type="radio" name="status" value="active" <?php if ($status === "active") echo "checked"; ?>> Active
            </label>
            <label>
                <input type="radio" name="status" value="inactive" <?php if ($status === "inactive") echo "checked"; ?>> Inactive
            </label>
        </div>
        <p class="error"><?php echo $status_error; ?></p>

        <input type="submit" value="Save Product">
    </form>
</body>
</html>