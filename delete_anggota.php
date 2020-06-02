<?php
   require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

   //mendapatkan data
   $pid_persons = $_POST['pid_persons'];

   //Cek npm sudah terdaftar apa belum
   $query="DELETE FROM tbl_m_persons WHERE (pid_persons='$pid_persons')";
   $exeQuery=mysqli_query($con,$query);

   	if($exeQuery){
	$result=array('istatus'=>1, 'iremarks'=>'Data Berhasil Dihapus');//, 'body'=>'Data Berhasil Disimpan');
	}else{
	$result=array('istatus'=>2, 'iremarks'=>'Data Gagal Dihapus');
	}
	
	echo json_encode($result);
	mysqli_close($con);
   
}
  
  