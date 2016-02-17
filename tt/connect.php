<?php
//function con(){
	global $con;
	$con=mysqli_connect("localhost","root","root","tt");
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		exit();
	}
	return $con;
//}
?>