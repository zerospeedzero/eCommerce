<?php define('TITLE', 'Home | ReadyTECT'); include('templates/header.php');?>
<main>
  <h2>Featured products</h2>
  <?php
    $rows = array();
    $dbc = connectDB();
    if (!isError($dbc)) {
      $r = queryRecord($dbc, "SELECT id, name, price, full_size_image, thumbnail_image, description, category from products where (id in (1, 2, 6, 15, 19)) LIMIT 5");
      if (!isError($r)) {
        while ($row = mysqli_fetch_array($r)) { array_push($rows, $row); }
        include('templates/carousel.php');
      } else {echo "<p>$r</p>";}
    } else {echo "<p>$dbc</p>";}
    closeDB($dbc);
  ?>
</main>
<?php include('templates/footer.php'); ?>