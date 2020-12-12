<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <!-- <head> -->
    <?php include ('template/header-scripts.php'); ?>
    <?php include ('include/db.php'); ?>
    <?php include ('include/functions.php'); ?>
    <?php
      if(isset($_GET['id'])) {
        $brand_id = mysqli_real_escape_string ($con, $_GET['id']);
      }

    ?>

    <?php

    // Fetch all products
      $query = '
        SELECT p.id, p.category, p.model_no, b.name AS brand_name, pl.name AS platform_name, p.name, p.price, p.tag, p.image FROM `products` as p
          LEFT JOIN brand b ON b.id=p.brand_id
          LEFT JOIN platform pl ON pl.id=p.platform_id
        WHERE p.brand_id='.$brand_id.'
        LIMIT 10;
      ';
      $result = mysqli_query($con,$query);
      $products = mysqli_fetch_all($result,MYSQLI_ASSOC);
      $number_of_products = mysqli_num_rows($result);

    ?>
  <!-- </head> -->
  <body>
    <?php include ('template/navbar.php'); ?>
    <div class="container">
        <div class="row">
          <div class="col-md-3">
            <?php
              include ('template/sidebar.php');
              $brand_key = array_search($brand_id, array_column($brands, 'id'));
            ?>
          </div>
          <div class="col-md-9">
            <h1><?=$brands[$brand_key]['name'] ?></h1>

            <h3>Devices</h3>
            <?php if($number_of_products > 0): ?>
            <?php
              renderProducts($products);
            ?>
          <?php else: ?>
            <p class='text-warning'>No devices on this section</p>
          <?php endif; ?>
          </div>
        </div>
      

    </div>
    <!-- footer scripts -->
    <?php include ('template/footer-scripts.php'); ?>
    <!-- /footer scripts -->
  </body>
</html>