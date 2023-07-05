<?php  
	session_start();
   include_once'../../connect.php';
   If(isset($_GET["Del"])){
		$Cid=$_GET['Del'];
      //rang buoc khoa ngoại
      $sql1= "DELETE FROM product WHERE CateID='$Cid'";
		$query1= mysqli_query($con,$sql1);
		$sql= "DELETE FROM categories WHERE CateID='$Cid'";
		$query= mysqli_query($con,$sql);
		header('location: ../admin.php?manage=categories');}
?>