<?php
session_start();
include('../includes/header.php');
include('../includes/config.php');
//CREATE VIEW  salesPerOrder as SELECT o.orderinfo_id, SUM(i.sell_price * ol.quantity), o.status FROM orderinfo o INNER JOIN orderline ol using (orderinfo_id) INNER JOIN item i USING (item_id)
// GROUP BY o.orderinfo_id;
// $sql = "SELECT o.orderinfo_id as orderId, SUM(i.sell_price * ol.quantity) as total FROM orderinfo o INNER JOIN orderline ol using (orderinfo_id) INNER JOIN item i USING (item_id)
// GROUP BY o.orderinfo_id";

//order details


$sql = "SELECT * FROM `salesperorder` ORDER BY total DESC";
$result = mysqli_query($conn, $sql);
$itemCount = mysqli_num_rows($result);

?>
<h2>number of items <?= $itemCount ?> </h2>
<?php include("../includes/alert.php"); ?>
<table class="table table-striped table-bordered">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";

        echo "<td>{$row['orderId']}</td>";
        echo "<td>{$row['total']}</td>";
        if($row['status'] === 'Delivered') {
            echo "<td style='color: green'>{$row['status']}</td>";
        }
        else {
            echo "<td style='color: red'>{$row['status']}</td>";

        }
        if($row['status'] === 'Delivered') {
            echo "<td><i class='fa-regular fa-eye' style='color: gray'></i></td>";
        echo "</tr>";
        }

        else {
            echo "<td><a href='orderDetails.php?id={$row['orderId']}'><i class='fa-regular fa-eye' style='color: blue'></i></a></td>";
            echo "</tr>";
        }


        
    }
    ?>
</table>
<?php
include('../includes/footer.php');
?>