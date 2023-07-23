<?php define('TITLE', 'Product | ReadyTECT'); include('templates/header.php');?>
<main>
  <h2>Product details</h2>
  <?php
    $dbc = connectDB();
    $fmt = numfmt_create("en_CA", NumberFormatter::CURRENCY);
    if (!isError($dbc)) {
      mysqli_set_charset($dbc, 'utf8');
      if (!empty($_GET['id'])) {
        $id = mysqli_real_escape_string($dbc, trim(strip_tags($_GET["id"])));
        $r = queryRecord($dbc, "SELECT id, name, price, full_size_image, description, category from products where id = " . $id);
        if (!isError($r)) {
          while ($row = mysqli_fetch_array($r)) {
            echo
            "<div class=\"flex-container product\">" .  
              "<figure>" . 
                "<figcaption>" . $row['name'] . "</figcaption>" .
                "<img class=\"fade-in\" src=\"./images/" . $row['full_size_image'] . "\"" . " alt=\"" . $row['name']  . "\">" .
              "</figure>" .
              "<section>" .
                "<h3>Description</h3>" .  
                $row['description'] .
                "<p>Unit Price: " . numfmt_format($fmt, $row['price']) . "</p>" .
                "<form method=\"get\" action=\"change_cart.php\">" .
                  "<input name=\"id\" type=\"hidden\" value=\"". $row['id'] . "\">" .
                  "<input name=\"add\" type=\"hidden\">" .
                  "<label for=quantity>Quantity: </label><input type=\"number\" class=\"quantity\" id=quantity name=quantity min=1 value=1 required>" .
                  "<input type=\"submit\" class=\"shopbutton\" value=\"Add to Cart\">" .
                "</form>" .
              "</section>" . 
            "</div>";
          }
        } else {echo "<p>$r</p>";}
      } else {
        echo "<p class=\"message\">No product is selected.</p>";
      }
    } else {echo "<p>$dbc</p>";}
    closeDB($dbc);
  ?>
</main>
<?php include('templates/footer.php'); ?>