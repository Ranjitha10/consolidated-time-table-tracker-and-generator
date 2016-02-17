<?php

    include "navigation.php";
?>

<html lang="en">
<head>
    <title> View </title>
    <script type="text/javascript">
    $(
        function(){
            if(document.querySelector(".table"))
                new Tablesort(document.querySelector(".table")); 
        });
    </script>
</head>

<body>
    <section id="main-content">

          <section class="wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Ongoing Classes
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> View
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Ongoing Classesa
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">View classes being held now</h3>
                    </div>
                    <div class="panel-body">
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
                            $query="SELECT class.sem,start_time,end_time,class.s_initial,room_no,faculty_id,subject.name from class,subject,handles where class.s_initial=subject.s_initial and subject.s_initial=handles.s_initial and CAST('$time' as time) between start_time and end_time and day='$day' $semq order by class.sem";
							//echo $query;
                            $result=mysqli_query($con,$query);                        
                            if($result === FALSE) 
                            {
                                die(mysqli_error($con)); // TODO: better error handling
                            }
                    
                            else if(isset($result) and $result != FALSE and $result->num_rows>0)
                            {                       
                             ?>
                                    <div class="table-responsive">
                                    <table class="table table-hover">
                                    
                                    <thead>
                                    <tr>
                                        <th>Sem</th>
                                        <th>Start Time</th>
                                        <th>End time</th>
                                        <th>Subject</th>
										<th>Subject name</th>
                                        <th>Faculty</th>
										<th>Room no.</th>
                                    </tr>
                                    </thead>

                                    <?php
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr>";
                                        echo "<td align:'center'>" . $row['sem'] . "</td>";
                                        $start=date('g:i', strtotime($row['start_time']));
                                        echo "<td valign=middle align=center>" . $start . "</td>";
                                        $end=date('g:i', strtotime($row['end_time']));
                                        echo "<td valign=middle align=center>" . $end . "</td>";
                                        echo "<td align:center>" . $row['s_initial'] . "</td>";
										echo "<td align:center>" . $row['name'] . "</td>";
                                        echo "<td align:center>" . $row['faculty_id'] . "</td>";
                                        echo "<td align:center>" . $row['room_no'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                   </table>
                                   </div>

                            <?php
                            }
                            else
                                echo 'No classes being held right now';
                            mysqli_close($con);     
                        }//end of isset of time
                        @header('Refresh:300, url= currentclass.php');
                    ?>  
                    </div>
                </div>
        </div>
            <!-- /.container-fluid -->
<?php
 include "footer.php";

?>