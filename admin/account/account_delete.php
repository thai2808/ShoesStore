<?php  
    session_start();
   include_once'../../connect.php';
   If(isset($_GET["Del"])){
		$AdID=$_GET['Del'];
      $sql1= "DELETE FROM blog WHERE AdID='$AdID'";
		$query1= mysqli_query($con,$sql1);
		$sql= "DELETE FROM admin WHERE AdID='$AdID'";
		$query= mysqli_query($con,$sql);
		header('location: ../admin.php?manage=account');}
