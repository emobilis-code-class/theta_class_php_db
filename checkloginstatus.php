<?php
if (!isset($_SESSION['name'])) {
						# code...
				header("location:login.php");
			}
?>