<?php
   require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

   $generate = $_POST['generate'];

	date_default_timezone_set('Asia/Jakarta');
	//Cek Data
	$QueryCek="SELECT count(1)		
	FROM vw_t_group_persons as a left outer join
	tbl_t_kehadiran as b on a.nip=b.nip and date(now())=b.tanggal
	WHERE a.status=1 and b.pid_kehadiran is null";
	
	$QueryCek=mysqli_query($con,$QueryCek);
	$rowCek = mysqli_fetch_array($QueryCek);
	if($rowCek[0]>0){
	   //Generate Data
	   $query="CALL cusp_generateKehadiran()";

	   $exeQuery=mysqli_query($con,$query);

		if($exeQuery){
			$result=array('istatus'=>1, 'iremarks'=>'Success Generate Kehadiran.!');//, 'body'=>'Data Berhasil Disimpan');
		}else{
			$result=array('istatus'=>2, 'iremarks'=>'Gagal Generate Kehadiran.!');
		}
	}else{
		$result=array('istatus'=>2, 'iremarks'=>'Data is up to date.!');
	}
	echo json_encode($result);
	mysqli_close($con);
   
}
  
  