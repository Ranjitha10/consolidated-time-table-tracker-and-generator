<?php
	//start of sessions and connection to db
	ob_start();
	session_start();
	include 'connect.php';
	
	if($_POST){
		$smscheck=isset($_POST['sms'])?1:0;
		$mailcheck=isset($_POST['mail'])?1:0;
	  $query="insert into subscribes values('{$_SESSION['sess_username']}',{$smscheck},{$mailcheck}"
	  	. ") on duplicate key update sms={$smscheck}, mail={$mailcheck}";

	  $result=mysqli_query($con,$query);
	  echo "success";
	}else{
	  $query="SELECT * from subscribes where ID='{$_SESSION['sess_username']}'";
	  $result=mysqli_query($con,$query);
	  $row=mysqli_fetch_assoc($result);
	  echo json_encode($row);
	}
?>
