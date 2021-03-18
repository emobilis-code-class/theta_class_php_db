<?php

session_start();

//clear destroy session
session_destroy();
//login
header('location:login.php');

?>