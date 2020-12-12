<?php
	session_start();
	if (!isset ($_SESSION['login'])) {
		header( "location:sign-up.php?redirect=checkout.php" );
	}

	include ('include/db.php');

	if(!empty($_POST['submit'])) {
		$data = $_POST;

		// Create connection
		$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
		// prepare and bind
		$stmt = $conn->prepare("INSERT INTO orders (user_id, billing_address, shipping_address, contact_phone, payment_method) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("issss", $_SESSION['user_id'], $data['billing_address'], $data['shipping_address'], $data['phone'], $data['payment_method']);
		print_r($conn->error_list);
		$stmt->execute();
		$id = $stmt->insert_id;
		$stmt->close();

		// prepare and bind
		$stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");

		foreach ($_SESSION['cart'] as $key => $item) {
			$stmt->bind_param("iii", $id, $key, $item);
			$stmt->execute();
		}

		$stmt->close();
		$conn->close();

		unset($_SESSION['cart']);
		header( "location:order-placed.php" );
		

		//redirect to product view page
		//header('location:product.php?id='.$id);
	}
?>
<!DOCTYPE html>
<html lang="en">
	<!-- <head> -->
		<?php include ('template/header-scripts.php'); ?>
	<!-- </head> -->
	<body>
		<?php include ('template/navbar.php'); ?>
		<div class="container">
				<div class="row">
					<div class="col-md-3">
						<?php include ('include/functions.php'); ?>
						<?php include ('template/sidebar.php'); ?>
					</div>
					<div class="col-md-9">
						<h2>Order Summary</h2>
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
									</tr>
								</thead>
								<tbody>
									<?php foreach ($products as $key => $product): ?>
									<tr class="align-middle">
										<td>
											<table class="table-condensed">
												<tr class="align-middle">
													<td>
														<a href="product.php?id=<?=$product['id'] ?>">
														  <img class="media-object" src="uploads/<?=$product['image'] ?>" alt="image" style="max-height: 50px;">
														</a>
													</td>
													<td>
														<a href="product.php?id=<?=$product['id'] ?>"><h5><?=$product['brand_name'] ?> <?=$product['name'] ?></h5></a>
													</td>
												</tr>
											</table>
										</td>
										<td>
											<?=$product['category'] ?>
										</td>
										<td>
											<?=number_format($product['price']) .' ৳'; ?>
										</td>
										<td>
											<?=$_SESSION['cart'][$product['id']] ?>
										</td>
										<td>
											<?php
												$item_total[] = $tmp = $product['price'] * $_SESSION['cart'][$product['id']];
												echo number_format($tmp, 2) .' ৳';
											?>
										</td>
									</tr>
								<?php endforeach; ?>
									<tr class="success">
										<td colspan="3" class="text-center">Total</td>
										<td><?=array_sum(array_values($_SESSION['cart'])) ?> Items</td>
										<td class="text-primary"><strong><?=number_format(array_sum($item_total), 2) .' ৳'; ?></strong></td>
									</tr>
								</tbody>
							</table>
						<?php endif; ?>
						<br>
						<br>
						<?php

								$query = '
									SELECT * FROM users WHERE id='.$_SESSION['user_id'];
								$result = mysqli_query($con,$query);
								$user = mysqli_fetch_array($result,MYSQLI_ASSOC);
						?>
						<h3 class="success">Contact Details &amp; Payment Method</h3>
						<form method="post">
							<table class="table">
								<tr>
									<th>Phone Number</th>
									<td><input class="form-control" type="text" name="phone" value="<?=$user['phone'] ?>" required/></td>
								</tr>
								<tr>
									<th>Billing Address</th>
									<td><input class="form-control" type="text" name="billing_address" value="<?=$user['address'] ?>" required/></td>
								</tr>
								<tr>
									<th>Shipping Address</th>
									<td><input class="form-control" type="text" name="shipping_address" value="<?=$user['address'] ?>" required/></td>
								</tr>
								<tr>
									<th>Payment Method</th>
									<td>
										<select name="payment_method" class="form-control" required>
											<option value="cash_on_delivery">Cash on Delivery</option>
											<option value="bkash">bKash</option>
											<option value="paypal">Paypal</option>
											<option value="bank_transfer">Bank Transfer</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<input class="form-control btn btn-primary" type="submit" name="submit" value="submit"/>
									</td>
								</tr>
							</table>
						</form>
					</div>
						
				</div>
		</div>
		<!-- footer scripts -->
		<?php include ('template/footer-scripts.php'); ?>
		<!-- /footer scripts -->
	</body>
</html>