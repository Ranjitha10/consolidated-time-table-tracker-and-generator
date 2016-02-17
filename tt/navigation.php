<?php  

error_reporting(0);
@ini_set('display_errors', 0);

ob_start(); session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/tablesort.css" />
    <script src="assets/js/jquery.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style type="text/css"> 
	.sidebar-menu{
		font-weight:bold;
	}
  thead, th
   {text-align:center !important;
   
   }
	</style>
	
  </head>

  <body>

  <section id="container" >

      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
			<a href="index.php"></a>
            <a href="index.php" class="logo"><img src="assets/img/rvce-logo.jpg" class="img-circle" width="40"> &nbsp; &nbsp; <b>Time Table Tracker</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start --
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-envelope"></i>
                            <span class="badge bg-theme">4</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 4 pending tasks</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">DashGum Admin Panel</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Database Update</div>
                                        <div class="percent">60%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Product Development</div>
                                        <div class="percent">80%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">Payments Sent</div>
                                        <div class="percent">70%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            <span class="sr-only">70% Complete (Important)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->

                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
				<li><a class="h3" href="viewprofile.php"><i class="fa fa-fw fa-user"></i>
                    <?php
                        
                        if(isset($_SESSION['sess_username']))
                        {
                            echo " ".$_SESSION['sess_fullname']." (<i>".$_SESSION['sess_type'].") </i>";
							?>
					</a></li> 
                    <li><a class="logout" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
					<?php
                        }
                        else
                        {
                            echo "Guest";
							?>
							</a></li> 
                    <li><a class="logout" href="login.php">Login</a></li>
							<?php
                        }
                    ?>
            	<!--End of php script to check if session has been set for Welcome message--></ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"></p>
              	 <!-- <h5 class="centered">Time Table</h5> -->
              	 <?php if(isset($_SESSION['sess_type']) && $_SESSION['sess_type']!='student') { ?>

                <li>
                    <a href="alertsend.php" >
                        <i class="fa fa-bell"></i>
                        <span>Send Alerts</span>
                    </a>
  
                </li>
	           	<?php } ?>	  
                  <li class="sub-menu">
                      <a  href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>View<?php
						  
						
						if($_SESSION['sess_type']=='student')
							echo " (by sem {$_SESSION['sess_sem']})";
						  ?></span>
                      </a>
                      <ul class="sub">
 
                          <li>
                                <a href="currentclass.php">Current Classes</a>
                            </li>

                            <li>
                                <a href="viewbyteacher.php">By Teacher</a>
                            </li>

                            <li>
                                <a href="viewbysem.php">By Sem</a>
                            </li>

                            <li>
                                <a href="viewbycourse.php">By Subject</a>
                            </li>

                            <li>
                                <a href="viewbytime.php">By Time</a>
                            </li>
                            <li>
                                <a href="viewbylab.php">By Labs</a>
                            </li>
<?php 
                    if ($_SESSION['sess_type']!="student") 
                    {
                    ?>
		    	<li>
                                <a href="viewfacavailable.php">Faculty availability</a>
                        </li>
			<li>
                                <a href="viewroomavailable.php">Classroom availability</a>
                        </li>
<?php } ?>
                      </ul>
                  </li>
				<?php
                    if (isset($_SESSION['sess_username'])) 
                    {
                    ?>
			
			<li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-fw fa-download"></i>
                          <span>Download</span>
                      </a>
                      <ul class="sub">
                          <li>
                                    <a href="downloadsem.php">Download Sem-wise</a>
                                    </li>
 <?php 
	if ($_SESSION['sess_type']!="student" )
                    {
                    ?>	
                                    <li>
                                        <a href="downloadteach.php">Download Teacher-wise</a>
                                    </li>
 <?php } ?>
                      </ul>		
		<?php
                    if ($_SESSION['sess_type']!="student")

                    {
                    ?>				
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-fw fa-compress"></i>
                          <span>Consolidated</span>
                      </a>
                      <ul class="sub">
                          <li>
                                    <a href="cons.php">Consolidated time table</a>
                                    </li>
                                    <li>
                                        <a href="cons.php?lab=1">Lab Consolidated</a>
                                    </li>
                      </ul>
                  </li>
      
	<?php } ?>	
<?php
                    if ($_SESSION['sess_type']=="admin" )
                    {
                    ?>		  
					<li>
                      <a href="upload.php"><i class="fa fa-fw fa-upload"></i>Upload</a>
                  </li>
					
					
                  
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-fw fa-plus-square"></i>
                          <span>Add</span>
                      </a>
                      <ul class="sub">
                         <li>
                                        <a href="addnewclass.php">Add New Classroom</a>
                                    </li>
                                    <li>
                                        <a href="addnewteacher.php">Add New Faculty</a>
                                    </li>
                      </ul>
                  </li>
				  
				  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-fw fa-minus-square"></i>
                          <span>Remove</span>
                      </a>
                      <ul class="sub">
                         <li>
                                        <a href="removeclass.php">Remove a class</a>
                                    </li>
                                    <li>
                                        <a href="removeteacher.php">Remove a Teacher</a>
                                    </li>
                      </ul>
                  </li>
				  <li>
                          <a href="edit.php"><i class="fa fa-fw fa-edit"></i>Edit</a>
                  </li>
				  
					<li>
                          <a href="clear.php"><i class="fa fa-fw fa-times"></i>Clear</a>
                  </li>
<?php } ?>

				  <?php
                    }
                    
                    ?>
				  <li>
                          <a href="teammembers.php"><i class="fa fa-fw fa-group"></i>Team Members</a>
                  </li>
                 

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
