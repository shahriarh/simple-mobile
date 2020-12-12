<?php
	require_once('include/db.php'); // has the $con variable and DB username, passwords
	session_start();
		$Email = strtolower(trim($_POST['Email']));
		$Password = md5($_POST['Password']);
		$query = "select * from users where email='$Email'";
		$result = mysqli_query($con,$query);
		$num = mysqli_num_rows($result);
		
		if($num == 0){
			echo "No user with this Email found, go to <a href='login.php'>Login</a>";
		}
		else {
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			$dbpassword = $row['password'];
			echo $Password;
			if($Password == $dbpassword){
				$_SESSION['Email'] = $Email;
				$_SESSION['name'] = $row['name'];
				$_SESSION['user_id'] = $row['id'];
				$_SESSION['login'] = true;
				
				if ($row['is_admin'] == 1){
					$_SESSION['admin'] = true;
					header('location:index.php');
				} else {
					header('location:product-create.php');
				}
			}
			else{
				echo "Password doesn't match try again <a href='login.php'>Login</a> ";
			}
		}
		



?>