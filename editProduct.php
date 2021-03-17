<!DOCTYPE html>
<html>
<head>
	<title>My Shop | Edit Product</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
	<div class="container-fluid">
		<?php 
			include('nav.php');
			$productId = $_GET['id'];
			//echo "$productId";

			//fetch products based on the id
			require_once('dbConnect.php');
			$sql = "SELECT * FROM product WHERE id=".$productId;
			//execute query
			$results = mysqli_query($conn,$sql);
			if ($results) {
				# code...
				$product = mysqli_fetch_assoc($results);
			}else{
				echo "Something went wrong";
			}
		?>
		<h3>Edit <?php echo $product['name']; ?></h3>
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
				    <input type="text" class="form-control" name="product_name" value="<?php echo $product['name']?>"required>
				  </div>

				  <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Product Description</label>
				    <input type="text" class="form-control" name="product_desc" value="<?php echo $product['description']?>" required>
				  </div>
				  <input type="hidden" name="productId" value="<?php echo $product['id']?>">
				  
				  <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Product Cost</label>
				    <input type="number" class="form-control" name="product_cost" value="<?php echo $product['cost']?>" required>
				  </div>
				 
				  <button type="submit" name="save" class="btn btn-primary">Update</button>
		</form>
			</div>

			<?php

				//require('dbConnect.php');
				//capture form data
			if (isset($_POST['save'])) {
				# code...
				$productName = $_POST['product_name'];
				$productDesc = $_POST['product_desc'];
				$productCost = $_POST['product_cost'];
				$productId = $_POST['productId'];

				//echo "$productName,$productDesc";
				/*
					Insert record to the table in db
					1.Capture the data into the db - form 
					2.establish  connection- required  the connect file
					3.Query Insert the db
					4.Success
				*/
					//$sql = "INSERT INTO product(name,description,cost) VALUES(?,?,?)";
					$sql = "UPDATE product SET name=?,description=?,cost=? WHERE id = ".$productId;

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