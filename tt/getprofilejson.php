<?php
	//start of sessions and connection to db
	ob_start();
	session_start();
	include 'connect.php';

		
		if($_SESSION['sess_type']=='student')
			$q="select * from student where usn='{$_SESSION['sess_username']}'";
		else
			$q=$tab="select * from faculty where ID='{$_SESSION['sess_username']}'";;
		$query="";

		$result=mysqli_query($con,$q);
		$row = mysqli_fetch_assoc($result);
		echo json_encode($row);
		//var_dump( $row);
?>
