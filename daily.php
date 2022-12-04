<?php

include 'connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['school_reg']))
 {
    extract($_POST);
    $sql_present="SELECT count(id) FROM attendance where present=1 and studentId='$student_id' and date_taken LIKE '$date%'";
    $sql_absent="SELECT count(id) FROM attendance where present=0 and studentId='$student_id' and date_taken LIKE '$date%'";
    $sql_names="SELECT `names` FROM `students` WHERE `stdreg_no`='$student_id'";
    $sql_subjects="SELECT subject FROM attendance where present=0 and studentId='$student_id' and date_taken LIKE '$date%'";
    
    $result3= mysqli_query($conn, $sql_names)or die(mysqli_error($conn));
    $res3 = mysqli_fetch_row($result3);
    if (mysqli_num_rows($result3)>0)
    {
   
		    $names=$res3[0];
		    $result1= mysqli_query($conn, $sql_present)or die(mysqli_error($conn));
		    $res1 = mysqli_fetch_row($result1);
		    $present = $res1[0];

		    $result2= mysqli_query($conn, $sql_absent)or die(mysqli_error($conn));
		    $res2 = mysqli_fetch_row($result2);
		    $absent = $res2[0];



		    $result4= mysqli_query($conn, $sql_subjects)or die(mysqli_error($conn));
		    $subjects='';
		    while ($row=mysqli_fetch_row($result4)) {
		    	$subjects.=$row[0].' ';
		    }

		    echo json_encode(array('names' =>$names ,'present' =>$present ,'absent' =>$absent , 'subjects'=>$subjects));
      }
      else{
      	echo "No records found";
      }
}else
{
	echo "Could not find any data";
}
