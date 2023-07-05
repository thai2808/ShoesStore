<?php  
    session_start();
   include_once'../../connect.php';
   If(isset($_GET["ProID"]) && isset($_GET["ProID"])){
		$ProID=$_GET['ProID'];
		$Size=$_GET['Size'];
		$sql= "DELETE FROM product_sizes WHERE ProID='$ProID'  and Size ='$Size'";
		$query= mysqli_query($con,$sql);
		header('location: ../admin.php?manage=size');}
