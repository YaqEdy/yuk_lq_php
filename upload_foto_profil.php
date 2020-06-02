<?php
   require_once('dbConnect.php');
  
  $result = array(); 
  
 if($_SERVER['REQUEST_METHOD']=='POST'){
 
 //checking the required parameters from the request 
	 if(isset($_POST['nip']) and isset($_FILES['image']['name'])){
//	 if(isset($_FILES['image']['name'])){
	  
		$upload_url = $_POST['upload_url']; 
		$upload_url = str_replace('"','',$upload_url);
		$nip = $_POST['nip'];
		$nip = str_replace('"','',$nip);
		$upload_path = 'Profiles/';

		 $fileinfo = pathinfo($_FILES['image']['name']);
		 $extension = $fileinfo['extension'];
		 $file_path = $upload_path . uniqid(). $nip . '.'. $extension; 
		 $file_url_path = $upload_url . $file_path;
		 //trying to save the file in the directory 
			 try{
			 //saving the file 
			 move_uploaded_file($_FILES['image']['tmp_name'],$file_path);

			 $query="UPDATE `tbl_m_persons`
				SET `file_path`='$file_url_path'
				WHERE `nip`='$nip'";
			$exeQuery=mysqli_query($con,$query);
			 //adding the path and name to database 
				if($exeQuery){
				 $result['istatus'] = 1; 
				 $result['iremarks'] = $file_url_path; 
				}
			 //if some error occurred 
			 }catch(Exception $e){
				 $result['istatus']=0;
				 $result['iremarks']=$e->getMessage();
			 } 
	 //displaying the response 
	 echo json_encode($result);
	 mysqli_close($con);
	 
	 }else{
		 $result['istatus']=3;
		 $result['iremarks']='Please choose a file';
	}
	
	
 }