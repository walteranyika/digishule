<?php

include 'connect.php';
if (isset($_POST["class"])) 
{
	  extract($_POST);//$adm
	  $sql ="SELECT * FROM `students` WHERE `class`='$class' AND  `school_id`='$school_reg'";
	
	  $result= mysqli_query($conn,$sql);
	  if(mysqli_num_rows($result)>0)
	  {
	  	$data=[];
	    while ($row=mysqli_fetch_array($result)) {
	    	$data[]=$row;
	    }
	    echo json_encode($data);
	  }else
	  {
	  	echo "No student found";
	  }
}else
{
	   echo "Nothing was sent";
}

?>