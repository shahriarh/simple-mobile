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
						<br>
						<br>
						<br>
						<div class="alert alert-dismissible alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<div class="row">
								<div class="col-xs-2 text-center"><span class="glyphicon glyphicon glyphicon-ok" style="font-size: 30px; border-radius: 40px; background: green; padding: 20px;"></span></div>
								<div class="col-xs-8">
									<h4>Success!</h4>
									<p>Order Placed Successfully! Please continue <a href="index.php" class="btn btn-primary btn-xs">Shopping</a></p>
								</div>
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