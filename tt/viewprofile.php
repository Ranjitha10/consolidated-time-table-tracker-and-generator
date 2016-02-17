 <?php
    include "navigation.php";
 ?>

<html>

<head>
    <title>User Profile</title>

</head>

<body>
    <section id="main-content">

          <section class="wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12"> 
                        <h1 class="page-header">
                            User Profile
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> User Profile
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
     
                <table class="table table-hover" style="max-width:50%" id="profile">

                </table>
               </div>
            <!-- /.container-fluid -->
   <script type="text/javascript">
    $(
    function (){
	var html='';
	$.get("getprofilejson.php",
		function(resp,status){
			if(status=='success'){
				/*
				var start=resp.indexOf('<details>');
				var end=resp.indexOf('</details>',start);
				if(start==-1 || end == -1){
					alert("Couldnt parse ajax response");
				}
				*/
				var data = $.parseJSON(resp);
					html+='<tr><td><b>Account type: </b></td><td> <?php echo $_SESSION['sess_type']; ?> </td></tr>';
					html+='<tr><td><b>First Name: </b></td><td>'+data['first_name']+'</td></tr>';
					html+='<tr><td><b>Last Name: </b></td><td>'+data['last_name']+'</td></tr>';
				if(data['ID'])
					html+='<tr><td><b>Initials: </b></td><td>'+data['ID']+'</td></tr>';
				if(data['usn'])
					html+='<tr><td><b>USN: </b></td><td>'+data['usn']+'</td></tr>';
				if(data['batch'])
					html+='<tr><td><b>Batch: </b></td><td>'+data['batch']+'</td></tr>';
				if(data['sem'])
					html+='<tr><td><b>Semester: </b></td><td>'+data['sem']+'</td></tr>';	
					html+='<tr><td><b>Contact: </b></td><td><a href="tel:'+data['phone_no']+'">'+data['phone_no']+'</td></tr>';
					html+='<tr><td><b>Mail Id: </b></td><td><a href="mailto:'+data['email']+'">'+data['email']+' </td></tr>';
							$('#profile').html(html);
			}
		}); 
	
	}
	);
    </script>

<?php
 include "footer.php";

?>