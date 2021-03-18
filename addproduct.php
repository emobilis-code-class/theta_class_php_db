<!DOCTYPE html>
<html>
<head>
	<title>My Shop | Add Product</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
	<div class="container-fluid">
		<?php 
		  include('nav.php');

			//before accessing you must be loggined
			//I have your session
			//session_start();
			if (!isset($_SESSION['name'])) {
				# code...
				header("location:login.php");
			}

		?>

		<div class="row">
			<div class="col-4">
				<!-- icon show add product -->
				<img src="https://www.clipartmax.com/png/small/38-383442_shop-printed-revolution-online-and-earn-cash-add-product-icon-free.png" class="img-fluid">
			</div>

			<div class="col-6">
				<!-- form -->
				<form method="POST" action="">
				  <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Product Name</label>
				    <input type="text" class="form-control" name="product_name" required>
				  </div>

				  <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Product Description</label>
				    <input type="text" class="form-control" name="product_desc" required>
				  </div>
				  
				  <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Product Cost</label>
				    <input type="number" class="form-control" name="product_cost" required>
				  </div>
				 
				  <button type="submit" name="save" class="btn btn-primary">Save</button>
		</form>
			</div>

			<?php

				require('dbConnect.php');
				//capture form data
			if (isset($_POST['save'])) {
				# code...
				$productName = $_POST['product_name'];
				$productDesc = $_POST['product_desc'];
				$productCost = $_POST['product_cost'];

				//echo "$productName,$productDesc";
				/*
					Insert record to the table in db
					1.Capture the data into the db - form 
					2.establish  connection- required  the connect file
					3.Query Insert the db
					4.Success
				*/
					$sql = "INSERT INTO product(name,description,cost) VALUES(?,?,?)";

					//prepare the query - is correct
					if ($stmt = mysqli_prepare($conn,$sql)) {
						# code...
						//bind ?.?,? //sql injection
						mysqli_stmt_bind_param($stmt,"ssd",$param_name,$param_desc,$param_cost);
						//bind
						$param_name = $productName;
						$param_desc = $productDesc;
						$param_cost = $productCost;

						//we need to execute insert
						//mysqli_stmt_execute($stml)
						if (mysqli_stmt_execute($stmt)) {
							# code...
							echo "<h4 style='color:green'>Saved the product Successfully</h4>";
							//redirect - view product
							header("location:viewproduct.php");
						}else{
							echo "<h4 style='color:red'>Oops!Something went wrong</h4>";
						}


					}else{
						echo "The is an issue with your query command";
					}
			}

			?>
			
		</div>
		
	</div>

</body>
</html>