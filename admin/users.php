<?php
session_start();
include("../includes/config.php");
include("../includes/header.php");

$sql = "SELECT * FROM users u  ORDER BY total DESC";
$result = mysqli_query($conn, $sql);
$itemCount = mysqli_num_rows($result);

