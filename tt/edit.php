<?php
    if(isset($_POST['sem']) and isset($_POST['time']) and isset($_POST['day']) and isset($_POST['sub']))
    {
        $sem=$_POST['sem'];
        $start=$_POST['time'];
        $day=$_POST['day'];
        $subject=$_POST['sub'];
        $link="edit-validate.php?sem=".$sem."&time=".$start."&day=".$day."&sub=".$subject."";
        header('Location:'.$link);
    }
?>

<?php
    ob_start();
    session_start();
    if(isset($_SESSION['sess_username']))
    {
    include "navigation.php";
?>
<head>
   <title>Edit</title>
    <style type="text/css">
    .btn-inline{
        float: right;
        top: -8px;
        position: relative;

    }
    </style>
</head>
<script>
function checkAndSubmit(a)
{
    if(document.getElementById(a).selectedIndex>0)
        document.getElementById("edit-form").submit();
}
</script>

<body>
    <section id="main-content">

          <section class="wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Edit
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Edit
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit a class in the timetable: <a href="edit.php" style="color:white" class="btn btn-danger btn-inline">Reset form</a></h3>
                    </div>
                    <div class="panel-body">
                        
                        <form method="post" action="" name="edit-form" id="edit-form">
                            <div class="form-group" id="day-form">
                                <select class = "form-control" name="sem" id="sem" onchange="checkAndSubmit('sem')">
                                    <?php           
                                        include 'connect.php';
                                        $query="SELECT distinct sem from class where sem not in (1,2) order by sem";
                                        $result=mysqli_query($con,$query);
                                        if(isset($_POST['sem']))
                                            echo "<option value=".$_POST['sem'].">" .$_POST['sem']. "</option>";
                                        else
                                        {
                                            echo "<option value=0 disabled selected>Sem</option>";
                                            while ($row=mysqli_fetch_assoc($result)) 
                                            {   
                                                 echo "<option value=".$row['sem'].">" . $row['sem'] . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <!-- Select sem from database class table -->

                            <div style="display:none" class="form-group" id="day-div" name="day-div">  
                                <select class = "form-control" name="day" id="day" onchange="checkAndSubmit('day')">
                                    <?php
                                    
                                    $sem=$_POST['sem'];
                                    $query="select distinct day from class where sem='$sem' ORDER BY FIELD(day,'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN')";
                                    $result=mysqli_query($con,$query);
                                    if(isset($_POST['sem']) and isset($_POST['day']))
                                    echo "<option value=".$_POST['day'].">" .$_POST['day']. "</option>";
                                    else
                                    {
                                        echo "<option value=0 disabled selected>Day</option>";
                                        while ($row=mysqli_fetch_assoc($result)) 
                                        {
                                            echo "<option value='".$row['day']."'>" . $row['day'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Select day from choices -->
                        
                            <div style="display:none" class="form-group" id="time-div" name="time-div">
                                <select class = "form-control" name="time" id="time" onchange="checkAndSubmit('time')">
                                    <?php
                                    $sem=$_POST['sem'];
                                    $day=$_POST['day'];
                                    $query="select distinct start_time from class where sem='$sem' and day='$day' order by start_time";
                                    $result=mysqli_query($con,$query);
                                    if(isset($_POST['sem']) and isset($_POST['day']) and isset($_POST['time']))
                                    echo "<option value=".$_POST['time'].">" .$_POST['time']. "</option>";
                                    else
                                    {
                                        echo "<option value=0 disabled selected>Time</option>";
                                        while ($row=mysqli_fetch_assoc($result)) 
                                        {
                                            echo "<option value=".$row['start_time'].">" . $row['start_time'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Type start time for new class -->
                        
                            <div style="display:none" class="form-group" name="sub-div" id="sub-div">
                                <select name="sub" id="sub" class = "form-control" onchange="checkAndSubmit('sub')">
                                    <?php
                                        $sem=$_POST['sem'];
                                        $day=$_POST['day'];
                                        $time=$_POST['time'];
                                        $query="SELECT DISTINCT s_initial from class where sem='$sem'";
                                        $result=mysqli_query($con,$query);
                                        if(isset($_POST['sem']) and isset($_POST['day']) and isset($_POST['time']) and isset($_POST['sub']))
											echo "<option value=".$_POST['sub'].">" .$_POST['sub']. "</option>";  
                                        else
                                        {
                                            echo "<option value=0 disabled selected>Subject</option>";
                                            while ($row=mysqli_fetch_assoc($result)) 
                                            {
                                                if(!preg_match("/(?i)lab/", $row['s_initial']))
                                                echo "<option value='".$row['s_initial']."'>" . $row['s_initial'] . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <br/>
                                 <button class="btn btn-theme03" name="check">Submit</button>
								 
                            </div>
                            <!-- Select subjects for the sem from the class table -->

    
                    </form>
                    
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

<?php

    if(isset($_POST['sem']) and !isset($_POST['day']))
    {
        echo '<script type="text/javascript">
        document.getElementById("day-div").style.display="block";
        </script>';
    }
    if(isset($_POST['sem']) and isset($_POST['day']) and !isset($_POST['time']))
    {
        echo '<script type="text/javascript">
        document.getElementById("day-div").style.display="block";
        document.getElementById("time-div").style.display="block";
        </script>';
    }
    if(isset($_POST['sem']) and isset($_POST['day']) and isset($_POST['time']) and !isset($_POST['sub']))
    {
        echo '<script type="text/javascript">
        document.getElementById("day-div").style.display="block";
        document.getElementById("time-div").style.display="block";
        document.getElementById("sub-div").style.display="block";
        </script>';
    }
	
	 include "footer.php";
	 
    }//if not logged in redirect to login page
    else
    header('Location:login.php');
	
?>