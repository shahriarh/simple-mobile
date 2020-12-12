<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<!-- <head> -->
		<?php include ('template/header-scripts.php'); ?>
	    <?php include ('include/db.php'); ?>
    <?php

      // Remove Item
      if(isset($_POST['remove'])) {
		$product_id = mysqli_real_escape_string ($con, $_POST['remove']);
        //if (in_array($product_id, array_keys($_SESSION['cart']))) {
	      //  $_SESSION['cart'][$product_id] = $_SESSION['cart'][$product_id] - 1;
        //}
        //if ($_SESSION['cart'][$product_id] < 1)
        	unset ($_SESSION['cart'][$product_id]);
        header('location:cart.php');
      }
      
      // Add Item
      if(isset($_POST['add'])) {
        $product_id = mysqli_real_escape_string ($con, $_POST['add']);
        if (in_array($product_id, array_keys($_SESSION['cart']))) {
	        $_SESSION['cart'][$product_id] = $_SESSION['cart'][$product_id] + 1;
        }
        else {
        	$_SESSION['cart'][$product_id] = 1;
        }
        header('location:cart.php');
      }
      
      // Edit Item
      if(isset($_POST['edit'])) {
        $product_id = (int) $_POST['edit'];
        $qty = (int) $_POST['qty'];
    	$_SESSION['cart'][$product_id] = $qty;

        header('location:cart.php');
      }
      //unset($_SESSION['cart']);
    ?>
	<!-- </head> -->
	<body>
		<?php include ('template/navbar.php'); ?>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php include ('include/db.php'); ?>
					<?php include ('template/sidebar.php'); ?>
				</div>
				<div class="col-md-9">
					<div class="row">
						<duv class="col-sm-12"><h3>My Cart</h3></duv>
						<div class="col-md-12">

						<?php
							if (!empty($_SESSION['cart'])) {

							// Fetch all products
								$query = '
									SELECT p.id, p.category, p.model_no, b.name AS brand_name, pl.name AS platform_name, p.name, p.price, p.tag, p.image FROM `products` as p
										LEFT JOIN brand b ON b.id=p.brand_id
										LEFT JOIN platform pl ON pl.id=p.platform_id
									WHERE p.id IN ('.implode(",", array_keys($_SESSION["cart"])).')
									LIMIT 10;
								';
								$result = mysqli_query($con,$query);
								$products = mysqli_fetch_all($result,MYSQLI_ASSOC);
								$number_of_products = mysqli_num_rows($result);
/*
								echo '<pre>';
								print_r($_SESSION['cart']);
								print_r($products);
								print_r($query);
								echo '</pre>';*/
							}
							$item_total = array();

						?>
						<?php if(!empty($number_of_products)): ?>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Device</th>
										<th>Category</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Total</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$serial = 0;
									foreach ($products as $key => $product): 
										$serial++; ?>
									<tr class="align-middle" id="pro">
										<td>
											<table class="table-condensed">
												<tr class="align-middle">
													<td>
														<a href="product.php?id=<?=$product['id'] ?>">
														  <img class="media-object" src="uploads/<?=$product['image'] ?>" alt="image" style="max-height: 80px;">
														</a>
													</td>
													<td>
														<a href="product.php?id=<?=$product['id'] ?>"><h4><?=$product['brand_name'] ?> <?=$product['name'] ?></h4></a>
													</td>
												</tr>
											</table>
										</td>
										<td>
											<?=$product['category'] ?>
										</td>
										<td id="price<?php echo $serial ;?>">
											<?=number_format($product['price']) .' ৳'; ?>
										</td>
										<td>
											<form method="post" class="form-inline">
												<div class="input-group input-group-sm">
													<input type="number" class="form-control" onChange="cal();" class="form-control"id="quantity" min="1"
													max="<?=$product['quantity'] ?>" name="qty" serial="<?php echo $serial ;?>" value="<?=$_SESSION['cart'][$product['id']] ?>" style="width:70px;">
													<span class="input-group-btn">
														<button name="edit" value="<?=$product['id'] ?>" class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
													</span>
												</div><!-- /input-group -->
											</form>
											
										</td>
										<td id="single_result<?php echo $serial ;?>">
											<?php
												$item_total[] = $tmp = $product['price'] * $_SESSION['cart'][$product['id']];
												echo number_format($tmp, 2) .' ৳';
											?>
										</td>
										<td>
											<form action="cart.php" method="post">
												<button name="remove" value="<?=$product['id'] ?>" class="btn btn-warning btn-xs" id="<?=$product['id'] ?>" style=""><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
											</form>
										</td>
									</tr>
								<?php endforeach; ?>
									<tr>
										<td colspan="3">Total</td>
										<td id="total_item"><?=array_sum(array_values($_SESSION['cart'])) ?> Items</td>
										<td id="result"><?=number_format(array_sum($item_total), 2) .' ৳'; ?></td>
									</tr>
								</tbody>
							</table>
							<a class="btn btn-success pull-right" href="checkout.php">Checkout</a>
						<?php else: ?>
							<p class="lead text-warning">Cart Empty! Please continue <a href="index.php">Shopping</a></p>
						<?php endif; ?>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<!-- footer scripts -->
		<?php include ('template/footer-scripts.php'); ?>
		<!-- /footer scripts -->

	</body>
</html>