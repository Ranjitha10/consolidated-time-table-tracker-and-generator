<?php
	//start of sessions and connection to db
	ob_start();
	session_start();
	include 'connect.php';
	
	if($_SESSION['sess_type']=='admin'){
		echo "[]";
		exit;
	}
	
	$sem=isset($_SESSION['sess_sem'])?$_SESSION['sess_sem']:"";
	$likestr="%".($_SESSION['sess_type']=='faculty' ? 'faculty': $sem )."%";
	$query="SELECT * FROM `alert_data` WHERE  target like '{$likestr}' ";///
	$res=mysqli_query($con,$query);
	$json = array();
	while ($row = mysqli_fetch_assoc($res)) 
		    $json[] = $row;
		
	echo json_encode($json);
?>
