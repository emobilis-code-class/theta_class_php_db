<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="addproduct.php">Add Product</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="viewproduct.php">My Products</a>
  </li>

   <li class="nav-item">
    <a class="nav-link" href="mypurchases.php">My Purchases</a>
  </li>
 <!--  <li class="nav-item">
    <a class="nav-link" href="register.php" tabindex="-1" aria-disabled="true">Register</a>
  </li> -->

  <!-- <li class="nav-item">
    <a class="nav-link" href="login.php" tabindex="-1" aria-disabled="true">Login</a>
  </li> -->

  <?php
  session_start();
 
  if (isset($_SESSION['name'])) {
     $name = $_SESSION['name'];
    # code...
    echo '
<li class="nav-item">
    <a class="nav-link" href="logout.php" tabindex="-1" aria-disabled="true">Log Out</a>
  </li>
    ';

     echo '

  <li class="nav-item">
    <a class="nav-link disabled" href="" tabindex="-1" aria-disabled="true"> Hi,'.$name.'</a>
  </li>
  ';
  }else{

    echo '
<li class="nav-item">
    <a class="nav-link" href="login.php" tabindex="-1" aria-disabled="true">Login</a>
  </li>

    ';
  }
 
  ?>
</ul>