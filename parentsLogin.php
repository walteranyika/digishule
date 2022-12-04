<?php
include 'connect.php';
if (isset($_POST["schoolID"])) 
{
	  extract($_POST);//$adm,$term
	  $sql ="select * from parents where schoolID='$schoolID' AND phone='$phone'";
	  $result= mysqli_query($conn,$sql);
	  if(mysqli_num_rows($result)==1)
	  {
	  	$row = mysqli_fetch_assoc($result);
	  	extract($row);
	  	//var_dump($row);
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