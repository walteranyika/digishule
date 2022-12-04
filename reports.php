<?php
include 'connect.php';
header("Content-type:application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

//top_ten($conn,"ABC126","1");
if (isset($_POST["top_ten"])) {
	extract($_POST);
	$year = isset($year) ? $year : date("Y");
	top_ten($conn, $school_id, $class,$exam_name, $term, $year);
}
else if (isset($_POST["bottom_ten"])) {
	extract($_POST);
	$year = isset($year) ? $year : date("Y");
	bottom_ten($conn, $school_id, $class,$exam_name, $year);
}
else if (isset($_POST["all_students"])) {
	extract($_POST);
	$year = isset($year) ? $year : date("Y");
	all_students($conn, $school_id, $class,$exam_name, $year);
}
else if (isset($_POST["totals_per_class"])) {
	extract($_POST);
	$year = isset($year) ? $year : date("Y");
	total_per_stream($conn, $school_id, $year);
}
else if (isset($_POST["totals_per_stream"])) {
	extract($_POST);
	$year = isset($year) ? $year : date("Y");
	total_per_class($conn, $school_id, $year);
}

else if (isset($_POST["total_for_school"])) {
	extract($_POST);
	$year = isset($year) ? $year : date("Y");
	total_for_school($conn, $school_id, $year);
}
else if (isset($_POST["total_all_schools"])) {
	extract($_POST);
	$year = isset($year) ? $year : date("Y");
	total_all_schools($conn, $year);
}
else if (isset($_POST["stream_mean_score"])) {
	extract($_POST);
	$year = isset($year) ? $year : date("Y");
	stream_mean_score($conn,$school_id,$exam_name, $year);
}
else if (isset($_POST["class_mean_score"])) {
	extract($_POST);
	$year = isset($year) ? $year : date("Y");
	class_mean_score($conn,$school_id,$exam_name,$term, $year);
}
else{
	echo json_encode(array("error"=>"No values received"));
}

/*Gson gson = new Gson();

    NavItem[] navigationArray = gson.fromJson(jsonString, NavItem[].class);*/


function top_ten($conn, $school_id, $class, $exam_name, $term, $year)
{
	$sql="SELECT students.names, students.stdreg_no,students.class as classy, exams.exam_name, exams.term,
	SUM(exams.score) as total FROM exams JOIN students ON exams.std_regno=students.stdreg_no 
	WHERE students.school_id='$school_id' and students.class LIKE '$class%' AND  exams.exam_name='$exam_name' and exams.term='$term' 
	 AND exams.year=$year GROUP BY exams.exam_name, 
	exams.std_regno, exams.term   ORDER BY total DESC LIMIT 10";
       // echo $sql;
       // die();
	$result=mysqli_query($conn, $sql)or die(mysqli_error($conn));
	$data= array();
	while ($row=mysqli_fetch_assoc($result)) 
	{
		$data[]=$row;
	}
	echo json_encode($data);
}

function bottom_ten($conn, $school_id, $class,$exam_name, $year)
{
	$sql="SELECT students.names, students.stdreg_no,students.class as classy, exams.exam_name, exams.term,
	SUM(exams.score) as total FROM exams JOIN students ON exams.std_regno=students.stdreg_no 
	WHERE students.school_id='$school_id' AND  exams.exam_name='$exam_name'  and students.class LIKE '$class%' 
    AND exams.year=$year
	GROUP BY exams.exam_name, 
	exams.std_regno, exams.term   ORDER BY total LIMIT 10";
  //       echo $sql;
//die();
	$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
	$data= array();
	while ($row=mysqli_fetch_assoc($result)) 
	{
		$data[]=$row;
	}
	echo json_encode($data);
}

function all_students($conn, $school_id, $class,$exam_name, $year)
{
	$sql="SELECT students.names, students.stdreg_no,students.class as classy, exams.exam_name, exams.term,
	SUM(exams.score) as total FROM exams JOIN students ON exams.std_regno=students.stdreg_no 
	WHERE students.school_id='$school_id'  AND  exams.exam_name='$exam_name' and   students.class LIKE '$class%'  AND exams.year=$year  GROUP BY exams.exam_name, 
	exams.std_regno, exams.term   ORDER BY total";

	$result=mysqli_query($conn, $sql);
	$data= array();
	while ($row=mysqli_fetch_assoc($result)) 
	{
		$data[]=$row;
	}
	echo json_encode($data);
}


function total_per_stream($conn, $school_id, $year)
{
	$sql="SELECT class as classy, COUNT(names) as total FROM students WHERE school_id='$school_id' AND students.year=$year GROUP by class";
	$result=mysqli_query($conn, $sql);
	$data= array();
	while ($row=mysqli_fetch_assoc($result)) 
	{
		$data[]=$row;
	}
	echo json_encode($data);
}



function total_per_class($conn, $school_id, $year)
{
	$sql="SELECT classy, COUNT(names) as total FROM students WHERE school_id='$school_id'  AND students.year=$year GROUP by classy";
	$result=mysqli_query($conn, $sql);
	$data= array();
	while ($row=mysqli_fetch_assoc($result)) 
	{
		$data[]=$row;
	}
	echo json_encode($data);
}

function total_for_school($conn, $school_id, $year)
{
	$sql="SELECT  COUNT(names) as total FROM students WHERE school_id='$school_id' AND students.year=$year";
	$result=mysqli_query($conn, $sql);
	$data= array();
	$row=mysqli_fetch_assoc($result);
	echo json_encode($row);
}

function total_all_schools($conn, $year)
{
	$sql="SELECT schools.school_reg, schools.school_name, COUNT(students.names) as total FROM students JOIN schools ON schools.school_reg=students.school_id WHERE  students.year=$year GROUP BY schools.school_reg";
	$result=mysqli_query($conn, $sql);
	$data= array();
	while ($row=mysqli_fetch_assoc($result)) 
	{
		$data[]=$row;
	}
	echo json_encode($data);
}

function class_mean_score($conn, $school_id,$exam_name,$term, $year)
{
	$sql="SELECT students.classy, (SUM(exams.score)/COUNT(names)) as total FROM exams JOIN students ON exams.std_regno=students.stdreg_no WHERE students.school_id='$school_id' AND  exams.exam_name='$exam_name' and exams.term='$term' AND exams.year=$year  GROUP BY students.classy";
	$result=mysqli_query($conn, $sql);
//	file_put_contents("class.txt", $sql."\n", FILE_APPEND);
	$data= array();
	while ($row=mysqli_fetch_assoc($result)) 
	{
		$data[]=$row;
	}
	echo json_encode($data);
}

function stream_mean_score($conn, $school_id,$exam_name, $year)
{
	$sql="SELECT students.class as classy, (SUM(exams.score)/COUNT(names)) as total FROM exams JOIN students ON exams.std_regno=students.stdreg_no WHERE students.school_id='$school_id' AND  exams.exam_name='$exam_name' AND exams.year=$year  GROUP BY students.class";
	$result=mysqli_query($conn, $sql);
//	file_put_contents("stream.txt", $sql."\n", FILE_APPEND);
	$data= array();
	while ($row=mysqli_fetch_assoc($result)) 
	{
		$data[]=$row;
	}
	echo json_encode($data);
}


?>
