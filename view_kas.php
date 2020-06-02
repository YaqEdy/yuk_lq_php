<?php
require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
	date_default_timezone_set('Asia/Jakarta');

   //$id_group = $_POST('id_group');
   // $tanggal = date('Y-m-d');

	$sql = "SELECT * FROM vw_t_kas
			where id_group='L2015001'"; //WHERE DATE(last_update_date) =  DATE(NOW())	AND id_group  LIKE '$id_group'

	$res = mysqli_query($con,$sql);
	$result = array();
	while($row = mysqli_fetch_array($res)){
		array_push($result, array( 'pid_kas'=>$row[0],'tgl_kas'=>$row[1],'id_group'=>$row[2],'status'=>$row[3],'jumlah'=>$row[4],'saldo'=>$row[5],'ket'=>$row[6],'st'=>$row[7]));
	}

	if($result==null){
		array_push($result, array('ket'=>'Tidak ada data'));
	}
	echo json_encode($result);
	mysqli_close($con);
}