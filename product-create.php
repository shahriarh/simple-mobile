<?php
	session_start();
	if (!isset ($_SESSION['login'])) {
		header( "location:login.php" );
	}
?>
<!DOCTYPE html>
<html lang="en">
	<!-- <head> -->
	<?php include ('template/header-scripts.php'); ?>
    <?php include ('include/db.php'); ?>
    <?php

		$fields = ['category', 'model_no', 'name', 'configuration', 'price', 'date_added', 'brand_id', 'platform_id', 'tag', 'image'];
		$rawData = $_POST;

    	if(!empty($_POST['submit'])) {
    		$_POST['date_added'] = date('Y-m-d H:i:s');
    		foreach ($fields as $field) {
    			$data[$field] = $_POST[$field];
    		}
    		$data['image'] = $_FILES["image"]["name"];
    		upload_image();

			// Create connection
			$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
			// prepare and bind
			$stmt = $conn->prepare("INSERT INTO products (". implode(',', $fields) .") VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssisiiss", $data['category'],$data['model_no'],$data['name'],$data['configuration'],$data['price'],$data['date_added'],$data['brand_id'],$data['platform_id'],$data['tag'],$data['image']);
			$stmt->execute();
			$id = $stmt->insert_id;
			$stmt->close();
			$conn->close();

			//redirect to product view page
			header('location:product.php?id='.$id);
    	}
    	else {
    		foreach ($fields as $field) {
				$rawData[$field] = '';
    		}
			$data['date_added'] = date('Y-m-d H:i:s');
    	}

    	function upload_image() {
			$target_dir = "uploads/";
			$uploadOk = 1;
			// Check if image file is a actual image or fake image
		    $check = getimagesize($_FILES["image"]["tmp_name"]);
			$target_file = $target_dir . basename($_FILES["image"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }

			// Check if file already exists
			if (file_exists($target_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["image"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
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
							// list categories in an array
							$categories = ['tab','smartphone','smartwatch','simple'];
							
							// list tags in an array
							$tags = ['hot','latest','popular'];
						?>
						<h3>Add Device</h3>
						<form method="post" enctype="multipart/form-data">
							<table class="table">
								<tr>
									<th>Name</th>
									<td><input type="text" class="form-control" name="name" value="<?=$rawData['name'] ?>" required/></td>
								</tr>
								<tr>
									<th>Brand</th>
									<td>
										<select name="brand_id" class="form-control" required>
											<option value="" disabled>Select Brand</option>
										<?php foreach ($brands as $brand): ?>
											<option value="<?= $brand['id'] ?>" <?=($rawData['brand_id'] == $brand['id'] ? 'selected' : '') ?> ><?= $brand['name'] ?></option>
										<?php endforeach; ?>
										</select>
									</td>
								</tr>
								<tr>
									<th>Platform</th>
									<td>
										<select name="platform_id" class="form-control" required>
											<option value="" disabled>Select Platform</option>
										<?php foreach ($platforms as $platform): ?>
											<option value="<?= $platform['id'] ?>" <?=($rawData['platform_id'] == $platform['id'] ? 'selected' : '') ?> ><?= $platform['name'] ?></option>
										<?php endforeach; ?>
										</select>
									</td>
								</tr>
								<tr>
									<th>Model Number</th>
									<td><input type="text" class="form-control" name="model_no" value="<?=$rawData['model_no'] ?>" required/></td>
								</tr>
								<tr>
									<th>Category</th>
									<td>
										<select name="category" class="form-control" required>
											<option value="">Select Category</option>
										<?php foreach ($categories as $category): ?>
											<option value="<?= $category ?>" <?=($rawData['category'] == $category ? 'selected' : '') ?> ><?= $category ?></option>
										<?php endforeach; ?>
										</select>
									</td>
								</tr>
								<tr>
									<th>Tag</th>
									<td>
										<select name="tag" class="form-control" required>
											<option value="">Select Tag</option>
										<?php foreach ($tags as $tag): ?>
											<option value="<?= $tag ?>" <?=($rawData['tag'] == $tag ? 'selected' : '') ?> ><?= $tag ?></option>
										<?php endforeach; ?>
										</select>
									</td>
								</tr>
								<tr>
									<th>Price</th>
									<td><input type="number" class="form-control" name="price" value="<?=$rawData['price'] ?>" required/></td>
								</tr>
								<tr>
									<th>Image Upload</th>
									<td><input type="file" name="image" id="image" value="<?=$rawData['image'] ?>"></td>
								</tr>
								<tr>
									<th>Configuration</th>
									<td><textarea id="configuration" class="form-control" name="configuration" required><?=$rawData['configuration'] ?></textarea></td>
								</tr>
								<tr>
									<td colspan="2">
										<input type="submit" name="submit" value="Add Device" class="btn btn-primary"/>
									</td>
								</tr>
							</table>
						</form>
						</div>
					</div>
						
				</div>
			

		</div>

		<link rel="stylesheet" href="minified/themes/default.min.css" />
		<script src="minified/sceditor.min.js"></script>
		<script src="minified/formats/xhtml.js"></script>
		<script>
		// Replace the textarea #example with SCEditor
		var textarea = document.getElementById('configuration');
		sceditor.create(textarea, {
			format: 'xhtml',
			style: 'minified/themes/content/default.min.css',
			height: '100%'
		});
		</script>
		<!-- footer scripts -->
		<?php include ('template/footer-scripts.php'); ?>
		<!-- /footer scripts -->
	</body>
</html>