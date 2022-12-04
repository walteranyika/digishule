<?php
include 'connect.php';
if (isset($_POST["stream"])) 
{
	    extract($_POST);//$adm,$term

	    $sql_check="select * from streams where school_reg='$school_reg' AND stream_name='$stream'";
	    $result=mysqli_query($conn,  $sql_check);
	    if(mysqli_num_rows($result)>0){
	    	//do nothing
	    }else{

	    	 $sql_insert="INSERT INTO `streams`(`id`, `school_reg`, `stream_name`) 
	    	 VALUES (null,'$school_reg','$stream')";
		     //add the 3 variables
		     $result=mysqli_query($conn,$sql_insert);

	    }
	   
		//check true/false query execution
		if($result)
		{
			  //echo "1";//1 for succes
			  $sql_fetch="select stream_name from streams where school_reg='$school_reg'";
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
		} 
}
?>