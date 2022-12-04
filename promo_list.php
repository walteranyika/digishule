<?php
include 'connect.php';
header("Content-type:application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['info'])) {

	$info=$_POST['info'];
	$className=$_POST['currentClass'];
	$year=$_POST['year'];
	$school_reg=$_POST['school_id'];

	$sql ="";

    $results = mysqli_query($conn, $sql)or die(mysqli_error($conn));

    $data=[];

    while ($row = mysqli_fetch_assoc($results)) {
    	 $data[]=$row;
    }

    echo  json_encode($data);
}else{
	echo json_encode("No Data found");
}