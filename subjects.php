<?php
if(isset($_POST["school_reg"])) 
{
	    include 'connect.php';
	    extract($_POST);//$adm,$ter
	    $sql_check="select * from subjects where school_reg='$school_reg'";
	    $result=mysqli_query($conn,  $sql_check);
	    if(mysqli_num_rows($result)>0)
	    {
	    	$data=[];
	    	while ($row=mysqli_fetch_assoc($result) ){
	    		$data[]=$row;
	    	}
	        echo json_encode($data);	//do nothing
	    }
	    else
	    {
             echo json_encode(['status'=>'No Subjects Available']);
	    }
}
else
{
	 echo json_encode(['status'=>'No data sent']);
}
?>

