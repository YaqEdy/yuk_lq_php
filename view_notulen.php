<?php
require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
	date_default_timezone_set('Asia/Jakarta');

   $id_group = $_POST['id_group'];
//   $id_group = "L2015001";
   // $tanggal = date('Y-m-d');

	$sql = "SELECT 
				pid_notulen,
				tanggal,
				id_group,
				nama_group,
				notulen,
				last_update_by,
				DATE_FORMAT(last_update_date,'%d %M %Y, %k:%i:%s') as last_update_date,
				left(notulen,250) as notes
			FROM tbl_t_notulen
			where id_group='$id_group' order by tanggal desc"; 

	$res = mysqli_query($con,$sql);
	$result = array();
	while($row = mysqli_fetch_array($res)){
		array_push($result, array( 'pid_notulen'=>$row[0],'tanggal'=>$row[1],'notulen'=>$row[4],'last_update_date'=>$row[6],'notes'=>$row[7]));
	}

	if($result==null){
		array_push($result, array('notulen'=>'Tidak ada data'));
	}
	echo json_encode($result);
	mysqli_close($con);
}