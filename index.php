<?php
session_start();
include_once('connect.php');
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
   <meta charset="UTF-8">
   <meta name="description" content="Ogani Template">
   <meta name="keywords" content="Ogani, unica, creative, html">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Shoes Store</title>
   <!-- Google Font -->
   <!-- <link href="https://fonts.googleapis.com/css2?family=Arial:wght@200;300;400;600;900&display=swap" rel="stylesheet"> -->
   <!-- Css Styles -->
   <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
   <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
   <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
   <link rel="stylesheet" href="css/nice-select.css" type="text/css">
   <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
   <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
   <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
   <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
   <!-- Header Section Begin -->
   <?php
   include('include/header.php');
   ?>
   <!-- Header Section End -->

   <!-- Categories Section Begin -->
   <?php
   include('include/menu-categories.php');
   ?>
   <!-- Categories Section End -->
   <?php

   include('include/search-product.php');

   // 
   ?>
   <!-- Product Section Begin -->
   <?php
   include('include/product-categories.php');
   ?>
   <!-- Product Section End -->

   <div class="col-lg col-md col-sm">
      <!-- <a href="#"><button class="btn btn-primary more" type="submit">Xem Thêm Sản Phẩm</button></a> -->
   </div>
   </section>
   <!-- Blog Section Begin -->
   <section class="from-blog spad">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="section-title from-blog__title">
               <h3>Tin Tức Shoes Online</h3>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-12">
            <div class="owl-carousel owl-theme" id="blogCarousel">
               <?php
               $sql_blog = mysqli_query($con, 'SELECT * FROM `blog`');
               while ($row_blog = mysqli_fetch_array($sql_blog)) {
                  $blogDescription = $row_blog['BlogDescription'];
                  if (strlen($blogDescription) > 255) {
                     $blogDescription = substr($blogDescription, 0, 255) . '...';
               ?>
                     <div class="item">
                        <div class="blog__item">
                           <div class="blog__item__pic">
                              <img src="img/blog/<?= $row_blog['BlogImage'] ?>" alt="" class="zoom-img">
                           </div>
                           <div class="blog__item__text">
                              <ul>
                                 <li><i class="fa fa-calendar-o"></i> <?= $row_blog['BlogDateCreated'] ?></li>
                              </ul>
                              <h5><a href="blog-details.php?BlogID=<?= $row_blog["BlogID"] ?>"><?= $row_blog['BlogTittle'] ?></a></h5>
                              <p><?= $blogDescription ?></p>
                           </div>
                        </div>
                     </div>
               <?php
                  }
               }
               ?>
            </div>
         </div>
      </div>
   </div>
</section>
   <!-- Blog Section End -->

   <!-- Band Section Begin -->
   <section class="categories">
      <div class="container">
         <div class="row">
            <div class="categories__slider owl-carousel">
               <?php
               $sql_category1 = mysqli_query($con, 'SELECT * FROM brand');
               while ($row_category1 = mysqli_fetch_array($sql_category1)) {
               ?>
                  <div class="col-lg-3">
                     <div class="categories__item set-bg" data-setbg="img/brand/<?php echo $row_category1['BraImage'] ?>">
                        <h5><a href="#"><?php echo $row_category1['BraName'] ?></a></h5>
                     </div>
                  </div>
               <?php
               }
               ?>
            </div>
         </div>
      </div>
   </section>
   <!-- Band Section End -->
   <!-- Footer Section Begin -->
   <?php
   include('include/footer.php');
   ?>
   <!-- Footer Section End -->

   <!-- Js Plugins -->
   <script src="js/jquery-3.3.1.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery.nice-select.min.js"></script>
   <script src="js/jquery-ui.min.js"></script>
   <script src="js/jquery.slicknav.js"></script>
   <script src="js/mixitup.min.js"></script>
   <script src="js/owl.carousel.min.js"></script>
   <script src="js/main.js"></script>
   <script>
   $(document).ready(function(){
      $("#blogCarousel").owlCarousel({
         items: 3,
         loop: true,
         margin: 40,
         autoplay: true,
         autoplayTimeout: 3000,
         autoplayHoverPause: true,
         responsive: {
            0:{
               items:1
            },
            768:{
               items:2
            },
            1200:{
               items:3
            }
         }
      });
   });
</script>


</body>

</html>