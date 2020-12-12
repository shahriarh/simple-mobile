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
						 <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Order ID</th>
                  
                  <th>Billing Address</th>
				  
                  <th>Shipping Address</th>
                  <th>Phone</th>
                   <th>Payment Method</th>
                   <th>Date</th>
                   <th>Product ID</th>
                   <th>Quantity</th>
                   <th>Price</th>
                   <th>Total Bill</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$query="SELECT * FROM order_items INNER JOIN orders on order_items.order_id=orders.id INNER JOIN products on order_items.product_id=products.id INNER JOIN users on order_items.user_id=users.id";
					$result=mysqli_query($con,$query);
					if(mysqli_num_rows($result)>0){
						while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
							echo "<tr>";
							echo "<td>".$row['order_id']."</td>";
							echo "<td>".$row['billing_address']."</td>";
							echo "<td>".$row['shipping_address']."</td>";
							echo "<td>".$row['contact_phone']."</td>";
							echo "<td>".$row['payment_method']."</td>";
							echo "<td>".$row['date_ordered']."</td>";
							echo "<td>".$row['product_id']."</td>";
							echo "<td>".$row['quantity']."</td>";
							echo "<td>".$row['price']."</td>";
							echo "<td>".$row['quantity']*$row['price']."</td>";
							
							
							echo "</tr>";
						}
					}
				
				?>
				
                </tbody>
                
              </table>
					</div>
				</div>
			

		</div>
		<!-- footer scripts -->
		<?php include ('template/footer-scripts.php'); ?>
		<!-- /footer scripts -->
	</body>
</html>