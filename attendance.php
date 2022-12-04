<?php
include 'connect.php';
header("Content-type:application/json");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['info'])) {

	$info=$_POST['info'];
	$className=$_POST['class'];
	$subject=$_POST['subject'];
	$school_reg=$_POST['school_reg'];
	//$className,$subject,$school_reg
	$array = json_decode($info, true);
	foreach ($array as $key => $value) {
       $present =$value["present"];
       $studentId=$value["studentId"];
       $status = $present==true ? 1 : 0;
       $sql="INSERT INTO `attendance`(`school_reg`, `subject`, `className`, `studentId`, `present`)
                             VALUES ('$school_reg','$subject','$className','$studentId',$status)";
       mysqli_query($conn, $sql)or die(mysqli_error($conn));
	}

}else{
	echo "Could not find any data";
}