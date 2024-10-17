<?php
session_start();
include("../includes/config.php");
include("../includes/header.php");

$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirmPass = trim($_POST['confirmPass']);
if ($password !== $confirmPass) {
    $_SESSION['message'] = 'passwords do not match';
    header("Location: register.php");
    exit();
}
$password = sha1($password);
$sql = "INSERT INTO users (email,password) VALUES('$email', '$password')";

$result = mysqli_query($conn, $sql);
if ($result ) {
    $_SESSION['userId'] = mysqli_insert_id($conn);
    header("Location: profile.php");
}
