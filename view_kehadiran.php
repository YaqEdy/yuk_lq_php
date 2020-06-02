<?php
require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {
	date_default_timezone_set('Asia/Jakarta');

		// $sql = "SELECT * FROM vw_t_kehadiran ORDER BY nama_person ASC"; 	
   $param = $_POST['param'];
   $id_group = $_POST['id_group'];
   $tanggal = date('Y-m-d');

		// $sql = "SELECT * FROM vw_t_kehadiran where tanggal LIKE '$tanggal' ORDER BY nama_person ASC"; //WHERE DATE(last_update_date) =  DATE(NOW())	

   if($param == "1"){
		$sql = "SELECT * FROM vw_t_kehadiran where id_group LIKE '$id_group' ORDER BY tanggal desc ,nama_person ASC"; 	
	}else{
		$sql = "SELECT * FROM vw_t_kehadiran where tanggal = '$tanggal' and id_group LIKE '$id_group'  ORDER BY tanggal desc ,nama_person ASC"; //WHERE DATE(last_update_date) =  DATE(NOW())	AND id_group  LIKE '$id_group'
	}

	$res = mysqli_query($con,$sql);
  $result = array();
  while($row = mysqli_fetch_array($res)){
    // array_push($result, array('npm'=>$row[0], 'nama'=>$row[1], 'kelas'=>$row[2], 'sesi'=>$row[3]));
    array_push($result, array( 'pid_kehadiran'=>$row[0],'tanggal'=>$row[1],'nip'=>$row[2],'nama_person'=>$row[3],'last_update_date'=>$row[8],'file_path'=>$row[9],'absensi'=>$row[6],'ket'=>$row[7]));//, 'absensi'=>$row[6], 'ket'=>$row[7]));
  }
  // echo json_encode(array("value"=>1,"result"=>$result));
  if($result==null){
	array_push($result, array('nama_person'=>'Tidak ada data'));//, 'absensi'=>$row[6], 'ket'=>$row[7]));
  }
  echo json_encode($result);
  mysqli_close($con);
}