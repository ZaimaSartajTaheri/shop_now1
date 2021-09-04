<?php
$mysql_host='localhost';
$mysql_user='root';
$mysql_password='';
$mysql_db='ecommerce_site';

$con=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);

if(mysqli_connect_error()){
    echo "Failed to connect to PHPMyAdmin: " . mysqli_connect_error();
}
?>