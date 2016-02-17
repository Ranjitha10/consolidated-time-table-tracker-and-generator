<?php
/** Error reporting */
error_reporting(E_ALL);

/** Include path **/
ini_set('include_path', ini_get('include_path').';../Classes/');

/** PHPExcel */
include 'Classes/PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'Classes/PHPExcel/Writer/Excel2007.php';

//mappings
$mday = array('MON' => 6, 'TUE' => 7,'WED' => 8,'THU' => 9,'FRI' => 10,'SAT' => 11);
					//START TIME
$mtime=array('9:00' => 'B','10:00' => 'C','11:30' => 'E','12:00' => 'E','12:30' => 'F','13:00' => 'F','14:15' => 'H','14:45' => 'H','15:15' => 'I','15:45' => 'I');

include 'connect.php';

//get data from form
$teacher=$_GET['teacher'];

//query from database and show error
$teacher="%".$teacher."%";
$query="SELECT * from class where s_initial IN (select s_initial from handles where faculty_id like '$teacher')";
$result=mysqli_query($con,$query);
if($result === FALSE) 
{
	die(mysqli_error($con)); // TODO: better error handling
}

//get details out of database
else if(isset($result) and $result != FALSE)
{						
	$num_rows = $result->num_rows;
	if($num_rows>0)
	{
		//start writing
	
		$inputFileType = 'Excel2007';
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load("time_table_template/teacher.xlsx");
/*
        //Set a new sheet with suitable name
        $newSheet = clone $objPHPExcel->getSheetByName("Sheet1");
		$newSheet->setTitle($teacher);
        $objPHPExcel->addSheet($newSheet,0);
*/
        // Set properties
        $objPHPExcel->getProperties()->setCreator("Arnab and Garima");
        $objPHPExcel->getProperties()->setLastModifiedBy("Automatic code");
        $objPHPExcel->getProperties()->setTitle("Timetable tracker");
        $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
        $objPHPExcel->getProperties()->setDescription("My personal time table.");
		
		$objPHPExcel->setActiveSheetIndex(0);
		
		
		while($row = mysqli_fetch_assoc($result))
		{
			//var_dump($row);
			$start_time=date('G:i', strtotime($row['start_time']));
			//echo  $start_time."::".$row['start_time'];
			$end_time=date('G:i', strtotime($row['end_time']));
			$subject=$row['s_initial'];
			$day=$row['day'];
			$sem=$row['sem'];
			write_to_file($start_time,$end_time,$day,$subject,$sem); 
		}//end while
		
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$teacher=$_GET['teacher'];
		$fname="PersonalTT/".$teacher.".xlsx";
		$objWriter->save($fname);
	
	}//end num_rows >0 condition
}//end set of result

//function to write to Excel file and sheet
function write_to_file($start,$end,$day,$matter,$sem)
{
	global $objPHPExcel,$mday,$mtime;
	/*
	$teacher=$_GET['teacher'];
	$fname="PersonalTT/".$teacher.".xlsx";
	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	$objPHPExcel = $objReader->load($fname);
	$objPHPExcel->setActiveSheetIndex(0);
	*/
	$subject=$matter."(".$sem.")";

	$cell=$mtime[$start].$mday[$day];
	
	//get matches for labs and merge cells accordingly
	if(preg_match("/[\(]/",$matter))
	{
		$cols=$cell;
		$col=chr(ord($mtime[$start])+1);
		$cole=$col.$mday[$day];
		$limit=$cols.":".$cole;
		$objPHPExcel->getActiveSheet()->mergeCells($limit);
	}
	$objPHPExcel->getActiveSheet()->SetCellValue($cell,$subject);
	
}
header("Location:PersonalTT/{$_GET['teacher']}.xlsx");
?>
<script>
	 window.setTimeout(function(){
        window.location.href = "viewbyteacher.php";
    }, 3000);
	alert("Your personalised timetable has been created!");
</script>

