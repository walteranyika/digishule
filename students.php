<?php

include 'connect.php';
if (isset($_POST["names"]))
{
	    extract($_POST);
        $file_name_to_save="default.png";
	  /*  if (isset($_POST["fileToUpload"])) 
	    {
	         	 $target_dir = "uploads/";
                 //$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                 $path = $_FILES['fileToUpload']['name'];
                 $ext = pathinfo($path, PATHINFO_EXTENSION);
                 $x=rand(100000,10000000);
                 $y=rand(100000,10000000);
                 $new_name=$x."_".$y.".".$ext;
                 $target_file = $target_dir .$new_name;
                 //fill in with correct credentilas
                 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
                 {
                   $file_name_to_save=$new_name;
                 }else
                 {
                   $file_name_to_save="default.png";
                 }

	    }*/

	    $sql_check="select * from students where stdreg_no='$admn' AND school_id='$school_reg'";
	    $result_check=mysqli_query($conn,$sql_check);
	    if(mysqli_num_rows($result_check)==0)
	    {
	        $year=date("Y");
			$school_id=1;

			$classy=1;
	        $sql="INSERT INTO `students`(`names`, `stdreg_no`, `school_id`, `kcpe_marks`, `class`, `year`,  `classy`,`phone`,`photo`) 
	                            VALUES ('$names','$admn','$school_reg','$kcpe','$cls','$year','$classy','$phone','$file_name_to_save')";
			//add the 3 variables
	        /* echo $sql;
	         die(); */                  
			$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			//check true/false query execution
			if($result)
			{
			   echo json_encode(array('status' => 1, "message"=>"Success" ));//1 for success
			}
			else {
			   echo json_encode(array('status' => 0, "message"=>"Failed" ));//1 for success
			}
	    }else{
	    	echo json_encode(array('status' => 2, "message"=>"Student already registered" ));//1 for success

	    }
		//save in MYSQL db
		//connect to mysql server
		
}

?>