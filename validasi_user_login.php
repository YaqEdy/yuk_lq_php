<?php
   require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

	date_default_timezone_set('Asia/Jakarta');
   //mendapatkan data
   $nip = $_POST['nip'];
   $password = $_POST['password'];
   
	//Update Data      `nip`='$nip',`id_group`='$id_group',`nama_group`='$nama_group',
	$query="select count(*) from tbl_user where nip='$nip' or account='$nip' and password=md5('$password')";
	$query=mysqli_query($con,$query);
	$rowquery = mysqli_fetch_array($query);
	
	if($rowquery[0]>0){
		$queryuser="select c.* from
					(select a.nip,b.nama_person,b.id_group,b.nama_group,b.group_desc,b.file_path,b.status from tbl_user as a right outer join
										vw_t_group_persons as b on a.nip=b.nip
										where a.nip='$nip' or a.account='$nip' and a.password=md5('$password')
					) as c 
					where status=1";

		$exeQuery=mysqli_query($con,$queryuser);
		$rowuser = mysqli_fetch_array($exeQuery);

		if($exeQuery){
			$result=array('nip'=>$rowuser[0], 'nama_person'=>$rowuser[1], 'id_group'=>$rowuser[2], 'nama_group'=>$rowuser[3], 'group_desc'=>$rowuser[4], 'file_path'=>$rowuser[5]);//, 'body'=>'Data Berhasil Disimpan');
		}else{
			$result=array('nip'=>2, 'nama_person'=>'Failed');
		}

	}
	
	echo json_encode($result);
	mysqli_close($con);
   
}
  
  