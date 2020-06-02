<?php
   require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

   $generate = $_POST['generate'];

	date_default_timezone_set('Asia/Jakarta');
   //Insert Data
   $query="CALL cusp_deleteGenerateKehadiran()";

   $exeQuery=mysqli_query($con,$query);

	if($exeQuery){
	$result=array('istatus'=>1, 'iremarks'=>'Success Delete Generate');//, 'body'=>'Data Berhasil Disimpan');
	}else{
	$result=array('istatus'=>2, 'iremarks'=>'Gagal Delete Generate');
	}
	
	echo json_encode($result);
	mysqli_close($con);
   
}
  
  