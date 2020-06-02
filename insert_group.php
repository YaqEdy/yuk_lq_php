<?php
   require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

	date_default_timezone_set('Asia/Jakarta');
   //mendapatkan data
   $id_group = $_POST['id_group'];
   $nama_group = $_POST['nama_group'];
   $group_desc = $_POST['group_desc'];
   $year_now = date('Y');
   $number = 
	
	$iremarks="";
// 	   concat(concat('L', '$year_now'),
	
   if($id_group==""){
	   //Insert Data
	   $query="INSERT INTO `tbl_m_group`(
		`id_group`,
		`nama_group`,
		`group_desc`)   
	   VALUES(
	   concat(concat('L', '$year_now'),`fn_number_group`('$year_now')),
	   '$nama_group',
	   '$group_desc'
	   )";
	   $iremarks="Data Berhasil Disimpan";
   }else{
   //Update
   $query="UPDATE `tbl_m_group`
   SET `nama_group`='$nama_group',`group_desc`='$group_desc'
   WHERE `id_group`='$id_group'
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
  
  