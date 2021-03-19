<!DOCTYPE html>
<html>
<head>
	<title>My Purchases</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
	<div class="container-fluid">
		<?php include('nav.php');

		require('checkloginstatus.php');

		?>

		<div class="row">
			<div class="col-3">
				<img src="https://media.istockphoto.com/vectors/empty-color-shopping-cart-flat-modern-design-colored-vector-icon-vector-id1193931745" class="img-fluid">
			</div>

			<div class="col">
				<table class="table">
				<tr >
					<th>Item</th>
					<th>Quantity</th>
					<th>Cost</th>
					<th>Total</th>
					<th>Date</th>
				</tr>

				<!-- fetch all the purcase -->

				<?php
						require_once('dbConnect.php');

						//query
						$customer_id = $_SESSION['id'];
						$sql = "SELECT * FROM sales WHERE customer_id=".$customer_id;

						//execute query - 
						/*
							mysqli_query(connection,query)
							returns results

						*/
						$results = mysqli_query($conn,$sql);
						if ($results) {
							# code...
							//
							$rows = mysqli_num_rows($results);
							if ($rows>0) {
								# code...
								while ($record = mysqli_fetch_assoc($results)) {
									# code...
									echo "<tr>";
									echo "<td>".$record['product_name']."</td>";
									echo "<td>".$record['quantity']."</td>";
									echo "<td>".$record['cost']."</td>";
									$totalCost = $record['quantity'] * $record['cost'];
									echo "<td>".$totalCost."</td>";
									echo "<td>".$record['date']."</td>";
									echo "</tr>";
								}
							}else
							{
								echo "<h4 style='color:#F1951E'>You have no purchases.</h4>";
							}

						}else
						{
							echo "Something went wrong";
						}

				?>

			</table>
			</div>
		</div>

	</div>
</body>
</html>

		