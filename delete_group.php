<?php
   require_once('dbConnect.php');

if($_SERVER['REQUEST_METHOD']=='POST') {

   //mendapatkan data
   $id_group = $_POST['id_group'];
   
   $iremarks="";
   $istatus=0;
   //cek data
   $icek="SELECT count(1) FROM tbl_t_mapping
			where id_group ='$id_group';";
   $icek=mysqli_query($con,$icek);
   $icek=mysqli_fetch_array($icek);
   if($icek[0] > 0){
		$istatus=3;
		$iremarks="Group ini termapping tidak boleh dihapus.!";
   }else{     
		$query="DELETE FROM tbl_m_group WHERE (id_group='$id_group')";
		$exeQuery=mysqli_query($con,$query);

		if($exeQuery){
		$istatus=1;
		$iremarks="Group berhasil dihapus.!";
		// $result=array('istatus'=>1, 'iremarks'=>'Group berhasil dihapus.!');//, 'body'=>'Data Berhasil Disimpan');
		}else{
		$istatus=2;
		$iremarks="Group Gagal Dihapus.!";
		// $result=array('istatus'=>2, 'iremarks'=>'Data Gagal Dihapus');
		}
	}
	

	$result=array('istatus'=>$istatus, 'iremarks'=>$iremarks);//, 'body'=>'Data Berhasil Disimpan');
	
	echo json_encode($result);
	mysqli_close($con);
   
}
  
  