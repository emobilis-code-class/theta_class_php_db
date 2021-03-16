<?php

/*
- For the php and mysql database to communicate
- establish communication - connection

-1000+ function
- enable us to achieve connection

mysqli_connect() - help connection 
- takes 4 arguments
- returns boolean - true -success , false - 
- 4 parameters

NOTE Mysql must be running

mysql -u root -p 
1- username of DBMS root
2- password - blank
3- server - localhost 127.0.0.1
4 - db_name - 

*/
//constant - 
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_SERVER', 'localhost');
define('DB_NAME', 'myshop');

$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

if ($conn) {
	# code...
	//echo "Connected successfully to the database";
}else{
	echo "Failed to connect ".mysqli_connect_error();
}




?>