<div class="carousel-wrapper">
  <div class="carousel">
    <?php
      $count = 0;
      foreach($rows as &$row) {  
        echo ($count == 0)
        ?     "<div class=\"carousel__item initial\">"
        :     "<div class=\"carousel__item\">";
        $count = $count + 1;
        echo    "<img src=\"./thumbnails/" . $row["thumbnail_image"] . "\" alt=\"" . $row["name"] . "\">\r\n" .
                "<div class=\"carousel-caption\">" .
                  "<h3>" . $row["name"] . "</h3>" . 
                  $row["description"] . "\r\n" .
                  "<span class=\"price\">Unit Price : $" . number_format($row["price"],2) . "</span>" .
                  "<a class=\"shopbutton\" href=\"product.php?id=". $row['id'] . "\">Shop Now</a>" .
                "</div>"; 
        echo  "</div>\r\n";
      }
    ?>
    <div class="carousel__button--next"></div>
    <div class="carousel__button--prev"></div>
  </div>
  <script src="./javascripts/carousel.js"></script>
</div>