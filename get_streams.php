<?php
include 'connect.php';
if (isset($_POST["school_reg"])) 
{
  extract($_POST);//$adm,$term
  $sql_fetch="select stream_name from streams where school_reg='$school_reg'";
  $result=mysqli_query($conn,  $sql_fetch);
  $data=[];
  while ($row=mysqli_fetch_assoc($result))
  {
  	$data[]=$row;
  }
  echo json_encode($data);
}