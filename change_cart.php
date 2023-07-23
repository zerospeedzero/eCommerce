<?php
  session_start();
  // var_dump($_GET);
  // Initialize carts array if not exist
  if (!isset($_SESSION["carts"])) { $_SESSION["carts"] = [];}

  // If add parameter is defined, include existing quantity into final quantity
  if (isset($_GET["add"]) && isset($_SESSION["carts"][$_GET["id"]])) { $existing_quantity = $_SESSION["carts"][$_GET["id"]];} else {$existing_quantity = 0;}
  
  // Change the cart quantity
  if (isset($_GET["quantity"]) && isset($_GET["id"]) && is_numeric($_GET["quantity"]) && is_int((int)$_GET["quantity"]) && (int)$_GET["quantity"] >= 0 ) {
    $_SESSION["carts"][$_GET["id"]] = ($_GET["quantity"] == 0) ? null : $_GET["quantity"] + $existing_quantity;
    if ($_SESSION["carts"][$_GET["id"]] == null) {unset($_SESSION["carts"][$_GET["id"]]);}
  }
  // var_dump($_SESSION["carts"]);
  header("Location: ./cart.php");
?>