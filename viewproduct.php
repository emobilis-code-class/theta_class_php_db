<!DOCTYPE html>
<html>
<head>
	<title>My Shop | View Product</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
	<div class="container-fluid">
		<?php include('nav.php');

		if (!isset($_SESSION['name'])) {
						# code...
				header("location:login.php");
			}
		?>
		<h1 >My Products</h1>

		<div class="col-8">

			<table class="table">
				<tr >
					<th>Name</th>
					<th>Description</th>
					<th>Cost</th>
				</tr>
			

		<?php
		/*
			SELECT
			1.Make a connection
			2.write a sql query - SELECT * FROM <table>
			3.Execute - results
			     - 
			4.Display


		*/
			require_once('dbConnect.php');

			//query

			$sql = "SELECT * FROM product";

			//execute query - 
			/*
				mysqli_query(connection,query)
				returns results

			*/
			$results = mysqli_query($conn,$sql);

			if ($results) {
				# code...
				//check the results are there or not
				//count
				$rows = mysqli_num_rows($results);
				if ($rows>0) {
					# code...
					//results to display
					//arrays
					//associative array - key value
					/*
						key -column
					*/
						//loop every record - convert into an 

					while($record = mysqli_fetch_assoc($results)){
						/*echo $record['name'].' Price Ksh'.$record['cost'];
						echo "<br>";*/
						//do in table row
						echo "<tr>";
						echo "<td>".$record['name']."</td>";
						echo "<td>".$record['description']."</td>";
						echo "<td>".$record['cost']."</td>";
						$productId = $record['id'];

						echo "<td>";
						echo '
						<a href="editProduct.php?id='.$productId.'" class="btn btn-primary">Edit Product</a>

						<form method="POST" action="" style="margin-top:5px;">
						<input type="hidden" name="productId" value="'.$productId.'"/>
						<button type="submit" name="delete" class="btn btn-danger">Delete Item</button>
						</form>
						';
						echo "</td>";
						echo "</tr>";
					}
				}else{
					//no products available
					echo '<div class="alert alert-info" role="alert">
					  No Products available.
					</div>';
				}
			}else{
				echo "Something went wrong ".mysqli_error($conn);
			}

		?>

		<?php
		if (isset($_POST['delete'])) {
			$productId = $_POST['productId'];
			//get connection 
			//query
			$sql = "DELETE FROM product WHERE id=".$productId;
			//execute the query
			$result = mysqli_query($conn,$sql);
			//check status
			if ($result) {
				# code...
				echo '<div class="alert alert-info" role="alert">
							 Product Delete Successfully.
							</div>';
			}else{
				echo "Failed to delete the product.Try again";
			}
		}

		?>

		</table>
			
		</div>
		
	</div>

</body>
</html>