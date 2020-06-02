<?php
   require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

   //mendapatkan data
   $pid_notulen = $_POST['pid_notulen'];

   //Cek npm sudah terdaftar apa belum
   $query="DELETE FROM tbl_t_notulen WHERE (pid_notulen='$pid_notulen')";
   $exeQuery=mysqli_query($con,$query);

   	if($exeQuery){
	$result=array('istatus'=>1, 'iremarks'=>'Data Berhasil Dihapus');//, 'body'=>'Data Berhasil Disimpan');
	}else{
	$result=array('istatus'=>2, 'iremarks'=>'Data Gagal Dihapus');
	}
	
	echo json_encode($result);
	mysqli_close($con);
   
}
  
  