<?php
require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
	date_default_timezone_set('Asia/Jakarta');

   $id_group = $_POST['id_group'];
   // $tanggal = date('Y-m-d');

	$sql = "SELECT
			`b`.`pid_persons`,
			`b`.`nip`,
			`b`.`nama_person`,
			`b`.`jenis_kelamin`,
			`b`.`no_hp`,
			`b`.`email`,
			`b`.`alamat`,
			`b`.`ket`,
			`b`.`file_path`,
			`c`.`id_group`,
			`c`.`nama_group`,
			`b`.`last_update_date`,
			`b`.`last_update_by`
			FROM
			`tbl_m_persons` AS `b`
			Inner Join `tbl_t_mapping` AS `a` ON `b`.`nip` = `a`.`nip`
			Inner Join `tbl_m_group` AS `c` ON `a`.`id_group` = `c`.`id_group`
			WHERE
			`c`.`id_group` =  '$id_group'
			AND `a`.`status` =  '1'
			ORDER BY `b`.`nama_person`
			"; 
	$res = mysqli_query($con,$sql);
	$result = array();
	while($row = mysqli_fetch_array($res)){
		array_push($result, array( 'pid_persons'=>$row[0],'nip'=>$row[1],'nama_person'=>$row[2],'jenis_kelamin'=>$row[3],'no_hp'=>$row[4],'email'=>$row[5],
		'alamat'=>$row[6],'ket'=>$row[7],'file_path'=>$row[8],'last_update_date'=>$row[11]
		));
	}

	if($result==null){
		array_push($result, array('ket'=>'Tidak ada data'));
	}
	echo json_encode($result);
	mysqli_close($con);
}