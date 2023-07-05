<?php
session_start();
//    remove all session variables
// Xóa thông tin đăng nhập khỏi phiên làm việc
unset($_SESSION["fullname"]);
unset($_SESSION["login"]);

// unset($_SESSION['cart']);
// unset($_SESSION["size"]);
// // Xóa toàn bộ phiên làm việc
session_destroy();

// Chuyển hướng người dùng về trang chủ
header("Location: index.php");

?>