<!DOCTYPE html>
<html lang="en">
	<!-- <head> -->
		<?php include ('template/header-scripts.php'); ?>
	<!-- </head> -->
	<body>
		<?php include ('template/navbar.php'); ?>

		<div class="container">
			<form method="post">
				<table class="table table-striped table-hover">
					<tbody>
						<tr>
							<th></th>
							<td>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="first_name">First Name</label>
											<input name="firstName" type="text" class="form-control" id="first_name" placeholder="" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="last_name">Last Name</label>
											<input name="lastName" type="text" class="form-control" id="last_name" placeholder="" required>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<td>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail4">Email</label>
											<input name="email" type="email" class="form-control" id="inputEmail4" placeholder="Email" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputDoB">Date of Birth</label>
											<input name="dob" type="date" class="form-control" id="inputDoB" required>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<td>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="password">Password</label>
											<input name="password" type="password" class="form-control" id="password" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="password_repeat">Repeat Password</label>
											<input name="password_repeat" type="password" class="form-control" id="password_repeat" required>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<td>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputAddress">Address</label>
											<input name="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputCity">City</label>
											<input name="city" type="text" class="form-control" id="inputCity" required>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<th>&nbsp;</th>
							<td>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputZip">Zip</label>
											<input name="zip" type="text" class="form-control" id="inputZip" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputPhone">Phone</label>
											<input name="phone" type="text" class="form-control" id="inputPhone" required>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary">Sign in</button>
			</form>
		</div>
		<!-- footer scripts -->
		<?php include ('template/footer-scripts.php'); ?>
		<!-- /footer scripts -->
	</body>
</html>