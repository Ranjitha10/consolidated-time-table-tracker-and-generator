  <script>
    function warning()
    {
        var msg="Confirm Delete?This action is irrevocable!";
        var ch=confirm(msg);
        if (ch==1)
        {
            location.replace("clear_db.php");
        }
    }
    </script>

<?php
	include "navigation.php";
?>
<head>
   <title>Clear</title>
</head>

<body>
    <section id="main-content">

          <section class="wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Clear
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Clear
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Dump Entire database content:</h3>
                            </div>
                             <div class="panel-body">
                                <div class="alert alert-danger">
                                    <strong>Warning!</strong> This action is irrevocable!.
                                </div>
                                <div class="form-group">
                                  <button type="button" class="btn btn-danger" onclick = warning()>Dump and clear database</button>
                                </div>
                            
                             
                            </div>
                               
                                
                </div>
                           
           
            </div>
            <!-- /.container-fluid -->
<?php
 include "footer.php";

?>