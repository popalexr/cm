<?php
	include "dbconect.php";
	$target_dir = "../admin/fisiere";
	$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	if(isset($_FILES['fisier1'])){
      $file_name = $_FILES['fisier1']['name'];
      $file_size =$_FILES['fisier1']['size'];
      $file_tmp =$_FILES['fisier1']['tmp_name'];
      $file_type=$_FILES['fisier1']['type'];
      $file_ext=strtolower(end(explode('.',$file_name)));
      
      
      if($file_size > 21000000){
        echo "<script>alert('Dimensiunea fisierului trebuie sa fie sub 20MB.');</script>";
		echo '<script>location.href="index.php";</script>';
      }
      
      move_uploaded_file($file_tmp,$target_dir.$file_name);
      echo "<script>alert('Salvat cu succes.');</script>";
	  //echo '<script>location.href="index.php";</script>';
   }
?>