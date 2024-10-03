<?php
session_start();
include('../includes/config.php');



if (isset($_POST['submit'])) {
    $cost =  trim($_POST['cost_price']);
    $sell = trim($_POST['sell_price']);
    $desc = trim($_POST['description']);
    $qty = $_POST['quantity'];
    $_SESSION['cost'] = $cost;
    $_SESSION['sell'] = $sell;
    $_SESSION['desc'] = $desc;
    $_SESSION['qty'] = $qty;
    if (empty($_POST['description'])) {
        $_SESSION['descError'] = 'Please input a Product description';

        header("Location: create.php");
    }

    if (empty($_POST['cost_price']) || (! is_numeric($_POST['cost_price']))) {
        $_SESSION['costError'] = 'error product price format';
        header("Location: create.php");
    }
}
