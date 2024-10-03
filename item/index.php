<?php
session_start();
include('../includes/adminHeader.php');
include('../includes/config.php');
// if (!isset($_SESSION['user_id'])) {
//     $_SESSION['message'] = "please Login to access the page";
//     header("Location: ../user/login.php" );
// }
// echo $_GET['search'];
if(isset($_GET['search'])) {
    $keyword = strtolower(trim($_GET['search']));
}
else {
    $keyword = '';
}


if ($keyword) {
    $sql = "SELECT * FROM item WHERE description LIKE '%{$keyword}%'";
    $result = mysqli_query($conn, $sql);
} else {
    $sql = "SELECT * FROM item";
    $result = mysqli_query($conn, $sql);
}
// $artists = mysqli_fetch_assoc($result);
// var_dump($artists);
$itemCount = mysqli_num_rows($result);
?>


<body>
    <a href="create.php" class="btn btn-primary btn-lg " role="button" aria-disabled="true">Add artist</a></p>
    <h2>number of items <?=$itemCount ?> </h2>
    <table class="table table-striped table-bordered">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><img src='{$row['img_path']}' width='150' height='150' /> </td>";
            echo "<td>{$row['item_id']}</td>";
            echo "<td>{$row['description']}</td>";
            echo "<td>{$row['sell_price']}</td>";
            echo "<td>{$row['cost_price']}</td>";

            echo "<td><a href='edit.php?id={$row['item_id']}'><i class='fa-regular fa-pen-to-square' style='color: blue'></i></a><a href='delete.php?id={$row['item_id']}'><i class='fa-solid fa-trash' style='color: red'></i></a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>