<?php
include 'connect.php';
if (isset($_POST["school_reg"])) 
{
	    extract($_POST);//$adm,$term
	    /*      params.add("school_reg",school_reg);
        params.put("class",class_selected);
        params.put("exam",exam);
        params.put("term",term);
        params.put("subject",subject);
        params.put("marks",marks);*/

        $json_array=json_decode($marks, true);

        foreach ($json_array as $key => $value) {
        	$adm=  $value["adm"];
        	$score=$value["score"];
        	$year=date("Y");
		    $sql_check="select * from exams where exam_name='$exam' AND std_regno='$adm' AND subject='$subject' AND term='$term' AND year='$year'";
		    $result=mysqli_query($conn,  $sql_check);
		    if(mysqli_num_rows($result)>0){
		    	//update
		    	$sql_update = "update exams set score=$score where exam_name='$exam' AND std_regno='$adm' AND subject='$subject' AND term='$term' AND year='$year'";
		    	$result=mysqli_query($conn,$sql_update);
		    	echo "Updated";

		    }else{

		    	 $sql_insert="INSERT INTO `exams`(`exam_name`, `std_regno`, `subject`, `score`, `term`, `year`) VALUES ('$exam','$adm','$subject','$score','$term','$year')";
			     //add the 3 variables
			     $result=mysqli_query($conn,$sql_insert);
			     echo "Inserted";

		    }
        }


	    /*
	
	   
		//check true/false query execution
		if($result)
		{
		  echo "1";//1 for succes
		}
		else {
		  echo "0";//0 for fail
		} */
}
?>