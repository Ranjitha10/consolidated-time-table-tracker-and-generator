<?php
    include "navigation.php";
?>

<html lang="en">
<head>
    <title> View </title>
</head>

<body>
    <section id="main-content">

          <section class="wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            View Classes - Time
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View by time
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                 <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">View courses by time</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" onsubmit="event.preventDefault();loadTable(this);">
                            <div class="form-group">
                                <div class = "input-group">
                                    <label>Enter Time of the day:</label>
                                    <input class="form-control" placeholder="Time in 24 hrs(Eg: 13:00)" id="time" name="time" type="time">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <label> Select a semester : </label>
                                    <select class = "form-control" name="sem" id="sem" >
                                    <option value"0" selected disabled>Semester</option>
                                        <?php                   
                                             include 'connect.php';
												$semq='';
												if($_SESSION['sess_type']=='student')
													$semq=' where sem="'.$_SESSION['sess_sem'].'" ';
                                             $query="SELECT distinct sem from class $semq order by sem";
                                             $result=mysqli_query($con,$query);

                                            while ($row=mysqli_fetch_assoc($result)) 
                                            {
                                                echo "<option value=".$row['sem'].">" . $row['sem'] . "</option>";
                                             }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group"> 
                                <div class="input-group"> 
                                        <label> Select a day of the week: </label>
                                            <select class = "form-control" name="day" id="day">
                                                <option value="0" selected disabled>Day</option>
                                                <option value="MON">MON</option>
                                                <option value="TUE">TUE</option>
                                                <option value="WED">WED</option>
                                                <option value="THU">THU</option>
                                                <option value="FRI">FRI</option>
                                                <option value="SAT">SAT</option>
                                            </select>
                                </div>
                            </div>  
                            <button class="btn btn-theme03" name="check" onclick="checkAndSubmit()">Submit</button>
                        </div>
                    </div>
                    </form>
                 </div>
            <!-- /.container-fluid -->
            <div id="response"></div>
                <?php
                    if(isset($_POST['time']) || isset($_POST['day']) || isset($_POST['sem']))
                    {                        
                        //get data from form
                        @$time1=$_POST['time'];
                        @$day1=$_POST['day'];
                        @$sem1=$_POST['sem'];

                        //if all of the time day and sem are set
                        if($time1 and $day1 and $sem1)
                        {
                            $query="SELECT c.sem,c.start_time,c.end_time,c.s_initial,c.room_no,name,c.day from class as c  join subject on c.s_initial=subject.s_initial where CAST('$time1' as time) BETWEEN start_time and end_time and day='$day1' and c.sem='$sem1'; ";
                            $result=mysqli_query($con,$query);
                        }

                        //if only time and day are set
                        else if($time1 and $day1)
                        {
                            $query="SELECT c.sem,c.start_time,c.end_time,c.s_initial,c.room_no,name,c.day from class as c left join subject on c.s_initial=subject.s_initial  where CAST('$time1' as time) BETWEEN start_time and end_time and day='$day1' order by c.sem";
                            $result=mysqli_query($con,$query);
                        }
                        
                        //if only time and sem are set
                        else if($time1 and $sem1)
                        {
                            $query="SELECT c.sem,c.start_time,c.end_time,c.s_initial,c.room_no,name,c.day from class as c left join subject on c.s_initial=subject.s_initial where CAST('$time1' as time) BETWEEN start_time and end_time and c.sem='$sem1'  ; ";
                            $result=mysqli_query($con,$query);
                        }
                        
                        //if only sem and day are set
                        else if($sem1 and $day1)
                        {
                            $query="SELECT c.sem,c.start_time,c.end_time,c.s_initial, c.room_no,name,c.day from class as c  left join subject on c.s_initial =subject.s_initial where day='$day1' and c.sem='$sem1'; ";
                            $result=mysqli_query($con,$query);
                        }
        
                        //else if onyl day is set
                        else if($day1)
                        {
                            $query="SELECT c.sem,c.start_time,c.end_time,c.s_initial,name,c.day,c.room_no from class as c left join subject on c.s_initial=subject.s_initial where day='$day1' order by c.sem ";
                            $result=mysqli_query($con,$query);
                        }
        
                        //error reporting
                        if($result === FALSE) 
                        {
							
                            echo (mysqli_error($con)); 
                        }
                
                        else if(isset($result) and $result != FALSE)
                        {                       
                            $num_rows = $result->num_rows;
                            if($num_rows>0)
                            {
                                ?>
                                <x><div class="table-responsive">
                                <table class="table table-hover">
                                    
                                <thead>
                                    <tr><th>Day</th> 
                                        <th>Sem</th>
                                        <th>Start Time</th>
                                        <th>End time</th>
                                        <th>Subject</th>
										<th>Subject name</th>
                                        
										<th>Room no.</th>
                                    </tr>
                                </thead>

                                <?php
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<tr>";
									echo "<td valign=middle align=center>" . $row['day'] . "</td>";
                                    echo "<td valign=middle align=center>" . $row['sem'] . "</td>";
                                    echo "<td valign=middle align=center>" . $row['start_time'] . "</td>";
                                    echo "<td valign=middle align=center>" . $row['end_time'] . "</td>";
                                    echo "<td valign=middle align=center>" . $row['s_initial'] . "</td>";
									echo "<td valign=middle align=center>" . $row['name'] . "</td>";
                                   
                                    echo "<td valign=middle align=center>" . $row['room_no'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                            else
                            echo "No entries!";
                        }
                        else
                        echo "No entries!";
                        mysqli_close($con); 
                        echo "</x>";
                    }
                    else
                    {
                    ?> 

               
            <?php
            }
            ?>
<?php
 include "footer.php";

?>
