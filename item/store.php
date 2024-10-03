<?php
session_start();
include('../includes/config.php');
$_SESSION['cost'] = trim($_POST['cost_price']);
$_SESSION['sell'] = trim($_POST['sell_price']);
$_SESSION['desc'] = trim($_POST['description']);
$_SESSION['qty'] = $_POST['quantity'];


if (isset($_POST['submit'])) {
    $cost =  trim($_POST['cost_price']);
    $sell = trim($_POST['sell_price']);
    $desc = trim($_POST['description']);
    $qty = $_POST['quantity'];

    if (empty($_POST['description'])) {
        $_SESSION['descError'] = 'Please input a Product description';

        header("Location: create.php");
    }

    if (empty($_POST['cost_price']) || (! is_numeric($cost))) {
        $_SESSION['costError'] = 'error product price format';
        header("Location: create.php");
    }
    if (isset($_FILES['img_path'])) {
        if ($_FILES['img_path']['type'] == "image/jpeg" || $_FILES['img_path']['type'] == "image/jpg" || $_FILES['img_path']['type'] == "image/png") {
            $source = $_FILES['img_path']['tmp_name'];
            $target = 'images/' . $_FILES['img_path']['name'];
            move_uploaded_file($source, $target) or die("Couldn't copy");
        } else {
            $_SESSION['imageError'] = "wrong file type";
            header("Location: create.php");
        }
    }

    $sql = "INSERT INTO item(description, cost_price, sell_price, img_path) VALUES('{$desc}', '{$cost}', '{$sell}','{$target}')";

    $result = mysqli_query($conn, $sql);

    $q_stock = "INSERT INTO stock(item_id, quantity) VALUES(LAST_INSERT_ID(), {$qty})";
    $result2 = mysqli_query($conn, $q_stock);
    if($result && $result2) {
        header("Location: index.php");
    }
}
