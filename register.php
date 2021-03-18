<!DOCTYPE html>
<html>
<head>
	<title>My Shop | Register</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>

	<div class="container">

		<div class="row">

			<div class="alert alert-primary">
				<CENTER>
					<h2>Welcome to My Shop</h2>
				<p>Register</p>
				</CENTER>
			</div>

			<div class="col-4">
				<img src="https://cdn.shopify.com/s/files/1/0322/5894/9164/files/My_Shop_Logo_Transparent.png?height=628&pad_color=fff&v=1581933721&width=1200" class="img-fluid">
			</div>

			<div class="col-6">
				<!-- form -->
				<form method="POST" action="">
				<div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Full Name</label>
				    <input type="text" class="form-control" name="full_name" required>
				  </div>
				  <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Email</label>
				    <input type="email" class="form-control" name="email" required>
				  </div>

				  <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Phone Number</label>
				    <input type="phone" class="form-control" name="phone" required>
				  </div>


				  <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Password</label>
				    <input type="password" class="form-control" name="password" required>
				  </div>
				  
				 
				 
				  <button type="submit" name="register" class="btn btn-primary">Register</button>
				</form>

				Already registered?
				<a style='text-decoration: none;' href="login.php">Login Now</a>

				<?php
					//capture the records
					if (isset($_POST['register'])) {
						# code...
						$fullname = $_POST['full_name'];
						$email = $_POST['email'];
						$phone = $_POST['phone'];
						$password = $_POST['password'];


						//hash - plain - hashed - 
						/*
							password_hash(password,PASSWORD_DEFAULT); -> hashed 
						*/
						$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

						//connection
						require('dbConnect.php');

						//sql query 
						$sql = "INSERT INTO `customer`(`name`, `phone`, `email`, `password`) VALUES (?,?,?,?)";
						//prepare
						if ($stmt = mysqli_prepare($conn,$sql)) {
							# code...
							//binding
							mysqli_stmt_bind_param($stmt,"ssss",$param_name,$param_phone,$param_email,$param_password);
							//actual
							$param_name = $fullname;
							$param_phone = $phone;
							$param_email =$email;
							$param_password = $hashedPassword;

							//execute 
							if (mysqli_stmt_execute($stmt)) {
								# code...
								echo "registered successfully";
								header('location:login.php');
							}else{
								echo "Failed to Register.Try again";
							}

						}else{
							echo "Something went wrong ".mysqli_error($conn);
						}
					}
				?>
				
			</div>
			
		</div>
	</div>

</body>
</html>