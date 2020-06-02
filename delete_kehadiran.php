<?php
   require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

   //mendapatkan data
   $pid_kehadiran = $_POST['pid_kehadiran'];

   //Cek npm sudah terdaftar apa belum
   $query="DELETE FROM tbl_t_kehadiran WHERE (pid_kehadiran=$pid_kehadiran)";
   $exeQuery=mysqli_query($con,$query);

   	if($exeQuery){
	$result=array('istatus'=>1, 'iremarks'=>'Data Berhasil Disimpan');//, 'body'=>'Data Berhasil Disimpan');
	}else{
	$result=array('istatus'=>2, 'iremarks'=>'Data Gagal Disimpan');
	}
	
	echo json_encode($result);
	mysqli_close($con);
   
}
  
  