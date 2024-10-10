<?php
session_start();

include('./includes/header.php');
include('./includes/config.php');
// print_r($_POST);
if (isset($_POST["type"]) && $_POST["type"] == 'add' && $_POST["item_qty"] > 0) {
    foreach ($_POST as $key => $value) { //add all post vars to new_product array
        $new_product[$key] = $value;
    }
    print_r($new_product);
    unset($new_product['type']);

    $sql =  "SELECT i.item_id AS itemId, description, img_path, sell_price FROM item i INNER JOIN stock s USING (item_id) WHERE i.item_id = 
    {$new_product['item_id']} ";
    echo $sql;
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    echo "<p>There are currently $num_rows rows in the table</p>";
    $row = mysqli_fetch_assoc($result);
    $new_product["item_name"] = $row['description'];
    $new_product["item_price"] = $row['sell_price'];
    // print_r($new_product);
    if (isset($_SESSION["cart_products"])) {
        if (isset($_SESSION["cart_products"][$new_product['item_id']])) {
            unset($_SESSION["cart_products"][$new_product['item_id']]);
        }
    }
    $_SESSION["cart_products"][$new_product['item_id']] = $new_product;
    echo "print <pre>";
    print_r($_SESSION);
    echo "print </pre>";
    
}
header('Location: index.php');
