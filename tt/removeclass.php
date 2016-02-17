<?php
    ob_start();
    session_start();
    if(isset($_SESSION['sess_username']))
    {
	include "navigation.php";
?>
<head>
   <title>Remove</title>
</head>

<body>
    <section id="main-content">

          <section class="wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Remove
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Remove
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Remove a Class
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <?php
                    include 'connect.php';
                    if(isset($_POST['roomno']))
                    {
                        $roomno=$_POST['roomno'];
                        $query="DELETE from classroom where room_no='$roomno';";
                        $result=mysqli_query($con,$query);
                        if($result){
							?>
	<div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Classroom deleted</strong> successfully!
    </div>
	<?php
						}
                    }
                ?>
                <!-- PHP script to remove ebtries from sem table in database -->
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Remove a classroom from the department: </h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-warning">
                            <strong>Warning!</strong> You are removing a classroom from the department.
                        </div>
                        <form action = "" method = "post">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class = "form-control" name="roomno" id="sel" onclick="checkAndSubmit()">
                                        <option value=0 disabled selected> Classroom no.</option>
                                        <?php                   
                                             $query="SELECT distinct room_no from classroom;";
                                             $result=mysqli_query($con,$query);

                                            while ($row=mysqli_fetch_assoc($result)) 
                                            {
                                                echo "<option value=".$row['room_no'].">" . $row['room_no'] . "</option>";
                                            }
                                            mysql_close();
                                        ?>
                                        <!-- PHP script to get values from database to form from sem table -->
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-theme04">Remove</button>
                        </form>  
                    </div>
                </div>
              </div>
            </div>
            <!-- /.container-fluid -->

<?php
 include "footer.php";
    }//if not logged in redirec to login page
    else
    header('Location:login.php');
?>