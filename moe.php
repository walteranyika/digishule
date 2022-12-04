<?php
include 'connect.php';
extract($_POST)
if(isset($_POST['data']) and $data=="total_schools")
{
	$sql="SELECT county as item, count(id) as quantity FROM schools GROUP BY county ORDER BY quantity DESC";
	$results= mysqli_query($conn, $sql);
	$data=[];
	while($row=mysqli_fetch_assoc($results)){
		 $data[]=$row;
	}
	echo json_encode($data);
}
if(isset($_POST['data']) and $data=="total_students")
{
	$sql="SELECT schools.county , COUNT(students.id) AS quantity FROM schools JOIN students ON schools.school_reg=students.school_id WHERE students.year=$year GROUP BY schools.county ORDER BY quantity DESC";
	$results= mysqli_query($conn, $sql);
	$data=[];
	while($row=mysqli_fetch_assoc($results)){
		 $data[]=$row;
	}
	echo json_encode($data);
}

?>
