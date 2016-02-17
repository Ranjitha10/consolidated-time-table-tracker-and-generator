<?php
    ob_start();
    session_start();
    if(isset($_SESSION['sess_username']))
    {
	include "navigation.php";
?>
<head>
   <title>Classroom Availability</title>
</head>

<body>     <section id="main-content">
          <section class="wrapper">
		  

            <div class="container-fluid">
               

                <!-- PHP script to insert a new class and sectio nto database -->
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Faculty Availability
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View
                            </li>
                             <li class="active">
                                <i class="fa fa-file"></i> Classroom Availability
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Search for a free classroom:</h3>
                            </div>
                            <div class="panel-body">
                                <form action = "" id="f1" method = "post" onsubmit="event.preventDefault();loadTable(this);">

				<input type="button" class="btn btn-theme03" value="Now" onclick="populatenow()">
				<br>
<hr style="border-top: 1px solid #ECE9E9;"> 

                                <div class="form-group">
                                    <label>Day</label>
                                    <select class = "form-control" name="day" id="day" required>
										<option value="0" selected disabled>Select a day</option>
										<option value="MON">MONDAY</option>
                                        <option value="TUE">TUESDAY</option>
                                        <option value="WED">WEDNESDAY</option>
                                        <option value="THU">THURSDAY</option>
                                        <option value="FRI">FRIDAY</option>
                                        <option value="SAT">SATURDAY</option>
                                          
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Time:</label>
                                    <input class="form-control" type="time" name = "time" id="time" placeholder="time(in 24 hrs clock)" required >
                                </div>
                                <button type="submit" class="btn btn-theme03">Submit</button>
                                </form>      
                            </div>  
               </div>

               <div id="response"></div>
               <?php
                    if(isset($_POST['day']) && isset($_POST['time']))
                    {
                        include 'connect.php';

                        //get form data
                        @$day=$_POST['day'];
			@$time=$_POST['time'];
                        echo "<x>The free classroom available at {$time} on {$day} are:<br/><br/>";
        
                        //execute query if form data is set and report failure if any
                        if($day && $time)
                        {
                           
                            $query="select distinct room_no, capacity, type from classroom where room_no not in  (select room_no from class where  CAST('{$time}' as time) BETWEEN start_time and end_time and day='{$day}')";
							//echo $query;
                            $result=mysqli_query($con,$query);
                        }
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
                                    
                                <thead>
                                    <tr>
                                        <th>Room no.</th>
                                        <th>Capacity</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>

                            <?php
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo "<tr>";
                                echo "<td valign=middle align=center>" . $row['room_no'] . "</td>";
                                echo "<td valign=middle align=center>" . $row['capacity']. " " . $row['last_name']. "</td>";
                                echo "<td valign=middle align=center>" . $row['type'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</div>";
                           // echo "</div>";
                        }
                        else
							echo "No entries!";
                    }
                    else
						echo "No entries!";
                    //mysqli_close($con); 
                        echo "</x>";
                }
                else
                {
    
                ?>
                
            <!-- /.container-fluid -->
            <?php
                }
            ?>


            </div>
            <!-- /.container-fluid -->
			<script type="text/javascript">
			function populatenow(){
				d=new Date();
				$("#time").val(d.getHours()+":"+d.getMinutes()+":00");
				$("#day :nth-child("+(d.getDay()+1)+")").prop('selected', true);
				$('#f1').submit();
			}
			</script>

			
<?php
	include "footer.php";
    }//if not logged in redirec to login page
    else
    header('Location:login.php');
?>
