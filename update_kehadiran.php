<?php
   require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

	date_default_timezone_set('Asia/Jakarta');
   //mendapatkan data
   $pid_kehadiran = $_POST['pid_kehadiran'];
   $tanggal = date('Y-m-d');
   //$nip = $_POST['nip'];
   //$id_group = $_POST['id_group'];
   //$nama_group = $_POST['nama_group'];
   $absensi = $_POST['absensi'];
   $ket = $_POST['ket'];
   $last_update_by = $_POST['last_update_by'];
   $last_update_date = date('Y-m-d H:i:s');
   
	//Update Data      `nip`='$nip',`id_group`='$id_group',`nama_group`='$nama_group',
   $query="UPDATE `tbl_t_kehadiran` 
   SET `pid_kehadiran`='$pid_kehadiran',`tanggal`='$tanggal',`absensi`='$absensi',`ket`='$ket',`last_update_by`='$last_update_by',`last_update_date`='$last_update_date'
   WHERE (`pid_kehadiran`='$pid_kehadiran')";
   $exeQuery=mysqli_query($con,$query);

   	if($exeQuery){
	$result=array('istatus'=>1, 'iremarks'=>'Data Berhasil Disimpan');//, 'body'=>'Data Berhasil Disimpan');
	}else{
	$result=array('istatus'=>2, 'iremarks'=>'Data Gagal Disimpan');
	}
	
	echo json_encode($result);
	mysqli_close($con);
   
}
  
  