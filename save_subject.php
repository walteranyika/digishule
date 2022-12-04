<?php
//echo  "Inner";
include 'connect.php';
//var_dump($
if (true) 
{
	    extract($_POST);//$adm,$ter
	    $sql_check="select * from subjects where school_reg='$school_reg' AND subject_name='$subject'";
	    $result=mysqli_query($conn,  $sql_check);
	    if(mysqli_num_rows($result)>0)
	    {
	        echo json_encode(['status'=>'Subject exists']);	//do nothing
	    }
	    else
	    {

	    	 $sql_insert="INSERT INTO `subjects`(`id`, `school_reg`, `subject_name`) VALUES (null,'$school_reg','$subject')";
		     $result=mysqli_query($conn,$sql_insert);
             echo json_encode(['status'=>'Saved Subject']);
	    }
}
else
{
	 echo json_encode(['status'=>'No data sent']);
}




























/*if (isset($_POST["subject"])) 
{
	    extract($_POST);//$adm,$term

	    $sql_check="select * from subjects where school_reg='$school_reg' AND subject_name='$subject'";
	    $result=mysqli_query($conn,  $sql_check);
	    if(mysqli_num_rows($result)>0){
	     echo json_encode(['status'=>'Subject exists']);	//do nothing
	    }else{

	    	 $sql_insert="INSERT INTO `subjects`(`id`, `school_reg`, `subject_name`) 
	    	 VALUES (null,'$school_reg','$subject')";
		     //add the 3 variables
		     $result=mysqli_query($conn,$sql_insert);
                  echo json_encode(['status'=>'Saved Subject');

	    }
	   
		//check true/false query execution
/*		if($result)
		{
			  //echo "1";//1 for succes
			  $sql_fetch="select subject_name from subjects where school_reg='$school_reg'";
			  $result=mysqli_query($conn,  $sql_fetch);
	          $data=[];
	          while ($row=mysqli_fetch_assoc($result))
	          {
	          	$data[]=$row;
	          }
	          echo json_encode($data);
		}
		else {
		  echo "0";//0 for fail
		}*/ 
//}
?>
