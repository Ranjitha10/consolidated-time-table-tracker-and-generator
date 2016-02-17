<?php
	
	include "navigation.php";
if(!isset($_SESSION['sess_username']))
		header('Location:login.php');
?>
<html>

<head>
   <title>Time Table tracker</title>
   <style type="text/css" >
   hr{
	   margin:12px;
   }
   </style>

   <script type="text/javascript">
      //setTimeout(function(){setInterval(loadTable,5000)},5000);
   </script>
</head>

<body>

    <section id="main-content">
 <div class="container-fluid">
          <section class="wrapper">
            <div class="container-fluid"><br><br>
                  	      
						<div class="row">
						
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            WELCOME!
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                           
                        </ol>
                    </div>
                
                <!-- /.row -->
       <details id="response">
       <details>
        <div class="col-lg-6 pull-left">	
				
				<?php 		

				include 'connect.php';
					
					//execute query and report failure
					$query="SELECT * FROM `alert_data` WHERE  type in (select type from subscribes where ID='{$_SESSION['sess_username']}' )";///
					//echo $query;
					$result=mysqli_query($con,$query);
					
					if(isset($result) and $result != FALSE and $result->num_rows>0)
					{                       
						 while($row = mysqli_fetch_assoc($result))
						{
							echo "<div class='alert alert-warning '><a href='#' class='close' data-dismiss='alert'>&times;</a><strong>{$row['type']} alert: </strong> <br>{$row['msg']}</div>\n\n";
							
						}
					}else{
						?>
						<div class='alert alert-info '><strong>No alerts for you. </strong> <br></div>
					<?php }
				
						if($_SESSION['sess_type']=='student')
						{
							?>
							<a href="viewbysem.php"><button type="submit" class="btn btn-theme03">View Time-Table</button></a>
							&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<a href="downloadsem.php"><button type="submit" class="btn btn-theme03"> Download Time-Table</button></a>
						<?php } ?>
						<?php 				
						if($_SESSION['sess_type']=='faculty')
						{
							?>
							<a href="viewbyteacher.php"><button type="submit" class="btn btn-theme03">View Time-Table</button></a>
							&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<a href="downloadteach.php"><button type="submit" class="btn btn-theme03"> Download Time-Table</button></a>
						<?php } ?>
						<?php 				
						if($_SESSION['sess_type']=='admin')
						{
							?>
							<a href="viewbysem.php"><button type="submit" class="btn btn-theme03">View Time-Table</button></a>
							&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<a href="downloadsem.php"><button type="submit" class="btn btn-theme03"> Download Time-Table</button></a>
						<?php } ?>
					</div>
          
						<div class="col-md-4 ds pull-right">
						<a style= "color:blue" href = "currentclass.php"> <h3 class="black-bg"><span class="badge bg-theme"><i class="fa fa-clock-o"></i></span> Ongoing classes</h3></a>
                                        
                      <!-- First Action -->
                      <br>
                      	<div >
                      		
							   
							   
							   
							   <?php
                        if(!isset($time))
                        {
                            //get current time values
                            date_default_timezone_set('Asia/Kolkata');
                            $timestamp = time()-86400;
                            $date = strtotime("+1 day", $timestamp);
                            $day=date('D', $date);
							$day=strtoupper($day);
                            $time=date('H:i', $date);

                            //enable connection to database
                            include 'connect.php';
                            
							$semq='';
						if($_SESSION['sess_type']=='student')
							$semq=' and class.sem="'.$_SESSION['sess_sem'].'" ';
						
                            //execute query and report failure
                            $query="SELECT * from class left join  subject on class.s_initial= subject.s_initial WHERE CAST('$time' as time) between start_time and end_time and day='$day' $semq order by class.sem";
							//echo $query;
                            $result=mysqli_query($con,$query);                        
                            if($result === FALSE) 
                            {
                                die(mysqli_error($con)); // TODO: better error handling
                            }
                    
                            else if(isset($result) and $result != FALSE)
                            {                       
                                $num_rows = $result->num_rows;
                                if($num_rows>0)
                                {
                                    ?>
                                    <div class="table-responsive">
                                    <table class="table table-hover">
                                    
                                    

                                    <?php
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr>";
										$end=date('g:i', strtotime($row['end_time']));
										echo "Sem: {$row['sem']} | <b>{$row['s_initial']}</b> | till $end <hR>";
										/*
                                        echo "<td align:'center'>" . $row['sem'] . "</td>";
                                        
                                        
                                        echo "<td valign=middle align=center>" . $end . "</td>";
                                        echo "<td align:center>" . $row['s_initial'] . "</td>";
										*/
										//echo "<td align:center>" . $row['name'] . "</td>";
                                        
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                    echo "</div>";
                                    echo "</div>";
                                    //end of the tabular data display
                                }
                                else
                                    echo "No classes being held now!";
                            }
                            else
                                echo "No classes being held now";
                            mysqli_close($con);     
                        }//end of isset of time
                        
                    ?>  
							   
							   
							   
							   <br><br/>
                      		</p>
                      	</div>
                      </div>
                     </details></details>
                      <!-- Second Action 
                      <div class="desc">
                      	<div class="thumb"><br>
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details"><br>
                      		<p><muted>Upcoming Class :</muted><br/>
                      		   <a href="#"></a> <br/>
                      		</p>
                      	</div>
                      </div>
                      -->
                      </div></div></div>
            
			
<?php
 include "footer.php";

?>

  