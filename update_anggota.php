<?php
   require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

	date_default_timezone_set('Asia/Jakarta');
   //mendapatkan data
   $pid_persons = $_POST['pid_persons'];
   $nip = $_POST['nip'];
   $nama_person = $_POST['nama_person'];
   $jenis_kelamin = $_POST['jenis_kelamin'];
   $no_hp = $_POST['no_hp'];
   $email = $_POST['email'];
   $alamat = $_POST['alamat'];
   $ket = $_POST['ket'];
   $last_update_by = $_POST['last_update_by'];
   $last_update_date = date('Y-m-d H:i:s');
   $year_now = date('Y');
   
	$iremarks="";
	
   if($pid_persons==""){
	   //Insert Data
	   $query="INSERT INTO `tbl_m_persons`(
			`pid_persons`,
			`nip`,
			`nama_person`,
			`jenis_kelamin`,
			`no_hp`,
			`email`,
			`alamat`,
			`ket`,
			`last_update_date`,
			`last_update_by`
		)   
	   VALUES(
	   uuid(),
	   concat('$year_now',`fn_number_person`('$year_now')),
	   '$nama_person',
	   '$jenis_kelamin',
	   '$no_hp',
	   '$email',
	   '$alamat',
	   '$ket',
	   '$last_update_date',
	   '$last_update_by'
	   )";
	   $iremarks="Insert success.!";
   }else{
   //Update
   $query="UPDATE `tbl_m_persons`
   SET 
   `nip`='$nip',
   `nama_person`='$nama_person',
   `jenis_kelamin`='$jenis_kelamin',
   `no_hp`='$no_hp',
   `email`='$email',
   `alamat`='$alamat',
   `ket`='$ket',
   `last_update_by`='$last_update_by',
   `last_update_date`='$last_update_date'
   WHERE `pid_persons`='$pid_persons'
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
  
  