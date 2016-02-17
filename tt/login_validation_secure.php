<?php
ob_start();
session_start();
//required for start of every session

include 'connect.php';

//to prevent sql injection
$user=mysqli_real_escape_string($con,$_POST['uname']);
$pass=mysqli_real_escape_string($con,$_POST['pass']);
$hash=hash('sha512', $pass, false);
 
 //prevent sql injection
$stmt =$con->prepare("SELECT * FROM login WHERE ID = ?");
$stmt->bind_param("s",$user);
$stmt->execute();
$stmt->bind_result($duser,$dtype,$dpass);
$stmt->fetch();
$stmt->close();

if(!$duser) // User not found
	echo 'No such user. Did you register?';
else if($duser==$user && $dpass==$hash)
	{
		
		session_regenerate_id();
		$_SESSION['sess_username'] = $user; 
		$_SESSION['sess_type'] = $dtype;
		if($dtype=='student') //get sem 
		{
			$stmt =$con->prepare("SELECT sem, batch, first_name, last_name FROM student WHERE usn = ?");
			$stmt->bind_param("s",$duser);
			$stmt->execute();
			$stmt->bind_result($dsem,$dbatch,$dfname,$dlname);
			$stmt->fetch();
			$_SESSION['sess_sem'] = $dsem;
			$_SESSION['sess_batch'] = $dbatch;
			$stmt->close();
		}else {
			$stmt =$con->prepare("SELECT first_name, last_name FROM faculty WHERE ID = ?");
			$stmt->bind_param("s",$user);
			$stmt->execute();
			$stmt->bind_result($dfname,$dlname);
			$stmt->fetch();
			$stmt->close();
		}
		$_SESSION['sess_fullname'] = $dfname.' '.$dlname;
		session_write_close();
		echo "success";
		//header('Location: index.php');
	}//successful login
	else
		echo 'Credentials not correct...';
	//failed login
?>