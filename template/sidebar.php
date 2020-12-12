
<?php
// Fetch all brands
	$query = "select * from brand";
	$result = mysqli_query($con,$query);
	$brands = mysqli_fetch_all($result,MYSQLI_ASSOC);
	$number_of_brands = mysqli_num_rows($result);
	

// Fetch all platforms
	$query = 'select * from platform';
	$result = mysqli_query($con,$query);
	$platforms = mysqli_fetch_all($result,MYSQLI_ASSOC);
	$number_of_platform = mysqli_num_rows($result);
?>

<div class="row well">
	<div class="col-xs-6">
		<h3>Brands</h3>
		<ul class="nav nav-pills nav-stacked nav-sidebar">
			<?php foreach ($brands as $brand) {
				echo '<li role="presentation"><a href="brand.php?id='.$brand['id'].'">'.$brand['name'].'</a></li>';
			}
			?>
		</ul>
	</div>
	<div class="col-xs-6">
		<h3>Platforms</h3>
		<ul class="nav nav-pills nav-stacked nav-sidebar">
			<?php 
			foreach ($platforms as $platform) {
				echo '<li role="presentation"><a href="platform.php?id='.$platform['id'].'">'.$platform['name'].'</a></li>';
			}
			?>
		</ul>
		<br>
		<br>
		<h3>Categories</h3>
		<ul class="nav nav-pills nav-stacked nav-sidebar">
			<?php 
			$categories = ['tab','smartphone','smartwatch','simple'];
			foreach ($categories as $cat) {
				echo '<li role="presentation"><a href="category.php?id='.$cat.'"><span class="text-capitalize">'.$cat.'</span></a></li>';
			}
			?>
		</ul>
	</div>
</div>