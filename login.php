<?php
include 'connect.php';
if (isset($_POST["school_reg"])) 
{
	  extract($_POST);//$adm,$term
	  $sql ="select * from schools where school_reg='$school_reg' AND password='$password'";
	  $result= mysqli_query($conn,$sql);
	  if(mysqli_num_rows($result)==1)
	  {
	  	$row = mysqli_fetch_row($result);
	  	$name=$row[1];
         echo json_encode(array('status' => "success", 'name'=>$name));   
	  }
	  else
	  {
	  	 echo "Wrong username or password";
	  }

}else
{
	 echo "No data was sent";
}

?>