<?php
if(isset($_POST['teacher']))
{
$teacher=$_POST['teacher'];
/** Error reporting */
error_reporting(E_ALL);

/** Include path **/
ini_set('include_path', ini_get('include_path').';../Classes/');

/** PHPExcel */
include 'Classes/PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
include 'Classes/PHPExcel/Writer/Excel2007.php';

// Create new PHPExcel object
$inputFileType = 'Excel2007';
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load("PersonalTT/teacher.xlsx");

$newSheet = clone $objPHPExcel->getSheetByName("Sheet1");
$newSheet->setTitle($teacher);
$newSheetIndex = 0;
$objPHPExcel->addSheet($newSheet,$newSheetIndex);

// Set properties
$objPHPExcel->getProperties()->setCreator("Arnab");
$objPHPExcel->getProperties()->setLastModifiedBy("Arnab");
$objPHPExcel->getProperties()->setTitle("Timetable");
$objPHPExcel->getProperties()->setSubject("Timetable");
$objPHPExcel->getProperties()->setDescription("Timetable");

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');

//save file
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save("PersonalTT/".$teacher.'.xlsx');
header("Refresh:1,url=writer.php?teacher=".$teacher);
}
	include "include-must.php";
?>

	</head>
	<script>
	function checkAndSubmit()
	{
		if (document.getElementById('teacher').selectedIndex > 0)
		{
			document.getElementById('loginform').submit();
		}
	}
	</script>
	<body style="padding:10px">
	<br/><br/><br/><br/><br/>
<section class="section1">
	<div style="clear:both"></div>
	<p>Teacher timetable will be saved!</p>
		<form id="loginform" method="post" name="loginform" action="">
			<div class="form-group">
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-user"></i></span>
				<select name="teacher" id="teacher" onclick="checkAndSubmit()">
				<option value=0>Select</option>
				<?php
					include 'connect.php';
					$query="SELECT DISTINCT name from handles;";
					$result=mysqli_query($con,$query);
					
					while($row=mysqli_fetch_assoc($result))
					{
						echo "<option value=".$row['name'].">".$row['name']."</option>";
					}
				?>
				</select>
				</div>
			</div>
		</form>
</section>
</div>
