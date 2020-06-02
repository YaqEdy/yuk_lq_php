<?php
   require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

	date_default_timezone_set('Asia/Jakarta');
   //mendapatkan data
   $pid_notulen = $_POST['pid_notulen'];
   $tanggal = date('Y-m-d H:i:s');
   $id_group = $_POST['id_group'];
   $nama_group = $_POST['nama_group'];
   $notulen = $_POST['notulen'];
   $last_update_by = $_POST['last_update_by'];
   $last_update_date = date('Y-m-d H:i:s');
   
	$iremarks="";
	
   if($pid_notulen==""){
	   //Insert Data
		$pid="select uuid()";
		$pid=mysqli_query($con,$pid);
		$rowpid = mysqli_fetch_array($pid);
		$pid=$rowpid[0];
	   $query="INSERT INTO `tbl_t_notulen`(
		`pid_notulen`,
		`tanggal`,
		`id_group`,
		`nama_group`,
		`notulen`,
		`last_update_by`,
		`last_update_date`)   
	   VALUES(
	   '$pid',
	   '$tanggal',
	   '$id_group',
	   '$nama_group',
	   '$notulen',
	   '$last_update_by',
	   '$last_update_date'
	   )";
	   $iremarks=$pid;
   }else{
   //Update
   $query="UPDATE `tbl_t_notulen`
   SET `notulen`='$notulen',`last_update_by`='$last_update_by',`last_update_date`='$last_update_date'
   WHERE `pid_notulen`='$pid_notulen'
   ";
	   $iremarks="Update Success.!";
   }

   $exeQuery=mysqli_query($con,$query);

	if($exeQuery){
	$result=array('istatus'=>1, 'iremarks'=>$iremarks);//, 'body'=>'Data Berhasil Disimpan');
	}else{
	$result=array('istatus'=>2, 'iremarks'=>'Gagal');
	}
	
	echo json_encode($result);
	mysqli_close($con);
   
}
  
  