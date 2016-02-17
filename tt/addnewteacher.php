<?php
    ob_start();
    session_start();
    if(isset($_SESSION['sess_username']))
    {
	include "navigation.php";
?>
<head>
   <title>Add faculty</title>
</head>

<body>
    <section id="main-content">

          <section class="wrapper">
            <div class="container-fluid">

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
                                <i class="fa fa-file"></i> Add new teacher
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                                <?php
                    if(isset($_POST['fn']))
                    {
                        //get values from form
                        $fname=$_POST['fn'];
                        $lname=$_POST['ln'];
                        $sname=$_POST['sn'];
                        $email=$_POST['mail'];
                        $phone=$_POST['phone'];

                        //enable connection to db and report error if failure
                        include 'connect.php';

                        //execute query
                        $query="Insert into faculty(`first_name`, `last_name`, `ID`, `email`, `phone_no`) values('$fname','$lname','$sname','$email','$phone');";
                        $result=mysqli_query($con,$query);
                        mysqli_close($con);

                        if($result){
							?>
							
	<BR><BR>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>New faculty added</strong> successfully!
    </div>
							<?php
						}
                    }
                ?> 
				
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Add a new teacher to the department: </h3>
                            </div>
                             <div class="panel-body">
                                <form action = "" method = "post">
                                <div class="form-group">
                                    <label>First Name:</label>
                                    <input class="form-control" name = "fn" placeholder="FN" required>
                                </div>
                                <div class="form-group">
                                    <label>Last Name:</label>
                                    <input class="form-control" name = "ln" placeholder="LN" required>
                                </div>
                                <div class="form-group">
                                    <label>Initials:</label>
                                    <input class="form-control" name = "sn" placeholder="INI" required>
                                </div>
                                <div class="form-group">
                                    <label>Email ID:</label>
                                    <input class="form-control" name = "mail" placeholder="E-mail" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number:</label>
                                    <input class="form-control" name = "phone" placeholder="Phone" required>
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