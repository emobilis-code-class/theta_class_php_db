<!DOCTYPE html>
<html>
<head>
	<title>My Shop | Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
	<div class="container-fluid">
		<?php include('nav.php')?>


		<div class="row">

			<div class="col-4">
				<img src="https://cdn.shopify.com/s/files/1/0322/5894/9164/files/My_Shop_Logo_Transparent.png?height=628&pad_color=fff&v=1581933721&width=1200" class="img-fluid">
			</div>

			<div class="col-8">

				<div class="row">

					<?php
						//ensure
					require_once('dbConnect.php');

					$sql = "SELECT * FROM product ORDER BY id DESC";

					//execute query
					$results = mysqli_query($conn,$sql);
					if ($results) {
						# code...
						$rows = mysqli_num_rows($results);
						if ($rows>0) {
							# code...

							while ($record = mysqli_fetch_assoc($results)) {
								# code...
								echo '
									<div class="card col-4" style="margin-top:5px;">
									  <div class="card-body">
									    <h5 class="card-title">'.$record['name'].'</h5>
									    <p class="card-text">'.$record['description'].'
									    	<h4 style="color:#E63105;"> '.$record['cost'].'/=</h4>
									    </p>

									  </div>
									</div>
								';
							}

						}else{
							echo '<div class="alert alert-info" role="alert">
							  No Products available.
							</div>';
							echo "<a style='width:150px;' href='addproduct.php' class='btn btn-primary'>Add Product</a>";
						}
					}else{
						echo "Something went wrong.Try again";
					}

				    ?>
					
				</div>
				
				
			</div>
			
		</div>
		
		<div class="col-8">
			
		</div>
		
		
	</div>

</body>
</html>