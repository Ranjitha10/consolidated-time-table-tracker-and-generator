<?php
    ob_start();
    session_start();
    if(isset($_SESSION['sess_username']))
    {
	include "navigation.php";
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
                            Download by semester
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Download
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Download by sem
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                            <?php
                                if(isset($_POST['sem'])) 
                                {
                                    $sem=$_POST["sem"];
                                    $fname="semTT/".$sem."sem_tt".".xlsx";
                                    if(file_exists($fname)){
										header("Location:$fname");
                                        echo "<a href='$fname'>Click here to download!</a>";
                                     }
                                     else
                                        echo "The time table for this semester isn't available yet!";
                                }
                            ?>
                <!-- PHP script to download file if submit pressed and file exists.Else diaplay suitable message -->
<?php 				
						if($_SESSION['sess_type']=='student'){
							$fname="semTT/".$_SESSION['sess_sem']."sem_tt".".xlsx";
							echo "<a href='$fname'>Click here to download!</a>";
						}else {
						?>
                 <form method="post" action="" name="sem1">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Select the semester for downloading respective time table</h3>
                            </div>
                             
                            <div class="panel-body">
                                <div class="alert alert-info">
                                    <strong>Heads Up:</strong> The timetables generated will be stored in "Downloads" folder of your browser.
                                </div>
                                <div class="form-group">
                                    <!--<label>Select:</label>-->
                                        <select class="form-control" onchange="document.forms[0].submit()" name="sem" required>
                                            <option value=0 disabled checked>Select a Semester</option>
                                            <?php
                                            include 'connect.php';
                                            $query="select distinct sem from class order by sem";
                                            $result=mysqli_query($con,$query);
                                            while($row=mysqli_fetch_assoc($result))
                                            {
                                             echo "<option value =".$row['sem'].">".$row['sem']."</option>";
                                            }
                                            mysqli_close($con);
                                            ?>
                                        </select>
                                        <!-- PHP script to get sem values from database and from "class" table in db-->
                                </div>
                                <!--<button type="submit" class="btn btn-theme03" name="download">Submit</button>-->
                            </div>
                        </div>
                </form>
						<?php } ?>

            </div>
            <!-- /.container-fluid -->

<?php
	include "footer.php";
    }
    else
        header('Location:login.php');