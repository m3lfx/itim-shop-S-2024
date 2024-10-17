<?php
session_start();
include("../includes/config.php");
include("../includes/header.php");

$status =$_POST['status'];



$sql = "UPDATE orderinfo SET status = '{$status}' WHERE orderinfo_id = {$_SESSION['orderId']}";

$result = mysqli_query($conn, $sql);
if ($result ) {
    $_SESSION['message'] = 'order updated';
    header("Location: orders.php");
}
