<?php define('TITLE', 'Home | ReadyTECT'); include('templates/header.php');?>
<main>
  <h2>Show data in orders table in products database</h2>
  <p>A sql statement 'select * from orders' will be executed on the products database and the results are as follow.</p>
  <table>
    <thead>
      <tr><th>id</th><th>customer_name</th><th>email</th><th>products_purchased</th><th>total_cost</th></tr>
    </thead>
    <tbody>
      <?php
        $rows = array();
        $dbc = connectDB();
        if (!isError($dbc)) {
          $r = queryRecord($dbc, "select * from orders");
          if (!isError($r)) {
            while ($row = mysqli_fetch_array($r)) {
              echo '<tr><td>'.$row['id'].'</td><td>'.$row['customer_name'].'</td><td>'.$row['email'].'</td><td>'.$row['products_purchased'].'</td><td>'.$row['total_cost'].'</td></tr>'; 
            }
          } else {echo "<p>$r</p>";}
        } else {echo "<p>$dbc</p>";}
        closeDB($dbc);
      ?>
    </tbody>
  </table>
</main>
<?php include('templates/footer.php'); ?>