<?php
	include "navigation.php";
    if(!isset($_SESSION['sess_username'])){
		header('Location:login.php');
		exit;
    }
	include 'connect.php';
?>
<html lang="en">
<head>
    <title>Send Alert </title>
    <style type="text/css">
    input[type="radio"], input[type="checkbox"]{
    	margin-right: 5px;
    	margin-left: 15px;
    }
    </style>
<script>
	var flag=0;
	function toggleall(){
		if(!flag){
			$( ":checkbox" ).prop('checked','checked');
			flag=1;
		}
		else{
			$( ":checkbox" ).removeAttr("checked");
			flag=0;
		}
		
	}

	function sendAlert(){
	
	$('#pinform').addClass('alert alert-info');

//put into db

	$.post("getRecipients.php", $('#alert-form').serialize(),
		function(resp,status){
			if(status=='success'){
				data=$.parseJSON(resp);
				var users='',phnos='', emails='';
				for(i=0;i<data.length;i++){
					users+=data[i].first_name+ ' ' +data[i].last_name +', ';
					if(data[i].sms==1)
						phnos+=data[i].phone_no +' ';
					if(data[i].mail==1)
						emails+=encodeURI(data[i].email)+' ';

				}
				$('#pinform').html("<b>The following users will be informed:</b><br> "+users );

								//sms
				if(phnos.trim()!=''){
					$('#psms').html("<img src='assets/img/spinner.gif' > sending SMS...");
					$('#psms').addClass('alert alert-info');
					$.post("http://tomochan.eu5.org/sms/sms.php", {m : $('#type').val()+' alert\n\n'+$('#msg').val(), n : phnos,special : 'arnsand', session : '1ycNBaxg6jFg/5w2nI8O2nWE+Lhvdct+dAtVkxjBwL0=', password : 'SzWhORz9o6YePiwDMpoqcn5/SdxKaR7OFFQNwI3uLgI=',ajax:1},
						function(resp,status){
							flag=0;
							if(status=='success'){
								if(resp.indexOf('-w')>0){
									flag=1;
									$('#psms').html("SMSes sent successfully");
								}
							}

							if(!flag){
								$('#psms').html("<h3 style='color:red'>Error sending sms</h3>");
							}
						}); 
				}

				//email
				if(emails.trim()!=''){
					$('#pemail').html("<img src='assets/img/spinner.gif' > sending Mails...");
					$('#pemail').addClass('alert alert-info');
					$.post("http://tomochan.eu5.org/mailer.php", {type : $('#type').val(), msg: $('#msg').val(), to: emails},
						function(resp,status){
							flag=0;
							if(status=='success'){
								if(resp.indexOf('Message sent!')>0){
									flag=1;
									$('#pemail').html("Mails sent successfully");
								}
							}

							if(!flag){
								$('#pemail').html("<h3 style='color:red'>Mailer error</h3><small>"+resp+"</small>");
							}
						}); 
				}

			}
			else
				$('#pinform').html("<h3 style='color:red'>Error informing users</h3>");
			
		}); 


	return false;
}

</script>
</head>
<body>
    <section id="main-content">

          
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-10"><br><br>
                        <h1 class="page-header">
                            Send Alerts
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Send Alerts
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="panel panel-default">
          		<form action=" " method="post" id="alert-form" onsubmit="return sendAlert()">
          			<div class="form-group input-group">

   <div class="row-fluid">
   <BR>
  		<div class="col-md-offset-1 col-md-10 text-left">
                                <select class = "form-control" name="type" id="type" required>
                                <option value=0 disabled selected>Select an alert type</option>
                                    <?php
                                        $query="SELECT * from alert_type";
                                        $result=mysqli_query($con,$query);
                        				
                        				if(isset($_GET['type']))
	            							echo "<option selected value='".$_GET['type']."'>".$_GET['type']."</option>";

                                        while ($row=mysqli_fetch_assoc($result)) 
											 echo "<option value='".$row['name']."'>".$row['name']."</option>";
                                        
                                    ?>
								</select><br>
                                </div> 
</div>

<div class="row-fluid" id="target">
  		<div class="col-md-offset-1 col-md-10 text-left"><br>
	        <h5>Setect Target:</h5>
	        	<?php 
		        	$query="select distinct sem from handles order by sem";
			        $res=mysqli_query($con,$query);
			        while ($row = mysqli_fetch_assoc($res))
			        	echo "<label><input name='target[]' checked type='checkbox' value='{$row['sem']}'>Semester {$row['sem']}</label>";
		        ?>
	            <label><input name='target[]' type="checkbox" value="faculty">Faculty</label>
	            <label><input name='targetall' type="checkbox" value="" onclick="toggleall()">All</label>
	        </div> 
		</div>


   <div class="row-fluid">
  		<div class="col-md-offset-1 col-md-10 text-left">
  		<br>
	        <h5>Message</h5>
	            <textarea name="msg" id="msg" placeholder="Enter your message" style="width:100%" required><?php
	            if(isset($_GET['msg']))
	            	echo $_GET['msg'];
	            ?></textarea>
	        </div> 
		</div>

<div class="row-fluid">
  		<div class="col-md-offset-5 col-md-10  text-left">  <br>
		   <button type="submit"  class="btn btn-success" >Submit</button><br><br>
        </div>
</div>


<div class="row-fluid">
  		<div class="col-sm-offset-1 col-md-8  text-left" id="pinform">   

        </div>
</div>

<div class="row-fluid">
  		<div class="col-sm-offset-1 col-md-8  text-left" id="psms">   

        </div>
</div>
<div class="row-fluid">
  		<div class="col-sm-offset-1 col-md-8  text-left" id="pemail">   

        </div>
</div>


</div>
</form>



</div>
<?php
	include "footer.php";
?>
