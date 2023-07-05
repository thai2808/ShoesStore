<?php  
	session_start();
   include_once'../../connect.php';
   If(isset($_GET["Del"])){
		$Pid=$_GET['Del'];
      //khoa ngoai
      $sql1= "DELETE FROM comments WHERE ProID='$Pid' ";
		$query1= mysqli_query($con,$sql1);
      $sql2= "DELETE FROM picture WHERE ProID='$Pid' ";
		$query2= mysqli_query($con,$sql2);
      $sql3= "DELETE FROM product_sizes WHERE ProID='$Pid' ";
		$query3= mysqli_query($con,$sql3);
      //
      $sql= "DELETE FROM product WHERE ProID='$Pid' ";
		$query= mysqli_query($con,$sql);
		header('location: ../admin.php?manage=product');}
?>