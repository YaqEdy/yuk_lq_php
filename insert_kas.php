<?php
   require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

	date_default_timezone_set('Asia/Jakarta');
   //mendapatkan data
   $pid_kas_update = $_POST['pid_kas'];
   $tgl_kas = date('Y-m-d H:i:s');
   $id_group = $_POST['id_group'];
   $status = $_POST['status'];
   $jumlah = $_POST['jumlah'];
   $ket = $_POST['ket'];
   $last_update_by = $_POST['last_update_by'];
   $last_update_date = date('Y-m-d H:i:s');
	
	$iremarks="";
	
   if($pid_kas_update==""){
	   //Insert Data
	   $query="INSERT INTO `tbl_t_kas`(
		`pid_kas`,
		`tgl_kas`,
		`id_group`,
		`status`,
		`jumlah`,
		`ket`,
		`last_update_by`,
		`last_update_date`)   
	   VALUES(
	   uuid(),
	   '$tgl_kas',
	   '$id_group',
	   '$status',
	   '$jumlah',
	   '$ket',
	   '$last_update_by',
	   '$last_update_date'
	   )";
	   $iremarks="Data Berhasil Disimpan";
   }else{
   //Update
   $query="UPDATE `tbl_t_kas`
   SET `status`='$status',`jumlah`='$jumlah',`ket`='$ket',`last_update_by`='$last_update_by',`last_update_date`='$last_update_date'
   WHERE `pid_kas`='$pid_kas_update'
   ";
	   $iremarks="Data Berhasil Diupdate";
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
  
  