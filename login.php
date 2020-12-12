<?php
	session_start();
	if (isset ($_SESSION['login'])) {
		echo '<center>You are already logged in! This page will redirect you to landing page within 4 seconds!</center>';
		header( "refresh:4;url=index.php" );
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
	<!-- <head> -->
		<?php include ('template/header-scripts.php'); ?>
	    <?php include ('include/db.php'); ?>
	
	<body>
		<?php include ('template/navbar.php'); ?>
		<div class="container">
			<form method="post" action="sign-in.php">
			<div class="row" style="margin-top: 50px;">
				<div class="col-md-offset-3 col-md-6">
					<table class="table">
					
						<tr>
							<th>Email</th>
							<td><input type="email" name="Email"></td>
						</tr>
						<tr>
							<th>Password</th>
							<td><input type="password" name="Password"></td>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" value="login" class="btn btn-primary btn-block"></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<!-- footer scripts -->
		<?php include ('template/footer-scripts.php'); ?>
		<!-- /footer scripts -->
	</body>
</html>