<?php  
	session_start();
   include_once'../../connect.php';
   If(isset($_GET["Del"])){
		$CusID=$_GET['Del'];
      $sql1= "DELETE FROM comments WHERE ProID='$Pid' ";
		$query1= mysqli_query($con,$sql1);

      
		$sql= "DELETE FROM customer WHERE CusID='$CusID'";
		$query= mysqli_query($con,$sql);
		header('location: ../admin.php?manage=customer');}
?>