<?php
header("Content-type:application/json");

if (isset($_POST['school_id']))
{
    include 'connect.php';
    extract($_POST);
    $result =mysqli_query($conn,"select grade, lower, upper from grades where school_id='$school_id'");
    $data=[];
    while($row=mysqli_fetch_assoc($result))
    {
       $data[]=$row;
    }
    echo json_encode($data);
}
else {
    echo json_encode(array('result' =>'Could Not Process The Grades'));
}
?>
