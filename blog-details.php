<?php
   session_start();
   require("connect.php");
   
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
   <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

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
<?php

include('include/header.php');
?>
   <!-- Page Preloder -->
   <div id="preloder">
      <div class="loader"></div>
   </div>
   <!-- Hero Section Begin -->
   <?php

   include('include/categories-search.php');
   ?>
   <?php
   $BlogID = $_REQUEST["BlogID"];
   if (!is_null($BlogID) && $BlogID != "") {
      $sqlDetails = "SELECT * FROM blog,admin WHERE blog.AdID = admin.AdID and BlogID =" . $BlogID;
      $result = $con->query($sqlDetails) or die($con->error);
      if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
      }
   }
   ?>
   <!-- Blog Details Hero Begin -->
   <section class="blog-details-hero set-bg" data-setbg="img/tp229-blogbanner-05-452.jpg">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="blog__details__hero__text">
                  <h2>BLOG</h2>
                  <ul>
                     <li>by <?= $row['AdName'] ?></li>
                     <li><?= $row['BlogDateCreated'] ?></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Blog Details Hero End -->

   <!-- Blog Details Section Begin -->
   <section class="blog-details spad">
      <div class="container">
         <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
               <div class="blog__sidebar">
                  <div class="blog__sidebar__item">
                     <h4>Recent News</h4>
                     <div class="blog__sidebar__recent">
                        <?php
                        $sql_recent = mysqli_query($con, "SELECT * FROM `blog` where `BlogID` != '$BlogID' order by `BlogDateCreated` desc");

                        while ($row_recent = mysqli_fetch_array($sql_recent)) {
                        ?>
                           <a href="blog-details.php?BlogID=<?= $row_recent['BlogID'] ?>" class="blog__sidebar__recent__item">
                              <div class="blog__sidebar__recent__item__pic">
                                 <img src="img/blog/<?= $row_recent['BlogImage'] ?>" alt="">
                              </div>
                              <div class="blog__sidebar__recent__item__text">

                                 <h6><?= $row_recent['BlogTittle'] ?></h6>
                                 <span><?= $row_recent['BlogDateCreated'] ?></span>
                              </div>
                           </a>
                        <?php } ?>
                     </div>
                  </div>
                  <div class="blog__sidebar__item">
                     <h4>Search By</h4>
                     <div class="blog__sidebar__item__tags">
                        <a href="#">Shoe</a>
                        <a href="#">Trending</a>
                        <a href="#">Hot</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
               <h2 style="text-align: center;font-weight: 500;padding-bottom: 40px"><?= $row['BlogTittle'] ?></h2>
               <div class="blog__details__text">
                  <img src="img/blog/<?= $row['BlogImage'] ?>" alt="">
                  <span style="font-weight:bold; font-family:Times New Roman,Times,serif;">
                     <i><?= $row['BlogDescription'] ?></i>
                  </span>
                  <br><br>
                  <?= $row['BlogContent'] ?>
               </div>
               <div class="blog__details__content">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="blog__details__author">
                           <div class="blog__details__author__pic">
                              <img src="img/blog/avatar.jpg" alt="">
                           </div>
                           <div class="blog__details__author__text">

                              <h6><?= $row['AdName'] ?></h6>
                              <span>Admin</span>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="blog__details__widget">
                           <ul>
                              <li><span>Tags:</span> All, Trending, Shoe</li>
                           </ul>
                           <div class="blog__details__social">
                              <a href="#"><i class="fa fa-facebook"></i></a>
                              <a href="#"><i class="fa fa-twitter"></i></a>
                              <a href="#"><i class="fa fa-google-plus"></i></a>
                              <a href="#"><i class="fa fa-linkedin"></i></a>
                              <a href="#"><i class="fa fa-envelope"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Blog Details Section End -->

   <!-- Related Blog Section Begin -->
   <section class="related-blog spad">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="section-title related-blog-title">
                  <h2>Post You May Like</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <?php
            $sql_blog = mysqli_query($con, "SELECT * FROM `blog` where `BlogID` != '$BlogID'");
            while ($row_blog = mysqli_fetch_array($sql_blog)) {
               $blogDescription = $row_blog['BlogDescription'];
               if (strlen($blogDescription) > 255) {
                  $blogDescription = substr($blogDescription, 0, 255) . '...';
            ?>
                  <div class="col-lg-4 col-md-4 col-sm-6">
                     <div class="blog__item">
                        <div class="blog__item__pic">
                           <img src="img/all/<?= $row_blog['BlogImage'] ?>" alt="" class="zoom-img">
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
   </section>
   <!-- Related Blog Section End -->
   <?php
   include('include/footer.php');
   ?>
   <!-- Js Plugins -->
   <script src="js/jquery-3.3.1.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery.nice-select.min.js"></script>
   <script src="js/jquery-ui.min.js"></script>
   <script src="js/jquery.slicknav.js"></script>
   <script src="js/mixitup.min.js"></script>
   <script src="js/owl.carousel.min.js"></script>
   <script src="js/main.js"></script>



</body>

</html>