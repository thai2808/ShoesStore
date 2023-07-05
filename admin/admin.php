<?php
ob_start();
session_start();
include_once("../connect.php");
$admin = "select * from admin";
$result = $con->query($admin);
$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Admin | ShoesStore</title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- Tempusdominus Bootstrap 4 -->
   <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
   <!-- iCheck -->
   <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <!-- JQVMap -->
   <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="dist/css/adminlte.min.css">
   <!-- overlayScrollbars -->
   <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
   <!-- summernote -->
   <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

</head>
</head>

<body class="hold-transition sidebar-mini layout-fixed">


   <div class="wrapper">

      <!-- Preloader -->
      <!-- <div class="preloader flex-column justify-content-center align-items-center">
         <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
      </div> -->

      <!-- Navbar -->
      <?php include('share/header_admin.php') ?>
      <!-- /.navbar -->



      <!-- Main Sidebar Container -->
      <?php include('share/sidebar.php') ?>

      <?php
      //master page
      if (isset($_GET['manage'])) {
         switch ($_GET['manage']) {
            case 'categories':
               include_once('./categories/categories.php');
               break;
            case 'categories_add':
               include_once('./categories/categories_add.php');
               break;
            case 'categories_edit':
               include_once('./categories/categories_edit.php');
               break;

            case 'product':
               include_once('./product/product.php');
               break;
            case 'product_add':
               include_once('./product/product_add.php');
               break;
            case 'product_edit':
               include_once('./product/product_edit.php');
               break;

            case 'brand':
               include_once('./brand/brand.php');
               break;
            case 'brand_add':
               include_once('./brand/brand_add.php');
               break;
            case 'brand_edit':
               include_once('./brand/brand_edit.php');
               break;

            case 'comment':
               include_once('./comment/comment.php');
               break;

            case 'customer':
               include_once('./customer/customer.php');
               break;


            case 'paymentmethod':
               include_once('./paymentmethod/paymentmethod.php');
               break;
            case 'paymentmethod_add':
               include_once('./categories/categories_add.php');
               break;
            case 'paymentmethod_edit':
               include_once('./categories/categories_add.php');
               break;

            case 'blog':
               include_once('./blog/blog.php');
               break;
            case 'blog_add':
               include_once('./blog/blog_add.php');
               break;
            case 'blog_edit':
               include_once('./blog/blog_edit.php');
               break;

            case 'picture':
               include_once('./picture/picture.php');
               break;
            case 'picture_add':
               include_once('./picture/picture_add.php');
               break;
            case 'picture_edit':
               include_once('./picture/picture_edit.php');
               break;

            case 'account':
               include_once('./account/account.php');
               break;
            case 'account_add':
               include_once('./account/account_add.php');
               break;
            case 'account_edit':
               include_once('./account/account_edit.php');
               break;
            case 'size':
               include_once('./size/size.php');
               break;
            case 'size_add':
               include_once('./size/size_add.php');
               break;
            case 'size_edit':
               include_once('./size/size_edit.php');
               break;
         }
      } else { ?>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                     </div><!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                     </div><!-- /.col -->
                  </div><!-- /.row -->
               </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
               <div class="container-fluid">
                  <!-- Small boxes (Stat box) -->
                  <div class="row">
                     <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                           <div class="inner">
                              <?php $today = date("Y-m-d");

                              // Tiến hành truy vấn
                              $sqll = "SELECT Count(*) as SoOrder FROM `oders` WHERE DATE(`OrdDate`) = '$today'";
                              $rs = $con->query($sqll);
                              if ($rs->num_rows > 0) {
                                 $rw = $rs->fetch_assoc();
                              } ?>
                              <h3><?= $rw['SoOrder'] ?></h3>

                              <p>New Orders Today</p>
                           </div>
                           <div class="icon">
                              <i class="ion ion-bag"></i>
                           </div>
                           <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                     </div>
                     <!-- ./col -->
                     <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                           <div class="inner">
                              <?php

                              // Tiến hành truy vấn
                              $sql_cmt = "SELECT Count(*) as SoCmt FROM `comments`";
                              $rs_cmt = $con->query($sql_cmt);
                              if ($rs_cmt->num_rows > 0) {
                                 $row_cmt = $rs_cmt->fetch_assoc();
                              } ?>
                              <h3><?= $row_cmt['SoCmt'] ?></h3>

                              <p>Comments</p>
                           </div>
                           <div class="icon">
                              <i class="fas fa-sharp fa-solid fa-comments"></i>
                           </div>
                           <a href="admin.php?manage=comment" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                     </div>
                     <!-- ./col -->
                     <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                           <div class="inner">
                              <?php

                              // Tiến hành truy vấn
                              $sql_cus = "SELECT Count(*) as SoUser FROM `customer`";
                              $rs_cus = $con->query($sql_cus);
                              if ($rs_cus->num_rows > 0) {
                                 $row_cus = $rs_cus->fetch_assoc();
                              } ?>
                              <h3><?= $row_cus['SoUser'] ?></h3>

                              <p>Customers</p>
                           </div>
                           <div class="icon">
                              <i class="ion ion-person-add"></i>
                           </div>
                           <a href="admin.php?manage=customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                     </div>
                     <!-- ./col -->
                     <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                           <div class="inner">
                              <?php
                              // Tiến hành truy vấn
                              $sql_blog = "SELECT Count(*) as SoBlog FROM `blog`";
                              $rs_blog = $con->query($sql_blog);
                              if ($rs_blog->num_rows > 0) {
                                 $row_blog = $rs_blog->fetch_assoc();
                              } ?>
                              <h3><?= $row_blog['SoBlog'] ?></h3>
                              <p>Blog</p>
                           </div>
                           <div class="icon">
                              <i class="fas fa-blog"></i>
                           </div>
                           <a href="admin.php?manage=blog" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                     </div>
                     <!-- ./col -->
                  </div>
                  <!-- /.row -->

               </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
         </div>
      <?php } ?>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
         <strong>HUce <a href="http://localhost/DoAnWeb/DoAnWeb/index.php">ShoesStore</a>.</strong>
         All rights reserved.
      </footer>
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
         <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
   </div>
   <!-- ./wrapper -->

   <!-- jQuery -->
   <script src="plugins/jquery/jquery.min.js"></script>
   <!-- jQuery UI 1.11.4 -->
   <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
   <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
   <script>
      $.widget.bridge('uibutton', $.ui.button)
   </script>
   <!-- Bootstrap 4 -->
   <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- ChartJS -->
   <script src="plugins/chart.js/Chart.min.js"></script>
   <!-- Sparkline -->
   <script src="plugins/sparklines/sparkline.js"></script>
   <!-- JQVMap -->
   <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
   <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
   <!-- jQuery Knob Chart -->
   <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
   <!-- daterangepicker -->
   <script src="plugins/moment/moment.min.js"></script>
   <script src="plugins/daterangepicker/daterangepicker.js"></script>
   <!-- Tempusdominus Bootstrap 4 -->
   <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
   <!-- Summernote -->
   <script src="plugins/summernote/summernote-bs4.min.js"></script>
   <!-- overlayScrollbars -->
   <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
   <!-- AdminLTE App -->
   <script src="dist/js/adminlte.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="dist/js/demo.js"></script>
   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script src="dist/js/pages/dashboard.js"></script>


</body>

</html>