<!DOCTYPE html>
<html>
<head>
	<title>My Shop | Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>

	<div class="container">

		<div class="row">

			<div class="alert alert-primary">
				<CENTER>
					<h2>Welcome to My Shop</h2>
				<p>Login</p>
				</CENTER>
			</div>

			<div class="col-4">
				<img src="https://cdn.shopify.com/s/files/1/0322/5894/9164/files/My_Shop_Logo_Transparent.png?height=628&pad_color=fff&v=1581933721&width=1200" class="img-fluid">
			</div>

			<div class="col-6">
				<!-- form -->
				<form method="POST" action="">
				  <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Email</label>
				    <input type="email" class="form-control" name="email" required>
				  </div>

				  <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Password</label>
				    <input type="password" class="form-control" name="password" required>
				  </div>
				  
				 
				 
				  <button type="submit" name="login" class="btn btn-primary">Login</button>
				</form>

				<?php
					if (isset($_POST['login'])) {
						# code...
						//capture email and the password.
						$email = $_POST['email'];
						$password = $_POST['password'];

						//connection
						require('dbConnect.php');
						//query
						$sql = "SELECT * FROM customer WHERE email=?";
						if ($stmt = mysqli_prepare($conn,$sql)) {
							# code...
							//bind
							mysqli_stmt_bind_param($stmt,"s",$param_email);
							$param_email =$email;
							//$param_password = $password;

							//execute query
							mysqli_execute($stmt);

							//fetch the results
							$result = mysqli_stmt_get_result($stmt);

							if ($result) {
								# code...
								$rows = mysqli_num_rows($result);
								if ($rows>0) {
									# code...
									//the user 
									$record = mysqli_fetch_assoc($result);

									$passwordHashed = $record['password'];
									//password verify
									//password and the one hashed 
									//true
									//false
									$passwordStatus = password_verify($password, $passwordHashed);
									if ($passwordStatus) {
										# code...
										echo "<h4 style='color:green;'>Logined Successfully.Welcome</h4>";
										echo "Welcome dear ".$record['name']."<br>";
										$fullname = $record['name'];

										//session- stores variables across multiple pages
										session_start();
										//create a session
										/*
											Global variable $_SESSION
											key - 
											value
										*/
										$_SESSION['name']=$fullname;


										header('location:index.php');
									}else{
										echo "<h4 style='color:red;'>Invalid email or password</h4>";
									}

										
								}else{
									echo "<h4 style='color:red;'>Invalid email or password</h4>";
								}
							}else{
								echo "Something wrong with the results";
							}

						}else{
							echo "Something went wrong.";
						}

					}
					
				?>

				Don't have an account?
				<a style='text-decoration: none;' href="register.php">Register Now</a>
				
			</div>
			
		</div>
	</div>

</body>
</html>