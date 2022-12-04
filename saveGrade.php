<?php
header("Content-type:application/json");

if (isset($_POST['grades'])) 
{
  include 'connect.php';
  extract($_POST);
  $grades_array =json_decode($grades);
  mysqli_query($conn,"delete from grades where school_id='$school_id'");

  foreach ($grades_array as $grade) {
      $gradeR=$grade->grade;
      $lower=$grade->lower;
      $upper=$grade->upper;
      $sql= "INSERT INTO `grades`(`school_id`, `grade`, `lower`, `upper`) VALUES ('$school_id','$gradeR',$lower,$upper)";
      mysqli_query($conn, $sql) or die(mysqli_error($conn));
  //    echo $sql;
  }
  echo json_encode(array('result' =>'Grades Added Successfully'));
}
else {
	echo json_encode(array('result' =>'Could Not Process The Grades'));
}
?>
