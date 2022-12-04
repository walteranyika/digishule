<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//echo "Hi Mutsiysa";
//die();

include 'connect.php';

if (isset($_POST["adm"])) 

{

	

	  extract($_POST);//$adm,$term

//	  $term=str_replace(" ", "", $term);

/*	  $sql ="SELECT students.names, exams.exam_name, exams.subject, exams.score, exams.term, exams.year

				FROM students

				JOIN exams

				ON students.`stdreg_no`= exams.`std_regno`

				WHERE exams.`std_regno`=$adm

				AND  students.`school_id`='$school_reg'

				AND

				exams.term='$term'";
*/
$sql="SELECT students.names, exams.exam_name, exams.subject, exams.score, exams.term, exams.year FROM students JOIN exams ON
       students.`stdreg_no`= exams.`std_regno` WHERE exams.`year`='$year' and  exams.`std_regno`='$adm' AND students.`school_id`='$school_reg'
       AND exams.term='$term' AND exams.exam_name='$exam_name'";
//      die($sql);
	  $result= mysqli_query($conn,$sql) or die(mysqli_error($conn));



	  //echo "$sql";

	  if(mysqli_num_rows($result)>0)

	  {



	  	$scores=array();

	  	$names;$exam_name;$term;$year;

	  	$total=0;

	  	$mean=0;

	  	$count=0;

	    while ($row=mysqli_fetch_assoc($result)) 

	    {

	       $scores[]= array("subject"=>$row["subject"], "score"=>$row["score"]);

	       $total+=$row["score"];

	       $names=$row["names"];

	       $exam_name=$row["exam_name"];

	       $term=$row["term"];

	       $year=$row["year"];

	       $count++;

	    }

	    $mean=$total/$count;

	    $mean=round($mean,2);

	    

	    $meangrade = search($mean, $school_reg,$conn);



	    $all = array('names' =>$names, 'exam_name'=>$exam_name, 'term'=>$term,'year'=>$year, 'scores'=>$scores,'total'=>$total,'mean'=>$mean,'meangrade'=>$meangrade);

	    echo json_encode($all);

	    

	  }

	  else

	  {

	  	echo json_encode(array('message' =>"No info found with adm no. $adm"));

	  }

}else

{

	echo "Nothing was sent";

}





function search($score, $school_reg,$conn)

{

	$sql="select grade from grades where $score between lower and upper and school_id='$school_reg'";
	$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
//	$result = mysqli_query($sql,$conn);

	if(mysqli_num_rows($result)>0)

	{

	  $row= mysqli_fetch_assoc($result);

	  extract($row);

	  return $grade;

	}

	return "Y";

}







?>
