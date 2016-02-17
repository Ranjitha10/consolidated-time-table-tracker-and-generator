<?php
        //get data from forms
        $sem=$_GET['sem'];
        $start=$_GET['time'];
        $day=$_GET['day'];
        $subject=$_GET['sub'];
        
        
        //Ensure connection to database and report error if unsuccessful
        include 'connect.php';

        //Query to ensure if the time slot for that sem is possible
        $query="Select end_time from class WHERE sem='$sem' and start_time='$start' and day='$day';";
        $result=mysqli_query($con,$query);
        if($result === FALSE)
            echo "Unable to allocate suitable time slot!<br/>";
        
                  
        //Query to ensure that that sem has that subjecta s per syllabus
        $query1="select faculty_id from handles WHERE sem='$sem' and s_initial='$subject';";
        $result1=mysqli_query($con,$query1);
        if($result1 === FALSE)
            echo " Unable to allocate subject to that sem<br/>";

                    
        //query to ensure the teaccher for that subject
        $query2="select distinct first_name,last_name,email from faculty as f,handles as h where h.sem='$sem' and h.s_initial='$subject' and h.faculty_id=f.ID;";
        echo $query2;
        $result2=mysqli_query($con,$query2);
        if($result2 === FALSE)
            echo "No teacher found1!";

                    
        //enable suitable debuggin of results
        $num_rows = $result->num_rows;
        $num_rows1 = $result1->num_rows;
        $num_rows2= $result2->num_rows;

		//	echo  "<hr>".$query1."<hr>".$query2."<hr>".$query."<hr>";
		
        if($num_rows==0)
			echo "Unable to allocate suitable time slot!<br/>";
        else if($num_rows1==0)
			echo "Unable to allocate subject to that sem!<br/>";
        else if($num_rows2==0)
			echo "No teacher found!<br/>";
        else if(isset($result) and $result != FALSE and isset($result1) and $result1 != FALSE and isset($result2) and $result2 != FALSE)
        {
            $num_rows = $result->num_rows;
            if($num_rows>0)
            {
                $row=mysqli_fetch_assoc($result);
                $end_time=$row['end_time'];
                $query="Delete from class WHERE sem='$sem' and start_time='$start' and day='$day';";
                mysqli_query($con,$query);
                if($result === FALSE) 
                {
                    echo "No entries!<br/>";
                    exit();
                }
                else
                {
                    $query="INSERT into class(`start_time`, `end_time`, `day`, `s_initial`, `sem`) VALUES('$start','$end_time','$day','$subject','$sem');";
                    mysqli_query($con,$query);
                    if($result === FALSE) 
                    {
                        echo "Unable to upload to database but class slot is now free!<br/>";
                        exit();
                    }   
                    echo "Database Updated!<br/>";
					
					
					
					//remove seconds fromt time, remove leading zero
					preg_match("/([1-9][0-9]?:[\d]+):/",$start,$match);
					$start=$match[1];
					
					//update excel
					require_once 'Classes/PHPExcel/IOFactory.php';
					//require_once 'Classes/PHPExcel.php';
	
					//mappings to our excel format
					$mday = array('MON' => 6, 'TUE' => 7,'WED' => 8,'THU' => 9,'FRI' => 10,'SAT' => 11);
					//START TIME
					$mtime=array('9:00' => 'B','10:00' => 'C','11:30' => 'E','12:00' => 'E','12:30' => 'F','13:00' => 'F','14:15' => 'H','14:45' => 'H','15:15' => 'I','15:45' => 'I');

					$excel2 = PHPExcel_IOFactory::createReader('Excel2007');
					$excel2 = $excel2->load("semTT/{$sem}sem_tt.xlsx"); 
					$excel2->setActiveSheetIndex(0);
					$excel2->getActiveSheet()
						->setCellValue($mtime[$start].$mday[$day], $subject)
					;

					$objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
					$objWriter->save("semTT/{$sem}sem_tt.xlsx");
					
					
					
					//send mail
                    $num_rows = $result2->num_rows;
                    if($num_rows>0)
                    {
                        $row=mysqli_fetch_assoc($result2);
                        $FName=$row['first_name'];
                        $LName=$row['last_name'];
                        $Email=$row['email'];

                    }
                    /*
					echo "Dear ".$FName." ".$LName.",<br/>
                                            Please Note that you have been asked to take an extra class for:<br/>
                                                    Sem : $sem<br/>
                                                    Time : $start<br/>
                                                    Sub : $subject<br/>
                                                    Day : $day<br/>
                                                Kindly do the needful.<br/>
                                            Thank You.<br/><HR><BR>Mail sent.";
                    else
						echo "Unable to send mail<br/>!";
                        */
                        header('Refresh:1,url=alertsend.php?type=Timetable+Alteration&msg=The+timetable+has+been+altered+for:+'.
                               "Sem : $sem, Day : $day, Time : $start, Sub : $subject");
                }//Mail sending code
            }
        }
        else
            echo "Error!<br/>";
        mysqli_close($con);
       // header('Refresh:5,url=edit.php');
    
?>