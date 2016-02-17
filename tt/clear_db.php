<?php
	//start of sessions and connection to db
	ob_start();
	session_start();
	include 'connect.php';

	//query to delete values from "class" table in db and sotre a dump file
	
	
	$tables=array("class","handles","subject");
	
	foreach($tables as $table){
		unlink ( "backup/$table.sql" );
		$backupFile = str_replace('\\', '/', getcwd ( ))."/backup/$table.sql";
		$query      = "SELECT * INTO OUTFILE '$backupFile' FROM $table";
		$result = mysqli_query($con,$query);
		echo mysqli_error($con);
		$query="DELETE from $table where 1;";
		mysqli_query($con,$query);
		echo "Dumpfile generated at $backupFile<BR>";
	}
	header('Refresh:5,url=index.php');
?>

Database cleared.<BR>
<a href="index.php"> Go to home</a>