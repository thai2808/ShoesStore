<!-- Login -->
<?php
require('connect.php');
// Đăng Nhập
if (isset($_POST["txtuser"]) && isset($_POST["txtpass"])) {
   $username = $_POST["txtuser"];
   $password = $_POST["txtpass"];

   // Truy vấn cơ sở dữ liệu để kiểm tra tên người dùng và mật khẩu
   $sql = "SELECT * FROM customer WHERE CusUser = '$username' and CusPass = '$password'";
   $result = $con->query($sql);

   if ($result->num_rows == 1) {

      $row = $result->fetch_assoc();
      $_SESSION["fullname"] = $row["CusName"];
      $_SESSION["cusid"] = $row["CusID"];
      $_SESSION["login_error"] = "";
      $_SESSION["login"] = TRUE;

      // header("Location: index.php");
   } else {
      $_SESSION["login_error"] = "Username or Password incorrect! Please try again!";
      $_SESSION["login"] = FALSE;
      // header("Location: index.php");
      // echo"FALSE";
      echo "<script>alert('Thông tin đăng nhập chưa chính xác, Vui lòng đăng nhập lại!')</script>";
   }
}
//Đăng Kí
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["txtname"]) && isset($_POST["txtsdt"])&& isset($_POST["txtemail"]) && isset($_POST["txtadr"])) {
   $username = $_POST["username"];
   $password = $_POST["password"];
   $name = $_POST["txtname"];
   $sdt = $_POST["txtsdt"];
   $mail = $_POST["txtemail"];
   $adr = $_POST["txtadr"];

   // Truy vấn cơ sở dữ liệu để kiểm tra tên người dùng và mật khẩu
   $sql_reg = "INSERT INTO `customer`(`CusUser`, `CusPass`, `CusName`, `CusPhone`, `CusMail`, `CusAdr`) VALUES ('$username','$password','$name','$sdt','$mail','$adr')";
   $query = mysqli_query($con, $sql_reg);
   if ($query == TRUE) {
      $_SESSION['success_message'] = "Đăng Kí thành công!";
      echo "<script>alert('Đăng Kí Thành Công, Đăng Nhập Để Mua Hàng')</script>";
      // header('location: index.php');
   } else {
      echo "<center style='color: red;'>SửaThất Bại</center>";
   }
}
$sql_category = mysqli_query($con, 'SELECT * FROM categories');
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (!empty($_SESSION["cart"])) {
   $products1 = mysqli_query($con, "select * from product where ProID in (" . implode(",", array_keys($_SESSION["cart"])) . ")");
   $tong = 0;
   while ($row = mysqli_fetch_array($products1)) {
      $tong += $row['ProPrice'] * $_SESSION['cart'][$row['ProID']];
   }
}
//cate id trang hiện tại
$cateid  = !empty($_GET['CateID']) ? $_GET['CateID'] : "";
// echo"$cateid";
?>
<header class="header">
   <div class="header__top">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 col-md-6">
               <div class="header__top__left">
                  <ul>
                     <li><i class="fa fa-envelope"></i> shoesstore@gmail.com</li>
                     <li>Free Shipping for all Order of $99</li>
                  </ul>
               </div>
            </div>
            <div class="col-lg-6 col-md-6">
               <div class="header__top__right">
                  <div class="header__top__right__social">
                     <a href="#"><i class="fa fa-facebook"></i></a>
                     <a href="#"><i class="fa fa-twitter"></i></a>
                     <a href="#"><i class="fa fa-linkedin"></i></a>
                     <a href="#"><i class="fa fa-pinterest-p"></i></a>
                  </div>
                  <div class="header__top__right__auth">
                     <?php if (isset($_SESSION["login"]) && $_SESSION["login"] == TRUE) {
                        echo "Hello " . $_SESSION['fullname'] . " <a href='logout.php'><i class='fa fa-user'></i>Logout</a>";
                     } else {
                        echo "<a href='#' data-toggle='modal' data-target='#login'><i class='fa fa-user'></i> Login</a>/<a href='#' data-toggle='modal' data-target='#register'></i> Register</a>";
                     }
                     ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-lg-3">
            <div class="header__logo">
               <a href="./index.php"><img src="img/logo-shoes.png" alt=""></a>
            </div>
         </div>
         <div class="col-lg-7">
            <nav class="header__menu">
               <ul>
                  <?php
                  $sql_category = mysqli_query($con, 'SELECT * FROM categories Where CateStatus = 1');
                  while ($row_category = mysqli_fetch_array($sql_category)) {
                     if ($cateid != $row_category['CateID']) {
                  ?>
                        <li><a href='shop-grid.php?CateID=<?= $row_category['CateID'] ?>'><?= $row_category['CateName'] ?></a></li>
                     <?php
                     } else {
                     ?>
                        <li><a style="color: #cc9966;"><?= $row_category['CateName'] ?></a></li>
                  <?php
                     }
                  }
                  ?>
                  <li><a href="shop-grid.php?Category=Sale" class="sale">Sale</a></li>
                  <li><a href="./contact.php" class="contact">Contact</a></li>

               </ul>
            </nav>
         </div>
         <div class="col-lg-2">
            <div class="header__cart">
               <ul>
                  <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> -->
                  <li><a href="shoping-cart.php"><i class="fa fa-shopping-bag"></i> <span><?= $num_items_in_cart ?></span></a></li>
               </ul>
               <?php if (!empty($_SESSION["cart"])) { ?>
                  <div class="header__cart__price">item: <span><?= number_format($tong, 0, ",", ".") ?> đ</span></div>
               <?php } ?>
            </div>
         </div>
      </div>
      <div class="humberger__open">
         <i class="fa fa-bars"></i>
      </div>
   </div>
</header>
<!-- Font Awesome -->

<div class="modal fade " id="login" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header d-flex justify-content-center">
            <h4 class="modal-title">Đăng Nhập</h4>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button> -->
         </div>
         <div class="modal-body" >
            <form method="post" action="#" id="loginForm">
               <!-- Email input -->
               <div class="form-outline mb-4">
                  <input type="text" id="txtuser" class="form-control" placeholder="Email address" name="txtuser" required/>
                  <!-- <label class="form-label" for="form2Example1">Email address</label> -->
               </div>

               <!-- Password input -->
               <div class="form-outline mb-4">
                  <input type="password" id="txtpass" class="form-control" placeholder="Password" name="txtpass" required/>
                  <!-- <label class="form-label" for="form2Example2">Password</label> -->
               </div>

               <!-- 2 column grid layout for inline styling -->
               

               <!-- Submit button -->
               <button type="submit" class="btn btn-block mb-4 btn-signin">Sign in</button>

               <!-- Register buttons -->

            </form>
            
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="register" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header d-flex justify-content-center">
            <h4 class="modal-title">Đăng Kí</h4>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button> -->
         </div>
         <div class="modal-body" >
            <form method="post" action="#" id="loginForm">
               <!-- Email input -->
               <div class="form-outline mb-4">
                  <input type="text" id="txtuser" class="form-control" placeholder="Tên Đăng Nhập" name="username" required/>
                  <!-- <label class="form-label" for="form2Example1">Email address</label> -->
               </div>
               <!-- Password input -->
               <div class="form-outline mb-4">
                  <input type="password" id="txtpass" class="form-control" placeholder="Password" name="password" required/>
                  <!-- <label class="form-label" for="form2Example2">Password</label> -->
               </div>
               <div class="form-outline mb-4">
                  <input type="text" id="txtpass" class="form-control" placeholder="Họ Và Tên" name="txtname" required/>
                  <!-- <label class="form-label" for="form2Example2">Password</label> -->
               </div>
               <div class="form-outline mb-4">
                  <input type="text" id="txtpass" class="form-control" placeholder="Số Điện Thoại" name="txtsdt" required/>
                  <!-- <label class="form-label" for="form2Example2">Password</label> -->
               </div>
               <div class="form-outline mb-4">
                  <input type="text" id="txtpass" class="form-control" placeholder="Email" name="txtemail" required/>
                  <!-- <label class="form-label" for="form2Example2">Password</label> -->
               </div>
               <div class="form-outline mb-4">
                  <input type="text" id="txtpass" class="form-control" placeholder="Địa Chỉ" name="txtadr" required/>
                  <!-- <label class="form-label" for="form2Example2">Password</label> -->
               </div>


               <!-- 2 column grid layout for inline styling -->

               <!-- Submit button -->
               <button type="submit" class="btn btn-block mb-4 btn-signin">Sign in</button>

               <!-- Register buttons -->

            </form>
            
         </div>
      </div>
   </div>
</div>