<?php
    ob_start();
    session_start();
    if(isset($_SESSION['sess_username']))
    {
	   include "navigation.php";
?>

<html lang="en">

<head>
    <title>Upload</title>
</head>

<body>
    <section id="main-content">

          <section class="wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Upload
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Upload
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="alert alert-warning">
                    <strong>Warning!</strong> <a style= "color:red" href = "time_table_template/sem.xlsx"> Before uploading have a look at our template! </a>
                </div>
                <!--Warning and Red font to look for template before uploading -->

                <form method="post" name="loginform" action="upload-validation.php" enctype="multipart/form-data">
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Upload a semester timetable:</h3>
                            </div>
                            <div class="panel-body">
							<!--
                                <div class="form-group">
                                    <label>Instructions:</label>
                                      Sem and course is automaically taken from excel<br>
									  plz follow the formatting guidelines<br>
									  example: lab, elective format<br>
									  pay attenton to spaces and brackets, blah blah
                                </div>
-->
                              
                                <div class="form-group">
                                    <label>Select a file :</label>
                                    <input type="file" name = "file" id = "file" onchange="document.forms[0].submit()"> 
                                </div>
                                

                                <button type="submit" class="btn btn-theme03">Submit</button>
                            </div>
                        </form>
                </div>
                </form>
                

            </div>
            <!-- /.container-fluid -->


<?php
 include "footer.php";
    }//if not logged in redirec to login page
    else
    header('Location:login.php');
?>