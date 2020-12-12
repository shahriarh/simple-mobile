<?php
	session_start();
	if (isset ($_SESSION['login'])) {
		echo '<center>You are already logged in! This page will redirect you to landing page within 4 seconds!</center>';
		header( "refresh:4;url=index.php" );
		die();
	}

	if (!empty($_GET['redirect'])) {
		$redirect = filter_var($_GET['redirect'], FILTER_SANITIZE_URL);

	}
	else {
		$redirect = 'login.php';
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
				<div class="col-xs-12">
					<h2 class="text-center text-primary">Welcome to Gadgets Store!</h2>
				</div>
				
				<div class="col-sm-8 col-sm-offset-2">
					<form method="post" action="registration.php?redirect=<?=$redirect ?>">
						<table class="table" align ="center">
							<tr>
								<th>Name</th>
								<td><input class="form-control" type="text" name="name" required/></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><input class="form-control" type="email" name="email" required/></td>
							</tr>
							<tr>
								<th>Address</th>
								<td><input class="form-control" type="text" name="address" required/></td>
							</tr>
							<tr>
								<th>Password</th>
								<td><input class="form-control" type="password" name="password" required/></td>
							</tr>
							<tr>
								<th>Confirm Password</th>
								<td><input class="form-control" type="password" name="cpassword" required/></td>
							</tr>
							<tr>
								<th>Phone Number</th>
								<td><input class="form-control" type="text" name="phone" required/></td>
							</tr>
							<tr>
								<th>Zipcode</th>
								<td><input class="form-control" type="text" name="zipcode" required/></td>
							</tr>
							<tr>
								<th>&nbsp;</th>
								<td align="right">
									<input class="btn btn-success btn-block" type="submit" value="Sign Up">
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