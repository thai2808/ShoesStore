<?php  
	session_start();
   include_once'../../connect.php';
   If(isset($_GET["Del"])){
		$Bid=$_GET['Del'];
      $sql1= "DELETE FROM product WHERE BraID='$Bid'";
		$query1= mysqli_query($con,$sql1);
		$sql= "DELETE FROM brand WHERE BraID='$Bid'";
		$query= mysqli_query($con,$sql);
		header('location: ../admin.php?manage=brand');}
?>