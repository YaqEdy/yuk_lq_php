<?php
	require_once('dbConnect.php');
   $id_group = $_POST['id_group'];
//   $id_group = 'L2015001';

	$sql = "select nip,nama_person,convert(fn_persentase_hadir_person(nip),int) kehadiran 
			from vw_t_group_persons 
			where id_group='$id_group'
			order by nama_person
"; 	

	$res = mysqli_query($con,$sql);
	$result = array();
	
	// for ($i=0; $row=mysqli_fetch_array($res) ; $i++) {
			// IF($i==0){
			// array_push($result,array($row[1],$row[2]));
			// }else{
			// array_push($result,array($row[1],(float)$row[2]));
			// }
		// }
	while($row = mysqli_fetch_array($res)){
		array_push($result, array( 'iField1'=>$row[1],'iField2'=>$row[2]));
		// array_push($result,array($row[1],$row[2]));//, 'absensi'=>$row[6], 'ket'=>$row[7]));
	}
	  if($result==null){
		array_push($result, array('iField1'=>'Tidak ada data'));//, 'absensi'=>$row[6], 'ket'=>$row[7]));
		// $result=array('Tidak ada data');//, 'absensi'=>$row[6], 'ket'=>$row[7]));
	  }
	  // $result_=array();
	  // array_push($result_, array('iField1'=>1,'iField2'=>$result));//, 'absensi'=>$row[6], 'ket'=>$row[7]));
		
	  echo json_encode($result);
	  mysqli_close($con);

?>
