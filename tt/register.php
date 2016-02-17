<?php
	
	include 'connect.php';
	$invalid=0;
  if(isset($_POST['type']))
    {
		$a=$_POST;
		$type=$a['type'];
		//print_r($a);
		
		$idexists=0;
		$phexists=0;
		$emailexists=0;
		$passwordmismatch=0;

			//check for existing user
		if($type==2){
			$resid=$con->query("select * from faculty where ID='{$a['init']}' ");
			$resph=$con->query("select * from faculty where phone_no='{$a['phno']}' ");
			$resemail=$con->query("select * from faculty where email='{$a['email']}' ");
		}else if($type==1){
			$resid=$con->query("select * from student where usn='{$a['usn']}' ");
			$resph=$con->query("select * from student where phone_no='{$a['phno']}' ");
			$resemail=$con->query("select * from student where email='{$a['email']}' ");
		}
		//print_r($resid);
		$idexists= $resid->num_rows!=0;
		$phexists= $resph->num_rows!=0;
		$emailexists=$resemail->num_rows!=0;
		$passwordmismatch=$a['password']!=$a['password2'];
		
	$invalid=$idexists||$phexists||$emailexists||$passwordmismatch;
		
		if(!$invalid){

			if($type==1){
				//student
				$typestr="student";
				$username=$a['usn'];
				
				$query="insert into student (`first_name`, `last_name`, `usn`, `phone_no`, `email`, `batch`, `sem`) VALUES ('{$a['fname']}', '{$a['lname']}', '{$a['usn']}', '{$a['phno']}', '{$a['email']}', '{$a['batch']}', '{$a['sem']}')";				
				$con->query($query);
				
				
			}
			else if($type==2){
				//faculty
				$typestr="faculty";
				$username=$a['init'];
				
				$query="insert into faculty(`first_name`, `last_name`, `ID`, `phone_no`,`email` ) VALUES ('{$a['fname']}', '{$a['lname']}', '{$a['init']}', '{$a['phno']}', '{$a['email']}')";
				
				$con->query($query);
				
			}
			
			//anyways
			$hash= hash('sha512', $a['password'], false);
			$query="insert into login (`ID`, `type`, `password`) VALUES ('{$username}', '{$typestr}', '{$hash}')";
			$con->query($query);
			
			$query="insert into subscribes VALUES ('{$username}', 1,1)";
			$con->query($query);

			echo "Account successfuly created";
			header('Refresh:1,url=login.php');
		}
	}
	if(!isset($_POST['type']) || $invalid){
		include "navigation.php";
?>
<html lang="en">
<head>
    <title> Register </title>
</head>
<script>
    function prepareform()
    {
       type=$("input[name=type]:checked").val();
	   if(type==1){
		   //student
		   $('input[name=init]').parent().remove();
	   } else if(type==2){
		   //faculty
		   $('input[name=usn]').parent().remove();
		   $('select[name=sem]').parent().remove();
		   $('select[name=batch]').parent().remove(); 
	   }
	   $('#typechooser').fadeOut(800); 
	   $('#innerform').slideDown(800);
    }
    $(function(){
    	$('.sidebar-toggle-box > div').click().hide();
    });
	

</script>

<body>

    <div class="container">
        <div class="row pad-top ">
            <div class="col-md-12">
                <h2>SIGN UP</h2>
				
            </div>
        </div>
         <div class="row  pad-top">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong> Create Your Account </strong>  
                            </div>
                            <div class="panel-body">
		<?php if($invalid){ ?>
									 	<div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
       
               <?php
	    if($idexists)
			echo "This user ID/USN already has an account.<hR>";
		if($emailexists)
			echo "This email address already has an account.<hR>";
		if($phexists)
			echo "This phone number alredy has an account.<hR>";
		if($a['password']!=$a['password2'])
			echo "Please enter the same password twice.<BR>";
			   ?>
			</div>
		<?php } ?>
                                <form id="form" action="" method="post" role="form" autofill="off">
								 <div class="form-group input-group" id="typechooser">
                                            <span class="input-group-addon"><i class="fa fa-user"  ></i> Registering as:</span>
                                             <label><input type="radio" name="type" value="1" onclick="prepareform()">Student</label>
											 <label><input type="radio" name="type" value="2" onclick="prepareform()">Faculty</label>
                                        </div>
<br/>
<div id="innerform" style="display:none">
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                            <input type="text" class="form-control" placeholder="First Name" name="fname"  required pattern="[a-zA-Z. ]+" />
                                        </div>
										<div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Last Name" name="lname"  required  pattern="[a-zA-Z. ]+" />
                                        </div>
										<div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-asterisk"  ></i></span>
                                            <input type="text" class="form-control" name="init" placeholder="Faculty initials" required pattern="[a-zA-Z.]{0,5}" />
                                        </div>
										
										
                                     	<div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-asterisk"  ></i></span>
                                            <input type="text" class="form-control" name="usn"placeholder="USN" required pattern="1RV[\d]{2}[\w]{2}[\d]{3}" />
                                        </div>
										<!--
										<div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tablet"  ></i></span>
                                            <input type="text" class="form-control" name="username"placeholder="username" required />
                                        </div>
										-->
										<div class="form-group input-group">
										<span class="input-group-addon"><i class="fa fa-lock" ></i></span>
										<input type="password" class="form-control" name="password" placeholder="Enter Password" required />
									</div>
										<div class="form-group input-group">
										<span class="input-group-addon"><i class="fa fa-lock" ></i></span>
										<input type="password" class="form-control" name="password2" placeholder="Confirm Password" required />
									</div>
									<div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope" ></i></span>
                                            <input type="email" class="form-control" name="email" placeholder="Your Email"  required/>
                                        </div>
										<div class="form-group input-group">
                                            <span class="input-group-addon">+91</span>
                                            <input type="text" class="form-control" name="phno" placeholder="Your mobile no."  required pattern="[\d]{10}" />
											</div>
         <div class="form-group input-group">
                                      <label>Select Semester</label>
                                    <select class = "form-control" name="sem"  required>
                                    <?php 
                                    for($i=1;$i<=8;$i++)
										echo "<option value='{$i}'>{$i}</option>\n";
                                    ?>
                                        <option value="IT-2">M.Tech(IT-1)</option>
                                        <option value="SE-2">M.Tech(SE-1)</option>
                                    </select>
                                </div>       
								
        	<div class="form-group input-group">
										<label>Select Batch</label>
										<select class = "form-control" name="batch" required>
										<option value="0" selected>none</option>
										<option value="B1">B1</option>
                                        <option value="B2">B2</option>
                                        <option value="B3">B3</option>
                                        <option value="B4">B4</option>
                                          
                                    </select>
                                </div>       
        
                                     <button type="submit" class="btn btn-success ">Register Me</button>
								</div>
                                    Already Registered ?  <a href="login.php" >Login here</a>
                                    </form>
                            </div>
                           
                        </div>
                    </div>
                
                
        </div>
    </div>


<?php
}
include "footer.php";
?>

