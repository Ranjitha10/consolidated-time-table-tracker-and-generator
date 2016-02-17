<?php   ob_start();
    session_start();
    if(!isset($_SESSION['sess_username']))
    {
		header('Location:login.php');
		exit;
	}

include "navigation.php"; ?>
<html lang="en">
<head>
    <title>Consolidated time table</title>
    <style type="text/css">
    .btn-inline{
	    float: right;
	    top: -8px;
	    position: relative;

    }
    </style>
</head>

<body>
    <section id="main-content">

          <section class="wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Consolidated time table 
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Consolidated
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Consolidated time table 
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Consolidated time table for the current academic year
                        &nbsp; &nbsp; &nbsp; &nbsp; <a href="semTT//cons.xlsx" class="btn btn-theme03 btn-inline">Download Now</a> 
                        </h3>

                    </div>
                    <div class="panel-body">
  <?php
                    
                        //connect to database
                        include 'connect.php';
                        
						$lab="";
						if(isset($_GET['lab']))
							$lab=" where class.s_initial like '%lab%'";
						
						
                        $query="select start_time,end_time,day,class.s_initial,class.sem,GROUP_CONCAT(handles.faculty_id SEPARATOR ', ') as teach from class left join handles on class.s_initial=handles.s_initial  and class.sem=handles.sem $lab group by class.sem,start_time,end_time,day,class.s_initial ORDER BY FIELD(day,'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'), cast(start_time as time) ASC, class.sem ASC, class.s_initial DESC";
                        
						
						//echo $query;
                        $result=mysqli_query($con,$query);
                        
                        if($result === FALSE) 
                            die(mysqli_error($con)); 
                        
                        
                        else if(isset($result) and $result != FALSE)
                        {
							//start excel thing
							
					require_once 'Classes/PHPExcel/IOFactory.php';
	
					//mappings to our excel format
					$mday = array('MON' => 6, 'TUE' => 12,'WED' => 18,'THU' => 24,'FRI' => 30,'SAT' => 36);
					//START TIME
					$mtime=array('9:00' => 'C','10:00' => 'D','11:30' => 'F','12:00' => 'F','12:30' => 'G','13:00' => 'G','14:15' => 'I','14:45' => 'I','15:15' => 'J','15:45' => 'J');
					$msem='B';
					//sem row select
					$msemoffset=array('1' => 0,'2' => 0,'3' => 1,'4' => 1,'5' => 2,'6' => 2,'7' => 3,'8' => 3, 'IT-1' => 4,'IT-2' => 4,'SE-1' => 5,'SE-2' => 5);

					$excel2 = PHPExcel_IOFactory::createReader('Excel2007');
					$excel2 = $excel2->load("time_table_template/cons.xlsx"); 
					$excel2->setActiveSheetIndex(0);
					
					
					
					
					
					
							
					$num_rows = $result->num_rows;
					if($num_rows>0)
					{
					while($row = mysqli_fetch_assoc($result))
					{
						// var_dump($row);
						 
						preg_match("/([1-9][0-9]?:[\d]+):/",$row['start_time'],$match);
						$start=$match[1];
						$day=$row['day'];
						$sub=$row['s_initial'];
						$sem=$row['sem'];
						//echo $msem.($mday[$day]+$msemoffset[$sem])." | ".$mtime[$start].($mday[$day]+$msemoffset[$sem]);
						 
						 $coords=$msem.($mday[$day]+$msemoffset[$sem]);
						// var_dump($excel2->getActiveSheet()->getCell($coords)->getValue());
						 //check if sem entered
						 if(!$excel2->getActiveSheet()->getCell($coords)->getValue())
							$excel2->getActiveSheet()->setCellValue($coords, $sem);
						
						//check if sub entered
						$coords=$mtime[$start].($mday[$day]+$msemoffset[$sem]);
						
						$teachers=($row['teach']!=null && $row['teach']!='OT')?' ('.$row['teach'].')':' ';
						
						if($esub=$excel2->getActiveSheet()->getCell($coords)->getValue())
							$excel2->getActiveSheet()->setCellValue($coords,$sub.$teachers.' / '. $esub);
						else
							$excel2->getActiveSheet()->setCellValue($coords,$sub.$teachers);
						//merge labs cells
						$duration=$row['end_time']-$row['start_time'];
						if($duration>=2)
							$excel2->getActiveSheet()->mergeCells($coords.':'.(chr(ord($mtime[$start])+1)).($mday[$day]+$msemoffset[$sem]));
						//$excel2->setCellValue($mtime[$start].($mday[$day]+$msemoffset[$sem]), $sub);
						
					   /*
					   echo "<tr>";
						echo "<td valign=middle align=center>" . $row['sem'] . "</td>";
						$start=date('g:i', strtotime($row['start_time']));
						echo "<td valign=middle align=center>" . $start. "</td>";
						$end=date('g:i', strtotime($row['end_time']));
						echo "<td valign=middle align=center>" . $end. "</td>";
						echo "<td valign=middle align=center>" . $row['s_initial'] . "</td>";
						echo "<td valign=middle align=center>" . $row['day'] . "</td>";
						echo "</tr>";
						*/
					}
					
				}
				
			}
			
			//remove empty rows
			/*
			for($i=$mday['MON'];$i<$mday['SAT']+6;$i++){
				if(!$excel2->getActiveSheet()->getCell('B'.$i)->getValue()){
					$excel2->getActiveSheet()->removeRow($i,1);
					echo "removed $i ";
				}
			}
		   */
			//save in xlsx for download
			$objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
			$objWriter->save('semTT//cons.xlsx');
			
			//save in html for view
			$writer = PHPExcel_IOFactory::createWriter($excel2, 'HTML');
			$writer->setUseInlineCSS(true);
			$writer->save("tmp/cons.html");
			
			include "tmp/cons.html";
			unlink("tmp/cons.html");
?>
	<script>
     //rvce logo
		el=document.querySelector('#sheet0 img');
		el.src='assets/img/rvce-logo.jpg';
		el.style.position='relative';
		el.style.top='-10px';
	
	
</script>
<?php
 include "footer.php";

?>
