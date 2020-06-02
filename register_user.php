<?php
   require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

	date_default_timezone_set('Asia/Jakarta');
   //mendapatkan data
   $nip = $_POST['nip'];
   $account = $_POST['account'];
   $password = $_POST['password'];
   $replace = $_POST['replace'];
   $last_update_date = date('Y-m-d H:i:s');

	$query_conf="SELECT COUNT(*) FROM `tbl_m_persons` WHERE `nip`='$nip' ";
	$queryConf=mysqli_query($con,$query_conf);
	$rowqueryConf = mysqli_fetch_array($queryConf);
		IF($rowqueryConf[0]>0){
			if($replace=="0"){
				$query="SELECT COUNT(*) FROM `tbl_user` WHERE `nip`='$nip' ";
				$query=mysqli_query($con,$query);
				$rowquery = mysqli_fetch_array($query);
					IF($rowquery[0]>0){
						$query1="SELECT pid_user FROM `tbl_user` WHERE `nip`='$nip'";
						$query1=mysqli_query($con,$query1);
						$rowquery1 = mysqli_fetch_array($query1);

						$result=array('istatus'=>0, 'iremarks'=>$rowquery1[0]);	
					}ELSE{
					   //Insert Data
					   $query_="INSERT INTO `tbl_user`(`pid_user`, `nip`, `account`, `password`, `last_update_date`)   
					   VALUES(uuid(),'$nip','$account',MD5('$password'),'$last_update_date')";				

						$exeQuery=mysqli_query($con,$query_);
						if($exeQuery){
							$result=array('istatus'=>1, 'iremarks'=>'Register Success');//, 'body'=>'Data Berhasil Disimpan');
						}else{
							$result=array('istatus'=>2, 'iremarks'=>'Register Failed');
						}	
					}
			}else{
			   //Update
			   $query_="UPDATE `tbl_user`
			   SET `account`='$account', `password`=MD5('$password'), `last_update_date`='$last_update_date'
			   WHERE `pid_user`='$replace'";

				$exeQuery=mysqli_query($con,$query_);
				if($exeQuery){
					$result=array('istatus'=>3, 'iremarks'=>'Replace Register Success');//, 'body'=>'Data Berhasil Disimpan');
				}else{
					$result=array('istatus'=>2, 'iremarks'=>'Replace Register Failed');
				}	
			}
			
		}ELSE{
			$result=array('istatus'=>4, 'iremarks'=>'Anda belum terdaftar sebagai anggota');
		}
	
	echo json_encode($result);
	mysqli_close($con);
   
}
  
  