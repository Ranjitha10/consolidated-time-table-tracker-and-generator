<?php
    ob_start();
    session_start();
    if(isset($_SESSION['sess_username']))
    {
	include "navigation.php";
?>
<head>
   <title>Add new classroom</title>
</head>

<body>     <section id="main-content">
          <section class="wrapper">
		  

            <div class="container-fluid">
               
                 <?php
                    if (isset($_POST['roomno']) and isset($_POST['capacity']) and isset($_POST['type'])) 
                    {
                        //get values from form
                        $roomno=$_POST['roomno'];
                        $cap=$_POST['capacity'];
						$type=$_POST['type'];

                        include 'connect.php';
                        
                        //execute query
                        $query="Insert into classroom(room_no, capacity, type) values('$roomno','$cap','$type');";
                        $result=mysqli_query($con,$query);
                        mysqli_close($con);
                        //display message
						if($result){
							?>
							
	<BR><BR>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Clasroom added</strong> successfully!
    </div>
							<?php
						}
                    }
                ?>
                <!-- PHP script to insert a new class and sectio nto database -->
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Add
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Add
                            </li>
                             <li class="active">
                                <i class="fa fa-file"></i> Add new classroom
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Add a new classroom to the department: </h3>
                            </div>
                            <div class="panel-body">
                                <form action = "" method = "post">
                                <div class="form-group">
                                    <label>Enter room number:</label>
                                    <input class="form-control" name = "roomno" placeholder="room no." type="text" required>
                                </div>
                                <div class="form-group">
                                    <label>Enter capacity of the new class</label>
                                    <input class="form-control" name = "capacity" placeholder="Capacity" type="number" required>
                                </div> 
								<div class="form-group">
                                    <label>Enter classroom type:</label>
									
                                    <select name="type" class="form-control">
										<option value="UG">Under Graduate</option>
										<option value="PG">Post Graduate</option>
									</select>
                                </div>
                                <button type="submit" class="btn btn-theme03">Submit</button>
                                </form>      
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