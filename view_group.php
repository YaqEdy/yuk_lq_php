<?php
require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
	date_default_timezone_set('Asia/Jakarta');

   //$id_group = $_POST('id_group');
   // $tanggal = date('Y-m-d');

	$sql = "SELECT id_group,nama_group,group_desc FROM `tbl_m_group` order by nama_group"; //WHERE DATE(last_update_date) =  DATE(NOW())	AND id_group  LIKE '$id_group'

	$res = mysqli_query($con,$sql);
	$result = array();
	while($row = mysqli_fetch_array($res)){
		array_push($result, array( 'id_group'=>$row[0],'nama_group'=>$row[1],'group_desc'=>$row[2]));
	}

	if($result==null){
		array_push($result, array('group_desc'=>'Tidak ada data'));
	}
	echo json_encode($result);
	mysqli_close($con);
}