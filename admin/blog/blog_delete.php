<?php  
    session_start();
   include_once'../../connect.php';
   If(isset($_GET["Del"])){
		$BlogID=$_GET['Del'];
		$sql= "DELETE FROM blog WHERE BlogID='$BlogID'";
		$query= mysqli_query($con,$sql);
		header('location: ../admin.php?manage=blog');}
