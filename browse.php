<?php define('TITLE', 'Browse all | ReadyTECH'); include('templates/header.php');?>
<?php
  $message = "";
  $categories = [];
  $rows = [];
  $dbc = connectDB();
  if (!isError($dbc)) {
    $r = queryRecord($dbc, "SELECT distinct category from products");
    if (!isError($r)) {
      while ($category = mysqli_fetch_array($r)) {
        array_push($categories, $category);
      }
    } else {$message = "<p>$r</p>";}
    $r = queryRecord($dbc, "SELECT id, name, price, full_size_image, thumbnail_image, description, category from products");
    if (!isError($r)) {
      while ($row = mysqli_fetch_array($r)) {
        array_push($rows, $row);
      }
    } else {$message = "<p>$r</p>";}  
  } else {$message = "<p>$dbc</p>";}
?>
<main>
  <h2>Browse products</h2>
  <?php
    echo  "<div class=\"filter\">" .
            "<div class=\"select\">" .
              "<select name=\"category\" id=\"category\">" .
                "<option value=\"All\">All</option>";
      foreach($categories as &$category) { echo
                "<option value=\"" . $category["category"] . "\">" . $category["category"] . "</option>";
      }    
      echo    "</select>" .
            "</div>" .
            "<span id=\"price_field\">Price<i id=\"sort_price\" class=\"price arrow arrow_down\"></i></span>" .
            "<span id=\"name_field\">Name<i id=\"sort_name\" class=\"name arrow\"></i></span>" .
          "</div>";
    echo  "<div id=\"cards\" class=\"flex-container browse\"></div>";
    if (isset($message)) {echo $message;}
  ?>
  <script>var rows = <?php echo json_encode($rows); ?>;</script>
  <script src="./javascripts/browse.js"></script>
</main>
<?php include('templates/footer.php'); ?>
