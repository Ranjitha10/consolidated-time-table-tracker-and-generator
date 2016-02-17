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
                            View Labs
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View labs
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">View labs conducted:</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="" id="lab-form">
                            <select class = "form-control" name="lab" id="lab"  onchange="loadTable(this)">
                                <option value=0 disabled selected>Select a Lab</option>
                                    <?php
                                        include 'connect.php';
										$semq='';
										if($_SESSION['sess_type']=='student')
											$semq=' and sem="'.$_SESSION['sess_sem'].'" ';
                                        $query="SELECT distinct s_initial from subject where type='lab' $semq order by sem;";
                                        $result=mysqli_query($con,$query);
										
										$labsubs=array();
										
                                        while ($row=mysqli_fetch_assoc($result)){
											preg_match("/[\w-&]+/",$row['s_initial'],$found);
											array_push($labsubs,$found[0]);
                                        }
										
										$labsubs=array_unique($labsubs);
										foreach($labsubs as $labsub)
											 echo "<option value=\"$labsub\">$labsub</option>";
                                    ?>
                            </select>
                        </form>
                    </div>
                </div>

                 </div>
            <!-- /.container-fluid -->
            <div id="response"></div>
                <?php
                    if(isset($_POST['lab']))
                    {
                        

                        //get form data
                        @$subject=$_POST['lab'];
                        echo "<x>The details for labs in ".$subject." are:<br/><br/>";
        
                        //execute query if form data is set and report failure if any
                        if($subject)
                        {
                            $subject="%".$subject." LAB%";
							$query="SELECT class.sem, start_time, end_time, class.s_initial, name, day, GROUP_CONCAT(handles.faculty_id SEPARATOR ', ') as teach from class natural join subject  left join handles on class.s_initial=handles.s_initial where class.s_initial LIKE '$subject' group by class.s_initial ORDER BY FIELD(day,'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN') ";
                            
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
                                    <tr><th>Day</th>
                                        <th>Sem</th>
                                        <th>Start Time</th>
                                        <th>End time</th>
                                        <th>Subject</th>
                                        <th>Subject name</th>
                                        <th>Teachers</th>
                                        
                                    </tr>
                                </thead>

                            <?php
                            while($row = mysqli_fetch_assoc($result))
                            {
                                                       
                                echo "<tr>";
								echo "<td valign=middle align=center>" . $row['day'] . "</td>";
                                echo "<td valign=middle align=center>" . $row['sem'] . "</td>";
                                $start=date('g:i', strtotime($row['start_time']));
                                echo "<td valign=middle align=center>" . $start . "</td>";
                                $end=date('g:i', strtotime($row['end_time']));
                                echo "<td valign=middle align=center>" . $end . "</td>";
                                echo "<td valign=middle align=center>" . $row['s_initial'] . "</td>";
								echo "<td valign=middle align=center>" . $row['name'] . "</td>";
                                
                                echo "<td valign=middle align=center>" . $row['teach'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            echo "</div>";
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

                
            <?php
                }
				include "footer.php";
            ?>
