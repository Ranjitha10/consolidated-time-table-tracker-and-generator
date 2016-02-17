<?php
	
    ob_start();
    session_start();
    if (isset($_SESSION['sess_username'])) 
    {
    	
    include "navigation.php";
    if(isset($_POST['teacher']))
    {
        @$teacher=$_POST['teacher'];
        header("Refresh:1,url=writer.php?teacher=".$teacher);
    }//end of isset of techer to create a new Excel file and sheet and pass to writer page
?>
<html>
<head>
   <title>Download</title>
</head>

<body>
    <section id="main-content">

          <section class="wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Download for teacher
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Download
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Download by teacher
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                            
                 <form method="post" action="" enctype="multipart/form-data">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Select teacher for whom the timetable should be generated:</h3>
                            </div>
                           
                            
                            
                            <div class="panel-body">
                                <div class="alert alert-info">
                                    <strong>Heads Up:</strong> The timetables generated will be stored in "PersonalTT" folder with initials.
                                </div>
                                <div class="form-group">
                                    <label>Teacher:</label>
                                        <select class="form-control" name="teacher" onchange="document.forms[0].submit()">
                                            <option disabled required selected>Teacher Initials</option>
                                            <?php
                                                include 'connect.php';
                                                $query="SELECT distinct faculty_id, first_name, last_name from handles left join faculty on handles.faculty_id=faculty.ID order by ID";
                                                $result=mysqli_query($con,$query);
                    
                                                while($row=mysqli_fetch_assoc($result))
                                                {
                                                    echo "<option value=".$row['faculty_id'].">".$row['faculty_id']." - ".$row['first_name']." ".$row['last_name']."</option>";
                                                }
                                            ?>
                                        </select>
                                         <!-- PHP script to get teacher initials present in the database form handles class-->
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                </form>


            </div>
            <!-- /.container-fluid -->

<?php
 include "footer.php";

    }
    //if not logged in redirect to login page
    else
        header('Location:login.php');
?>
