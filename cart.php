<?php session_start();define('TITLE', 'Cart | ReadyTECT'); include('templates/header.php');?>
<?php
  $products = [];
  $subtotal = 0;
  $tax = 0;
  $total = 0;
  $message = "";
  $fmt = numfmt_create("en_CA", NumberFormatter::CURRENCY);
  $dbc = connectDB();
  if (!isError($dbc)) {
    $r = queryRecord($dbc, "select id, name, price, thumbnail_image, description from products");
    if (!isError($r)) {
      while ($row = mysqli_fetch_array($r)) {
        $products[$row["id"]] = [$row["name"], $row["price"], $row["thumbnail_image"], $row["description"] ];
      }
    } else {$message = "<p>$r</p>";}
  } else {$message = "<p>$dbc</p>";}
  closeDB($dbc);
?>  
<main>
  <h2>Shopping Cart</h2>
  <div class="flex-container flex-cart">
    <div class="cartlist">
      <?php
        // var_dump($products);
        if (isset($_SESSION["carts"])) {
          foreach ($_SESSION["carts"] as $id => $quantity) {
            echo
            "<div class=\"flex-container cart\">" .  
              "<figure>" . 
                "<figcaption>" . $products[$id][0] . "</figcaption>" .
                "<img class=\"fade-in\" src=\"./thumbnails/" . $products[$id][2] . "\"" . "alt=\"" . $products[$id][0]  . "\">" .
              "</figure>" .
              "<section class=\"description\">" .
                "<h3>Description</h3>" .  
                $products[$id][3] .
              "</section>" .
              "<section class=\"price\">" .
                "<h3>Price</h3>" .
                "<p>Unit Price: " . numfmt_format($fmt,$products[$id][1]) . "</p>" .
                  "<input name=\"id\" type=\"hidden\" value=\"". $products[$id][0] . "\"/>" .
                  // "<label class=\"quantitylabel\" for=quantity>Quantity: </label><input type=\"number\" class=\"fixedquantity\" name=quantity min=1 value=" . $quantity . " disabled</input>" . 
                  "<label class=\"quantitylabel\" for=quantity>Quantity: </label><span class=\"fixedquantity\">" . $quantity . "</span>" . 
              "</section>" .  
              "<a class=\"deletecart\" href=\"./change_cart.php?id=" . $id . "&quantity=0\">X</a>" .
            "</div>";
            $subtotal = $subtotal + $products[$id][1] * $quantity;
          }      
        } /* else { */
        //   echo "<p class=\"message\">Empty cart</p>";
        // }
      ?>
    </div>
    <div class="shipping">
      <div class="totalcost">
        <h3>Price</h3>
        <span>Subtotal : <?php echo numfmt_format($fmt, $subtotal);?></span>
        <span>GST : <?php $tax = $subtotal * 0.05; echo numfmt_format($fmt, $tax);?></span>
        <span>Grand total : <?php $total = $subtotal + $tax;echo numfmt_format($fmt, $subtotal + $tax);?></span>
      </div>
      <form method="post" action="./checkout.php">
        <fieldset>
          <legend>Customer information</legend>
          <label for="customer">Customer name</label>
          <input type=text id="customer" name="customer" required>
          <input type=hidden name="total" value=<?php echo $total?>>
          <label for="email">Email address</label>
          <input type=email id="email" name="email" required>
          <input type=submit value="Checkout">
        </fieldset>
      </form>
    </div>
  </div>
</main>
<?php include('templates/footer.php'); ?>