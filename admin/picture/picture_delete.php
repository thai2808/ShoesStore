<?php  
    session_start();
   include_once'../../connect.php';
   If(isset($_GET["Del"])){
		$PicID=$_GET['Del'];
		$sql= "DELETE FROM picture WHERE PicID='$PicID'";
		$query= mysqli_query($con,$sql);
		header('location: ../admin.php?manage=picture');}
