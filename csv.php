<?php
include 'connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_FILES['fileToUpload']) )
{

$target_dir = "uploads/";
$target_file = $target_dir.rand(10000,20000);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
    {
        
     //CODE

			$file=fopen($target_file,'r');
			$header=fgetcsv($file);
			$escapeHeader=[];
			foreach ($header as $key=>$value){
			   $lheader = strtolower($value);
			   $escapeItem = preg_replace('/[^a-z]/', '', $lheader);
			   array_push($escapeHeader, $escapeItem);
			}
			$count=0;
			while ($columns =fgetcsv($file)) {
			   if ($columns[0] == "") {
			       continue;
			   }
			   $data = array_combine($escapeHeader, $columns);
			   var_dump($data);
			   die();
			   $names=$data['names'];
			   $reg_no=$data['stdregno'];
			   $school_id=$data['schoolid'];
			   $kcpe_marks=$data['kcpemarks'];
			   $claass=$data['class'];
			   $classy=$data['classy'];
			   $year=$data['year'];
			   $phone=$data['phone'];
		
			   $sql="INSERT INTO `students`( `names`, `stdreg_no`, `school_id`, `kcpe_marks`, `class`, `classy`, `year`, `phone`) 
			                       VALUES ('$names','$reg_no','$school_id','$kcpe_marks','$claass','$classy','$year','$phone')";

              mysqli_query($conn, $sql)or die(mysqli_error($conn));
              $count++;
			}
			echo "Uploaded $count students";


     //CODE 	


    } else {
        echo "Sorry, there was an error uploading your file.";
    }

}else{
	echo "No Data received";
}