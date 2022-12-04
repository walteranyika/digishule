<?php
include 'connect.php';
if (isset($_POST["adm"])) 
{
	    extract($_POST);//$adm,$term
	    $year=date("Y");
	    $sql_check="select * from exams where exam_name='$exam' AND std_regno='$adm' AND subject='$subject' AND term='$term' AND year='$year'";
	    $result=mysqli_query($conn,  $sql_check);
	    if(mysqli_num_rows($result)>0){
	    	//update
	    	$sql_update = "update exams set score=$score where exam_name='$exam' AND std_regno='$adm' AND subject='$subject' AND term='$term' AND year='$year'";
	    	$result=mysqli_query($conn,$sql_update);

	    }else{

	    	 $sql_insert="INSERT INTO `exams`(`exam_name`, `std_regno`, `subject`, `score`, `term`, `year`) VALUES 
	                             ('$exam','$adm','$subject','$score','$term','$year')";
		     //add the 3 variables
		     $result=mysqli_query($conn,$sql_insert);

	    }
	
	   
		//check true/false query execution
		if($result)
		{
		  echo "1";//1 for succes
		}
		else {
		  echo "0";//0 for fail
		} 
}
?>