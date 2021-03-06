<?php    include "navigation.php"; ?>
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
                            View Classes - Teacher
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View by teacher
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">View which teacher handles what class</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" name="teacher-form" id="teacher-form">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class = "form-control" name="teacher" id="teacher" onchange="loadTable(this)">
                                        <option value=0 disabled selected>Choose a teacher</option>
                                            <?php
                                                   include 'connect.php';
													$semq='';
													if($_SESSION['sess_type']=='student')
														$semq=' where sem="'.$_SESSION['sess_sem'].'" ';
                                                    $query="SELECT distinct faculty_id, first_name, last_name from handles left join faculty on handles.faculty_id=faculty.ID $semq order by ID";
                                                    $result=mysqli_query($con,$query);
                                                    while($row=mysqli_fetch_assoc($result)){
                                                     echo "<option value=".$row['faculty_id'].">".$row['faculty_id']." - ".$row['first_name']." ".$row['last_name']."</option>";
                                                    }
                                            ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="response"></div>
                <?php
                    if(isset($_POST['teacher']))
                    {
                        //connect to database
                        include 'connect.php';

                        //get form data
                        @$teacher=$_POST['teacher'];
                        echo "<x>The details for classes being taken by ".$teacher." are:<br/><br/>";
        
                        //execute query if form data is set and report failure if any
                        if($teacher)
                        {
						$semq='';
						if($_SESSION['sess_type']=='student')
							$semq=' sem="'.$_SESSION['sess_sem'].'" and ';
                            $teacher="%".$teacher."%";
                            $query="SELECT * from class, subject where subject.s_initial= class.s_initial and class.s_initial IN (select s_initial from handles where $semq faculty_id like '$teacher') ORDER BY FIELD(day,'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'), class.sem";
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
										<th>Day</th>
                                        <th>Sem</th>
                                        <th>Start Time</th>
                                        <th>End time</th>
                                        <th>Subject</th>
										<th>Subject name</th>
                                        
										<th>Classroom</th>
                                    </tr>
                                </thead>

                            <?php
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo "<tr>";
								echo "<td valign=middle align=center>" . $row['day'] . "</td>";
                                echo "<td valign=middle align=center>" . $row['sem'] . "</td>";
                                $start=date('g:i', strtotime($row['start_time']));
                                echo "<td valign=middle align=center>" . $start. "</td>";
                                $end=date('g:i', strtotime($row['end_time']));
                                echo "<td valign=middle align=center>" . $end. "</td>";
                                echo "<td valign=middle align=center>" . $row['s_initial'] . "</td>";
								echo "<td valign=middle align=center>" . $row['name'] . "</td>";
								echo "<td valign=middle align=center>" . $row['room_no'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</div>";
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
                
            <!-- /.container-fluid -->
            <?php
                }
            ?>
<?php
 include "footer.php";

?>
