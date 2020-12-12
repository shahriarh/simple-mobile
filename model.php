<!DOCTYPE html>
<html lang="en">
		<?php include ('template/header-scripts.php'); ?>
		
	
	<body>
		<?php include ('template/navbar.php'); ?>
		
		<div class="container">
			<form method="post">
				<table class="table-striped table-hover">
					<tbody>
						<tr>
							<td>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="first_name">First Name</label>
											<input name="firstName" type="text" class="form-control" id="first_name" placeholder="" required>
										</div>
										<select class="form-control">
											<option>Brand ID</option>
										</select>
										<select class="form-control form-control-sm">
											<option>Platform ID</option>
										</select>
									</div>
								</div>			
							</td>
						</tr>
					</tbody>
				</table>
			</form>	
		</div>
		
		
		
		
		<?php include ('template/footer-scripts.php'); ?>
	
	</body>
</html>