<?php
session_start();

include("../includes/header.php");
include("../includes/config.php");
if (isset($_POST['submit'])) {
  
    $email = trim($_POST['email']);
    $pass = sha1(trim($_POST['password']));
    $sql = "SELECT user_id, email, role FROM users WHERE email=? AND password=? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $email, $pass);
    mysqli_stmt_execute($stmt);
    // $result = mysqli_query($conn, $sql);
    // var_dump($result);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $user_id, $email, $role);
    if (mysqli_stmt_num_rows($stmt) === 1) {
        mysqli_stmt_fetch($stmt);
       
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;
        header("Location: ../index.php");
    } else {
        $_SESSION['message'] = 'wrong email or password';
    }
}

?>
<div class="row col-md-8 mx-auto ">
    <?php include("../includes/alert.php"); ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <!-- Email input -->
        <div class="form-outline mb-4">
            <input type="email" id="form2Example1" class="form-control" name="email" />
            <label class="form-label" for="form2Example1">Email address</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <input type="password" id="form2Example2" class="form-control" name="password" />
            <label class="form-label" for="form2Example2">Password</label>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4" name="submit">Sign in</button>

        <!-- Register buttons -->
        <div class="text-center">
        <p>Not a member? <a href="register.php">Register</a></p>
        </div>

    </form>
</div>
<?php
include("../includes/footer.php");
?>