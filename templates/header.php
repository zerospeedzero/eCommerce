<?php include("./functions/db.php");?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo defined('TITLE') ? TITLE : "ReadyTECh"?></title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <div class="loader-container">
        <div class="spinner"></div>
    </div>
    <script src="./javascripts/spinner.js"></script>
    <header class="banner">
      <img class="logo" src="./icons/logo.png" alt="Ready TECH logo">
      <nav id="nav">
        <ul>
          <li id="home" class="menu activemenu"><a href="./index.php">Home</a></li>
          <li id="browse" class="menu" ><a href="./browse.php">Browse</a></li>
          <!-- <li id="product" class="menu" ><a href="./product.php">Product</a></li> -->
          <li id="cart" class="menu" ><a href="./cart.php">Cart</a></li>
        </ul>
      </nav>
      <div class="icon">
        <a onclick="dropdown()"><img alt="mobile icon" src="./icons/mobile.png"></a>
        <div id="dropdown-content" class="dropdown-content">
          <a href="./index.php">Home</a>
          <a href="./browse.php">Browse</a>
          <!-- <a href="./product.php">Product</a> -->
          <a href="./cart.php">Cart</a>
        </div>
      </div>
      <script src="./javascripts/dropdown.js"></script>
      <script src="./javascripts/activemenu.js"></script>
    </header>