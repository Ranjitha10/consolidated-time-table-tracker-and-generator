<?php
    ob_start();
    session_start();
    include 'connect.php';
 
if(isset($_REQUEST['type']) && isset($_REQUEST['msg'])){ //some1 posts sth
        $targetarr=$_POST['target'];
        $query="INSERT INTO `alert_data`(`type`, `target`, `msg`) VALUES ('{$_POST['type']}','".
            implode(' ',$targetarr)."','{$_POST['msg']}')";
        mysqli_query($con,$query);
        $semlist='';
        $hasFaculty=false;

        if(!empty($targetarr)){//there were students
           foreach ($targetarr as $sem) {
               if($sem=='faculty'){
                    $hasFaculty=true;
               }
               else
                $semlist.="'$sem', ";
           }

        }

        $json = array();
        $query="select distinct subscribes.ID,subscribes.mail,subscribes.sms,first_name,last_name,email,phone_no from subscribes join student on ID=USN and sem in ({$semlist} 0) ";
        
        if($hasFaculty)
           $query.="union select distinct subscribes.ID,subscribes.mail,subscribes.sms,first_name,last_name,email,phone_no from subscribes join faculty on subscribes.ID=faculty.ID ";
     
        $res=mysqli_query($con,$query);

		while ($row = mysqli_fetch_assoc($res)) 
		    $json[] = $row;

		echo json_encode($json);
}
?>