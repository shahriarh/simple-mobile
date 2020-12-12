<?php
	session_start();
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
						<?php include ('include/db.php'); ?>
						<?php include ('include/functions.php'); ?>
						<?php include ('template/sidebar.php'); ?>
					</div>
					<div class="col-md-9">
						<?php
						// Fetch all products
							$query = '
								SELECT p.id, p.category, p.model_no, b.name AS brand_name, pl.name AS platform_name, p.name, p.price, p.tag, p.image FROM `products` as p
									LEFT JOIN brand b ON b.id=p.brand_id
									LEFT JOIN platform pl ON pl.id=p.platform_id
								LIMIT 10;
							';
							$result = mysqli_query($con,$query);
							$products = mysqli_fetch_all($result,MYSQLI_ASSOC);
							$number_of_products = mysqli_num_rows($result);

						?>
						<h3>Products
							<?php if (!empty($_SESSION['admin'])): ?>
								<a href="product-create.php" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add new Device</a>
							<?php endif; ?>
						</h3>
						<?php
							renderProducts($products);
						?>
					</div>
				</div>
			

		</div>
		<!-- footer scripts -->
		<?php include ('template/footer-scripts.php'); ?>
		<!-- /footer scripts -->
	</body>
</html>