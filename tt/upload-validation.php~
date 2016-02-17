<?php
ob_start(); session_start();

	$fname=$_FILES['file']['name'];
	if(!isset($fname))
	{
		echo "File not able to upload!Please try again!";
	}
	else if ($_FILES["file"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
	} 
	else 
	{
		include 'Classes/PHPExcel/IOFactory.php';
		include 'connect.php';
		
		function insert_into_class($start_time,$end_time,$day,$sub,$room=null)
		{
			global $roomno,$sem,$con;
			//dont insert self study,counselling, library into subject
			if(preg_match("/(?i)(self|couns|library)/",$sub))
				return;
			
			if($room==null)
				$room=$roomno; //if null, assign main room no

			//trim all
			$start_time=trim($start_time);
			$end_time=trim($end_time);
			$day=trim($day);
			$sub=trim($sub);
			$room=trim($room);
			
			$hr = substr ($start_time , 0, strpos($start_time,":"));
			if($hr<8){
				$hr+=12;
				$start_time= preg_replace("/^[0-9]+/", $hr, $start_time);
			}
			
			$hr = substr ($end_time , 0, strpos($end_time,":"));
			if($hr<8){
				$hr = substr ($end_time , 0, strpos($end_time,":"));
				$hr+=12;
				$end_time= preg_replace("/^[0-9]+/", $hr, $end_time);
			}
			
			echo $start_time." | ".$end_time." | ".$day." | ".$sub." | ".$sem." | ".$room.'<BR>';

			/*
			//chk if sub exists in subject table
			$query="select s_initial from subject where s_initial='$sub' and sem='$sem'";
			$res=mysqli_query($con,$query);
			
			if( !$res->num_rows){
				$query="insert into subject s_initial from subject where s_initial='$sub' and sem='$sem'";
				$res=mysqli_query($con,$query);
			}		
			*/
			$query="INSERT into class(start_time,end_time,day,s_initial,sem,room_no) VALUES('$start_time','$end_time','$day','$sub','$sem','$room');";
			///echo "*".$query;
			mysqli_query($con,$query);
			///echo "<font color=green>(".mysqli_error($con).")</font>";
		}
		
		function get_multiple_values($cell_value,$hasLab,$isMergedCell)//haslab, this is lab
		{
			global $sem,$sheet1,$con;
			///echo "[$cell_value,$hasLab,$isMergedCell] ";
			
			preg_match("/[0-9]+/",$cell_value,$row);//split aaccording to rows
			preg_match("/[A-Z]+/",$cell_value,$col);//split aaccording to columns

			if($hasLab==true and $isMergedCell==true) //this is lab
			{
				$cols=$col[0]."5";
				$start=$sheet1->getCell($cols)->getValue();
				$cols=chr(ord($col[0])+1).'5';
				if($cols=='J5')
					$cols='I5';
				//echo '<'.$cols.'>';
				$end=$sheet1->getCell($cols)->getValue();
				//echo "<hr>{$cols}<HR>";
			}
			//for the hours after the lab which starts half an hour late

			else if($hasLab==true and $isMergedCell==false)//had a lab but this is not lab
			{
				/*
				$cols=$col[0]."5";
				$start=$sheet1->getCell($cols)->getValue();
				$temp=$col[0];
				if($temp!='B')
					$cols=++$temp."5";
				else
					$cols="D5";
				echo "----------";
				$end=$sheet1->getCell($cols)->getValue();
				*/
				$cols=$col[0]."5";
				$start=$sheet1->getCell($cols)->getValue();
				$cols=$col[0]."5";
				$end=$sheet1->getCell($cols)->getValue();
			}
			//for the labs itself

			else if($hasLab==false and $isMergedCell==true) //this is a 2 hr theory period
			{
				$cols=$col[0]."4";
				$start=$sheet1->getCell($cols)->getValue();
				$cols=chr(ord($col[0])+1).'4';
				if($cols=='J4')
					$cols='I4';
				//echo '<'.$cols.'>';
				$end=$sheet1->getCell($cols)->getValue();
				
			}
			else if ($hasLab==false and $isMergedCell==false) //normal class
			{
				$cols=$col[0]."4";
				$start=$sheet1->getCell($cols)->getValue();
				$cols=$col[0]."4";
				$end=$sheet1->getCell($cols)->getValue();
				
			}
			//for remaining non-lab hours

			$cols="A".$row[0];//direct to cell which has day value stored
			$start_time=preg_split("/-/",$start);//in the cell value get start time
			$end_time=preg_split("/-/",$end);//in the cell value get end value
	
			$Subject=$sheet1->getCell($cell_value)->getValue();

			$Day=$sheet1->getCell($cols)->getValue();//get day value

			if($Subject!=NULL)
			{
				
				if(preg_match("/[\/]/",$Subject))  //elective
				{
					$subandclass=preg_split("/\(/",$Subject);
					
					$slist=preg_split("/[\/]/",$subandclass[0]);

					if(	count($subandclass)==2){ //elective classrooms are there
						$subandclass[1]=rtrim($subandclass[1], ")"); //remove closing bracket
						$clist=preg_split("/[\/]/",$subandclass[1]);
						for($i=0; $i<count($clist) ; $i++)
							insert_into_class($start_time[0],$end_time[1],$Day,$slist[$i],$clist[$i]);
					} else
					foreach($slist as $sub)
						insert_into_class($start_time[0],$end_time[1],$Day,$sub);
					
				}
				else if(preg_match("/(?i)lab/",$Subject))//indicates presence of lab Ex:SPT(B3,B4)&WP(B1,B2)
				//no its a fucking comma. ES&B isnt a lab
				{
					$labs=preg_split("/,/",$Subject);
					$prevsub="";
					foreach($labs as $lab){
						if(preg_match("/([a-zA-Z&]+).(?i)lab/",$lab,$sub))
							$prevsub= $sub[1];
						
						preg_match("/([a-zA-Z][0-9])/",$lab,$batch);
						//echo $batch[1];
							// \(([a-zA-Z]+)\)\(([a-zA-Z0-9]+)\)
						preg_match("/\(([a-zA-Z\+]+)\)/",$lab,$teachers);
						if(isset($teachers[1]))
							$teachers=preg_split("/[+]/",$teachers[1]);
						
						preg_match("/\)[ ]*\(([a-zA-Z0-9 ]+)\)/",$lab,$labno);
						//no batch for pg students
						if($batch)
							$subname=$prevsub." LAB (".$batch[1].")";
						else
							$subname=$prevsub." LAB";
						
						
						//get the core sub name if exists
						$query="select name from subject where s_initial='$prevsub' and sem='$sem' limit 1";
						$res=mysqli_query($con,$query);
						$row=mysqli_fetch_assoc($res);
						
						if($row){
							$subfullname=$subname;
						}
						else
							$subfullname=$prevsub." LAB";
						
						$query="INSERT INTO subject(name, s_initial, sem, type) values( '$subfullname','$subname','$sem','lab')";
						$res=mysqli_query($con,$query);
							
						//let it fail, it means subject is already present
						if(!isset($labno[1]))
							$labno[1]='';
						insert_into_class($start_time[0],$end_time[1],$Day,$subname,$labno[1]);
						
						//check for facult only if subject is non blank
						foreach($teachers as $tea){
							$query="INSERT INTO handles(faculty_id, s_initial, sem) VALUES('$tea','$subname','$sem')";
							mysqli_query($con,$query);
						}
					}

					/*
					$temp=preg_split("/[\,]/",$Subject);//split according to lab Ex:SPT(B3,B4) as one entry and WP(B1,B2) as another
					foreach($temp as $base)
					{
						$list=preg_split("/[\(\,\)]/",$base);//match brackets and get lab subjects and batches added to db
						$subject=$list[0];
						$batch=$list[1];
						$batch1=$list[2];
						$Subject=$subject."(".$batch.")";
						insert_into_class($start_time[0],$end_time[1],$Day,$Subject);
						
						$Subject=$subject."(".$batch1.")";
						insert_into_class($start_time[0],$end_time[1],$Day,$Subject);	
					} 
					*/
				}
				else
				{
					echo "<hr>";
					insert_into_class($start_time[0],$end_time[1],$Day,$Subject);	
				}
			}//end of if subject!=NULL
		}//end of function to upload subjects and time to db

		function handling_teachers(){
			global $sheet1,$sem,$con;
			$idx=array("B","D","F","H");
			
			for ($i = 0; $i < 3; $i++) {
				foreach($idx as $col)
				{
					
					$sub = $sheet1->getCell($col.(14+$i))->getValue();

					$sub=preg_split("/-/",$sub);
					/// print_r($sub);
					
					if(strstr($sub[0],"Global Elective")){
						$sub[1]=$sub[0]. " ".$sub[1];
					}

					//next col=teacher name
					$tea = $sheet1->getCell(chr(ord($col)+1).(14+$i))->getValue();
					$tea=preg_split("/-/",$tea);
					/// print_r($tea);
					
					if(count($sub)==2){//sub is non blank
						
						$sub[0]=trim($sub[0]);
						$sub[1]=trim($sub[1]);
						$type= (  preg_match("/lab/i",$sub[1])? "lab" : "theory");
						echo "<font color=blue>$sub[0] - $sub[1]</font> <br>";
						$query="INSERT INTO subject(name, s_initial, sem, type) VALUES('$sub[1]','$sub[0]','$sem','$type')";
						mysqli_query($con,$query);
						//let it fail, it means subject is already present
						
						//check for faculty only if subject is non blank
						if(count($tea)==2){
							$tea[0]=trim($tea[0]);
							//remove Dr. Pr. and other stuff
							$tea[0]=preg_split("/ /",$tea[0]);
							$tea[0]= $tea[0][count($tea[0])-1];
							$tea[1]=trim($tea[1]);
							
							echo "$tea[0] - $tea[1] <br>";

							if(empty($tea[0]) || strstr($tea[0],'Dept'))
								$tea[0]="OT";
							
							$query="INSERT INTO handles(`faculty_id`, `s_initial`, `sem`) VALUES('$tea[0]','$sub[0]','$sem');";
							///echo "#".$query;
							mysqli_query($con,$query);
							///echo "<font color=green>(".mysqli_error($con).")</font>";
						} else {
							//no faculty assigned
							$query="INSERT INTO handles(`faculty_id`, `s_initial`, `sem`) VALUES('OT','$sub[0]','$sem');";
							///echo "##".$query;
							mysqli_query($con,$query);
							/// echo "<font color=green>(".mysqli_error($con).")</font>";
						}
					}
				}
			}
		}


		$inputFileType = 'Excel2007';
		$fname=$_FILES['file']['name'];
		///// print_r($_FILES);
		$ext = pathinfo($fname, PATHINFO_EXTENSION);
		//$temp=$sem."sem_tt".".".$ext;
		$hasLab=false;
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($_FILES['file']['tmp_name']);//"semTT/".$temp);
		$sheet1=$objPHPExcel->setActiveSheetIndex(0);
		$cols=array("B","C","E","F","H","I");
		$num=array("6","7","8","9","10","11",);
		$isMergedCell=false;
		
		//get sem
		$sem=$sheet1->getCell("A2");
		$sem= preg_replace('/\D+/', '', $sem);
		//get default classroom 
		$roomno=explode(":",$sheet1->getCell("I2"))[1];
		
		$degree=trim(explode(":",$sheet1->getCell("C2"))[1]);
		if($degree!='UG' && $degree!='ISE'){ //PG 
			preg_match("/\(([a-zA-Z-]+)\)/",$sheet1->getCell("A2"),$pgcourse) ;
			$sem=$pgcourse[1].'-'.$sem;
		}
		
		handling_teachers();
		
		for($j=0;$j<6;$j++)
		{
			$hasLab=false;
			for($i=0;$i<6;$i++)
			{
				if($isMergedCell==true)
				{
					$isMergedCell=false;
					if($i<5)
						$i++;
					else 
						continue;
				}
				

				$cellmax=$cols[$i]."".$num[$j];
				foreach($sheet1->getMergeCells() as $range) 
				{
					if ($sheet1->getCell($cellmax)->isInRange($range)) 
					{
						$Subject=$sheet1->getCell($cellmax)->getValue();
						if(preg_match("/(?i)lab/",$Subject))
							$hasLab=true;
						$isMergedCell=true;
						break;
					}
					else
						$isMergedCell=false;
				}
				get_multiple_values($cellmax,$hasLab,$isMergedCell);

			}
		}
		
		//insert into database
		$query="select c1.sem,c1.s_initial,c1.start_time,c1.end_time,c1.day,c2.start_time as start,c2.end_time as end from class as c1,class as c2 where c1.sem=c2.sem and c1.s_initial=c2.s_initial and c1.start_time=c2.end_time and c1.day=c2.day;";
		$result1=mysqli_query($con,$query);
		if($result1 === FALSE){
		///echo "<font color=green>(".mysqli_error($con).")</font>";
		}
	//combine values in case of seperate hours placed next to each other		
	if(isset($result1) and $result1 != FALSE)
	{	
		$num_rows = $result1->num_rows;
		if($num_rows>0)
		{
			while($row=mysqli_fetch_assoc($result1))
			{
				$sem=$row['sem'];
				$sub=$row['s_initial'];
				$old_beg=$row['start_time'];
				$new_end=$row['end_time'];
				$day=$row['day'];
				$new_beg=$row['start'];
				$old_end=$row['end'];
			$query1="delete from class where sem='$sem' and s_initial='$sub' and start_time='$old_beg' and end_time='$new_end' and day='$day';";
				$result2=mysqli_query($con,$query1);
			$query1="delete from class where sem='$sem' and s_initial='$sub' and start_time='$new_beg' and end_time='$old_end' and day='$day';";
				$result2=mysqli_query($con,$query1);
			$query1="insert into class(`start_time`, `end_time`, `day`, `s_initial`, `sem`, `room_no`) values('$new_beg','$new_end','$day','$sub','$sem','$roomno');";
				$result2=mysqli_query($con,$query1);
			}
		}
	}
	
	
	
	
		//save and rename files to a new folder 
		$ext = pathinfo($fname, PATHINFO_EXTENSION);
		$temp=$sem."sem_tt".".".$ext;
		$mov=move_uploaded_file($_FILES['file']['tmp_name'],"semTT/$temp");
		
	
	}
	echo "Updating database...Please wait.";
	header('Refresh:1,url=upload.php?sem='.$sem);
?> 
