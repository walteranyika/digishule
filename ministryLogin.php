<?php
include 'connect.php';
if (isset($_POST["username"])) 
{
	  extract($_POST);//$adm,$term
	  $sql ="select * from ministry where username='$username' AND password='$password' LIMIT 1";
	  $result= mysqli_query($conn,$sql);
	  if(mysqli_num_rows($result)==1)
	  {
	  	$row = mysqli_fetch_assoc($result);
	  	extract($row);
        echo json_encode(array('status' => "success", 'names'=>$names));   
	  }
	  else
	  {
	  	echo json_encode(array('status' => "failed", 'names'=>'')); 
	  }

}else
{
	 echo "No data was sent";
}

?>