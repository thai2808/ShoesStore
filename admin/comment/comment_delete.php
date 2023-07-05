<?php  
	session_start();
   include_once'../../connect.php';
   If(isset($_GET["Del"])){
		$Cmtid=$_GET['Del'];
		$sql= "DELETE FROM comments WHERE ComID='$Cmtid'";
		$query= mysqli_query($con,$sql);
		header('location: ../admin.php?manage=comment');}
?>