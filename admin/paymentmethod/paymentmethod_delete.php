<?php  
    session_start();
   include_once'../../connect.php';
   If(isset($_GET["Del"])){
		$PayID=$_GET['Del'];
		$sql= "DELETE FROM paymentmethod WHERE PayID='$PayID'";
		$query= mysqli_query($con,$sql);
		header('location: ../admin.php?manage=paymentmethod');}
