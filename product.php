<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<!-- <head> -->
		<?php include ('template/header-scripts.php'); ?>
	    <?php include ('include/db.php'); ?>
    <?php
      if(isset($_GET['id'])) {
        $product_id = mysqli_real_escape_string ($con, $_GET['id']);
      }
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
					<?php

					// Fetch all products
						$query = '
							SELECT p.id, p.category, p.model_no, p.configuration, b.name AS brand_name, pl.name AS platform_name, p.name, p.price, p.tag, p.image FROM `products` as p
								LEFT JOIN brand b ON b.id=p.brand_id
								LEFT JOIN platform pl ON pl.id=p.platform_id
								WHERE p.id='.$product_id.'
							LIMIT 1;
						';
						$result = mysqli_query($con,$query);
						$product = mysqli_fetch_assoc($result);
						$number_of_products = mysqli_num_rows($result);
						if ($number_of_products < 1) {
							echo 'Invalid Product ID!';
							die();
						}

					?>
					<div class="row rheader margin-bottom-30">
						<div class="col-xs-12 heading-main">
							<h3>Device Details
							<?php if (!empty($_SESSION['admin'])): ?>
								<a href="product-edit.php?id=<?=$product_id ?>" class="btn btn-warning pull-right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
							<?php endif; ?>
							</h3>
						</div>
						<div class="col-md-12">
							<div class="row" style="margin-top:20px; margin-bottom: 20px;">
								<div class="col-sm-3 col-md-offset-2 specs-photo-main">
									<img  src="uploads/<?=$product['image'] ?>" alt="image" style="max-height: 250px; width: 100%;">
								</div>
								<div class="col-sm-7">
									<?=$product['brand_name'] ?>
									<h4><a href="product.php?id=<?=$product['id'] ?>"><?=$product['name'] ?> <sup class="badge bg-primary"><?=$product['tag'] ?></sup></a></h4>
									<p class="text-capitalize text-muted"><?=$product['category'] ?></p>
									<h5>Price: <strong><?=$product['price'] ?> BDT</strong></h5>
									<h5>Model No: <?=$product['model_no'] ?></h5>
									<form action="cart.php" method="post">
										<button name="add" value="<?=$product_id ?>" class="btn btn-default add-to-cart" id="<?=$product_id ?>" style="margin-top: 40px;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Add to Cart</button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<duv class="col-md-2"><h3>Specs.</h3></duv>
						<div class="col-md-10">
							<?=$product['configuration'] ?>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<!-- footer scripts -->
		<?php include ('template/footer-scripts.php'); ?>
		<style>
			.rheader {
			    position: relative;
			    overflow: hidden;
			}
			.rheader:after {
			    content: "";
			    background-image: url('uploads/<?=$product['image'] ?>');
			    background-size: 612%;
			    background-position: -1449px -4317px;
			    position: absolute;
			    z-index: -1;
			    top: 0;
			    left: 0;
			    width: 100%;
			    height: 100vh;
				filter: url(data:image/svg+xml;utf9,<svg%20version='1.1'%20xmlns='http://www.w3.org/20Ã…¦%20id='blur'><feGaussianBlur%20stdDeviation='30'%20/></filter></svg>#blur);
				filter: blur(30px);
				-webkit-filter: blur(30px);
				-moz-filter: blur(30px);
				-o-filter: blur(30px);
				-ms-filter: blur(30px);
				opacity: 0.5;
			}
			.specs-photo-main:after {
			    content: "";
			    position: absolute;
			    top: 0;
			    left: 200px;
			    width: 229px;
			    height: 100%;
			    background: linear-gradient(90deg,#fff 0,#fcfeff 2%,rgba(125,185,232,0));
			    z-index: 0;
			}
			.heading-main {
				background: rgba(0,0,0,.096);
				padding-bottom: 15px;
			}
			.heading-main h3 {
				color: white;
				text-shadow: 0 0 10px darkslategrey;
			}
		</style>
		<!-- /footer scripts -->
	</body>
</html>