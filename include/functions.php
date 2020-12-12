<?php

/*
 *	Render Products
 *	Params:		$products array
 *	Outputs:	HTML formatted products row
*/
function renderProducts($products) {

	echo '<div class="row">';
		foreach ($products as $key => $product) {
			echo '<div class="col-sm-6">
				<div class="media margin-bottom-30">
				  <div class="media-left">
					<a href="product.php?id='. $product['id'] .'">
					  <img class="media-object" src="uploads/'. $product['image'] .'" alt="image" style="max-height: 150px;">
					</a>
				  </div>
				  <div class="media-body">
					'. $product['brand_name'] .'
					<h4 class="media-heading"><a href="product.php?id='.$product['id'] .'">'. $product['name'] .' <sup class="badge bg-primary">'.$product['tag'] .'</sup></a></h4>
					<p class="text-capitalize text-muted">'.$product['category'] .'</p>
					<h5 class="product-price">Price: <strong>'.$product['price'] .' BDT</strong></h5>
					<form action="cart.php" method="post">
						<button name="add" value="'.$product['id'] .'" class="btn btn-link btn-outline btn-xs add-to-cart" id="'.$product['id'] .'" style=""><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Add to Cart</button>
					</form>
				  </div>
				</div>
			</div>';
		}
	echo '</div>';
}