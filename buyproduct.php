<!DOCTYPE html>
<html>
<head>
	<title>My Shop | View Product</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
	<div class="container-fluid">
		<?php include('nav.php');

		require('checkloginstatus.php');

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

		<div class="row">
			<div class="col-3">
				<img src="https://cdn4.iconfinder.com/data/icons/ios7-active-2/512/Basket.png" class="img-fluid">
			</div>

			<div class="col">
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

				  <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Product Quantity</label>
				    <input type="number" class="form-control" name="product_quantity" value="1" required>
				  </div>
				 
				  <button type="submit" name="buy" class="btn btn-primary">Complete Purchasee</button>
		</form>

			<?php

			//get the form
			if (isset($_POST['buy'])) {
				# code...
				$productName = $_POST['product_name'];
				$productCost = $_POST['product_cost'];
				$productQuantity = $_POST['product_quantity'];
				$productId = $_POST['productId'];
				//$productName = $_POST['product_name'];
				$customerName = $_SESSION['name'];
				$customerId = $_SESSION['id'];

				//sql 
				$sql ="INSERT INTO `sales`( `product_name`, `product_id`, `quantity`, `cost`, `customer_name`, `customer_id`) VALUES (?,?,?,?,?,?)";

				//prepare the statement $param_
					//prepare the query - is correct
					if ($stmt = mysqli_prepare($conn,$sql)) {
						//bind
						mysqli_stmt_bind_param($stmt,"siidsi",$param_product_name,$param_product_id,$param_quantity,$param_cost,$param_customer_name,$param_customer_id);
						//bind.

						$param_product_name = $productName;
						$param_product_id =  $productId;
						$param_quantity = $productQuantity;
						$param_cost = $productCost;
						$param_customer_id = $customerId;
						$param_customer_name = $customerName;

						//execute query
						if (mysqli_stmt_execute($stmt)) {
							# code...
							echo "Purchase made successfully";
							header('location:mypurchases.php');

						}else{
							echo "Something went wrong";
						}


					}
			}


			?>
			</div>
			
		</div>

	</div>
</body>
</html>
		