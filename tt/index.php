<?php
	
	include "navigation.php";
if(!isset($_SESSION['sess_username']))
		header('Location:login.php');
?>
<html>

<head>
   <title>Time Table tracker</title>
   <style type="text/css" >
   hr{
	   margin:12px;
   }

   .btn-inline{
        float: right;
        top: -8px;
        position: relative;
        background: #888;
        color:#fff;
    }
      .btn-inline:hover{
        background: #333;
        color:#fff;
    }
    }
   </style>

   <script type="text/javascript">

   var userid="<?php echo $_SESSION['sess_username']; ?>";

    function checkAlerts(){
      $.get("getmyalerts.php",
        function(resp,status){
          if(status=='success'){
            var data=$.parseJSON(resp);
            var flag=0;

            $('#alerts').html('');

            var hiddenAlerts=localStorage.getItem(userid);
            if(hiddenAlerts)
              hiddenAlerts=hiddenAlerts.split(" ");

            for(i=0;i<data.length;i++){

              if(!hiddenAlerts || hiddenAlerts.indexOf(data[i].id)==-1){
                //create a new alert box
                el=document.createElement('div');
                el.className='alert alert-info';
                msgbox=$(el).html("<a href='#' class='close' data-dismiss='alert' data-id='"+data[i].id+"' onclick='dismiss(this)'>&times;</a>")
                .append("<b>"+data[i].type+"</b>")
                .append("<small class='pull-right'>"+data[i].date+" &nbsp; &nbsp; </small><br>")
                .append("<div>"+data[i].msg+"</div>");
                $('#alerts').append(msgbox);
                flag=1;
              }
            }
//no alerts
            if(flag==0){
              if(hiddenAlerts)
                $('#alerts').html("<div class='alert alert-success'><b>Your alerts are hidden.</b><br>"+
                  "<a href='#' onclick='clearstorage()'>Click to restore</a></div>");
              else
                $('#alerts').html("<div class='alert alert-success'><b>No alerts for you!</b></div>");
            }
          }
        }
        );
    }
    $(checkAlerts);
    setInterval(checkAlerts,5000);
    

    function dismiss(el){
        console.log($(el).data('id'));
        localStorage.setItem(userid,localStorage.getItem(userid)+" "+$(el).data('id'));
        checkAlerts();
    }

    function clearstorage(){
        localStorage.removeItem(userid);
        checkAlerts();
    }

    function togglesettings(){
    //ui

      if($('#alerts').is(":visible")){
        $('#alerts').slideUp();
        $('#settings-form').slideDown();


     //data
     $.get("getsetsubscription.php", function(resp,status){
              if(status=='success'){
                data=$.parseJSON(resp);
                if(data && data.ID){
                    $('#smscheck').prop("checked",data.sms==1);
                    $('#mailcheck').prop("checked",data.mail==1);
                }
              }
            });


      }else{
        $('#settings-form').slideUp();
        $('#alerts').slideDown();       
      }


    }

    function updatesub(){
      $.post("getsetsubscription.php", $('#settings-form').serialize(),
        function(resp,status){
              flag=0;
              if(status=='success'){
                if(resp.indexOf('success')>=0){
                  flag=1;
                  alert("Subscription updated successfully");
                  togglesettings();
                }
              }

              if(!flag){
                //$('#psms').html("<h3 style='color:red'>Error sending sms</h3>");
                alert("Error updating subscription");
              }
            });
        
      return false;
    }
   </script>
</head>

<body>

    <section id="main-content">
 <div class="container-fluid">
          <section class="wrapper">
            <div class="container-fluid"><br><br>
                  	      
						<div class="row">
						
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            WELCOME!
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                           
                        </ol>
                    </div>
                
                <!-- /.row -->

        <div class="col-lg-6 pull-left" >	

        <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bell"></i> Notifications
                          <button class="btn btn-inline" onclick="togglesettings()">
                            <i class="fa fw fa-gear"></i>
                            <small style="color:white">Subscription</small> 
                          </button>
                        </h3>
                    </div>
                    <div class="panel-body">
                      <form id="settings-form" action="" onsubmit="return updatesub()" style="display:none">
                         <div class="checkbox">
                              <label><input type="checkbox" name="sms" value="sms" id="smscheck" /> SMS </label>
                              &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                              <label><input type="checkbox" name="mail" value="mail" id="mailcheck" /> Email </label>
                              <input type="hidden" name="dummy" value="dummy" />
                              &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                              <input type="submit" value="Update subscription" class="btn btn-sm btn-theme03" />
                        </div>
                      </form>
                      <div id="alerts"></div>
                    </div>
                </div>

    <!-- Second Action -->
       <div>

                     
         <a class="btn btn-sm btn-theme03 pull-left" href="<?php
                if($_SESSION['sess_type']=='student' || $_SESSION['sess_type']=='admin')
                  echo "viewbysem.php";
                else
                  echo "viewbyteacher.php";
              ?>">View Timetable</a>
              
              &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <a class="btn btn-sm btn-theme03 pull-right" href="<?php
                if($_SESSION['sess_type']=='student')
                  echo "semTT/{$_SESSION['sess_sem']}sem_tt.xlsx";
                else
                  echo "downloadteach.php";
              ?>">Download Timetable</a>

            </div>


             </div>
          
						<div class="col-md-4  pull-right">


            <div class="panel panel-default">

						<div class="panel-heading">
             <h3 class="panel-title">
             <a href = "currentclass.php" style="color:darkblue">
              <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span> Ongoing classes
            </a>
            </h3>
            </div>
                      <!-- First Action -->
                      	<div class="panel-body">
							   <?php
                        if(!isset($time))
                        {
                            //get current time values
                            date_default_timezone_set('Asia/Kolkata');
                            $timestamp = time()-86400;
                            $date = strtotime("+1 day", $timestamp);
                            $day=date('D', $date);
							$day=strtoupper($day);
                            $time=date('H:i', $date);

                            //enable connection to database
                            include 'connect.php';
                            
							$semq='';
						if($_SESSION['sess_type']=='student')
							$semq=' and class.sem="'.$_SESSION['sess_sem'].'" ';
						
                            
                            $query="SELECT * from class left join  subject on class.s_initial= subject.s_initial WHERE CAST('$time' as time) between start_time and end_time and day='$day' $semq order by class.sem";
              							//echo $query;
                            $result=mysqli_query($con,$query);                        
                            if($result === FALSE) 
                            {
                                die(mysqli_error($con)); // TODO: better error handling
                            }
                    
                            else if(isset($result) and $result != FALSE)
                            {                       
                                $num_rows = $result->num_rows;
                                if($num_rows>0)
                                {
                                    ?>
                                    <div class="table-responsive">
                                    <table class="table table-hover">
                                    
                                    

                                    <?php
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        echo "<tr>";
										$end=date('g:i', strtotime($row['end_time']));
										echo "Sem: {$row['sem']} | <b>{$row['s_initial']}</b> | till $end <hR>";
										/*
                                        echo "<td align:'center'>" . $row['sem'] . "</td>";
                                        
                                        
                                        echo "<td valign=middle align=center>" . $end . "</td>";
                                        echo "<td align:center>" . $row['s_initial'] . "</td>";
										*/
										//echo "<td align:center>" . $row['name'] . "</td>";
                                        
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                else
                                    echo "No classes being held now!<br>";
                            }
                            else
                                echo "No classes being held now<br>";
                            mysqli_close($con);     
                        }//end of isset of time
                        
                    ?>  

							   
                      		</p>
                      	</div>

                      </div>
                     


                      </div></div></div>
            
			
<?php
 include "footer.php";

?>

  