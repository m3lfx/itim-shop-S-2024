<?php
session_start();
include('./includes/header.php');
include('./includes/config.php');
$keyword = strtolower(trim($_GET['search']));
echo $keyword;
$sql = "SELECT item_id, description, img_path, sell_price 
        FROM item 
        WHERE description LIKE '%{$keyword}%' ORDER BY item_id DESC";
echo $sql;
$results = mysqli_query($conn, $sql);

if ($results) {
    $products_item = '<ul class="products">';

    //fetch results set as object and output HTML
    while ($row = mysqli_fetch_assoc($results)) {
        $products_item .= <<<EOT
     <li class="product">
    <form method="POST" action="cart_update.php">
    <div class="product-content"><h3>{$row['description']}</h3>
    <div class="product-thumb"><img src="./item/{$row['img_path']}" width="50px" height="50px"></div>
    <div class="product-info">
    Price {$row['sell_price']} 
    <fieldset>
    
    <label>
        <span>Quantity</span>
        <input type="number" size="2" maxlength="2" name="item_qty" value="1" />
    </label>
    </fieldset>
    <input type="hidden" name="item_id" value="{$row['item_id']}" />
    <input type="hidden" name="type" value="add" />
    
    <div align="center"><button type="submit" class="add_to_cart">Add</button></div>
    </div></div>
    </form>
    </li>
EOT;
    }

    $products_item .= '</ul>';
    echo $products_item;
}
?>
