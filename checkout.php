<?php
session_start();
include("./functions/db.php");
$in_clause = '';
$products_purchased = '';
if (!empty($_POST['customer'])&&!empty($_POST['email'])&&!empty($_POST['total']))
{
  $dbc = connectDB();
  foreach ($_SESSION["carts"] as $id => $quantity) {
    $in_clause = $id . ', ' . $in_clause;
  }
  $in_clause = '(' . substr($in_clause, 0, -2) . ')';
  if (!isError($dbc)) {
    $r = queryRecord($dbc, "select id, name from products where id in " . $in_clause);
    while ($row = mysqli_fetch_array($r)) {
      $products_purchased = $products_purchased . $row['name'] . '[Quantity:' . $_SESSION["carts"][$row['id']] .'], '; 
    }
    $products_purchased = substr($products_purchased, 0, -2);
    $r = queryRecord($dbc, "insert into orders (customer_name, email, products_purchased, total_cost) VALUES ('" . remove_abnormal_string($_POST['customer'],$dbc) . "','" . remove_abnormal_string($_POST['email'], $dbc) . "','" . remove_abnormal_string($products_purchased, $dbc) . "','" . remove_abnormal_string($_POST['total'],$dbc) . "')");
    if (!isError($dbc)) {
      $_SESSION["carts"] = null;
    }
  }
  closeDB($dbc);  
}
header("Location: ./index.php");
?>