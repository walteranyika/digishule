<?php

include 'connect.php';
if (isset($_POST["adm"])) 
{
	  extract($_POST);//$adm
	  $sql ="SELECT * FROM `students` WHERE `stdreg_no`='$adm' AND  `school_id`='$school_reg'";
	  $result= mysqli_query($conn,$sql);
	  if(mysqli_num_rows($result)>0)
	  {
	    $row=mysqli_fetch_assoc($result);
	    echo $row["names"];
	  }else
	  {
	  	echo "No student found with adm $adm";
	  }
}else
{
	echo "Nothing was sent";
}

?>