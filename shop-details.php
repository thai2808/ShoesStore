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
   <link rel="stylesheet" href="css/shop-details.css" type="text/css">
</head>

<body>
   <?php
   if (isset($_SESSION["cusid"]) && isset($_GET["proid"]) &&isset($_GET["comment"]) && isset($_GET["rating"])) {
      $cusid = $_SESSION["cusid"];
      $proid = $_GET["proid"];
      $comment = $_GET["comment"];
      $star = $_GET["rating"];
      $query_str =
         "Insert into comments(CusID, ProID, ComContent, Star) 
values ('{$cusid}', '{$proid}', '{$comment}', '{$star}')";
      $is_ok = $con->query($query_str);
      if ($is_ok) {
         header("Location: shop-details.php?ProID={$proid}");
      } else {
         echo "Error";
      }
   }
   include('include/header.php');
   ?>
   <!-- Page Preloder -->
   <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->


   <!-- Header Section End -->

   <!-- Hero Section Begin -->
   <?php

   include('include/categories-search.php');
   ?>
   <!-- Hero Section End -->
   <?php

   if (isset($_GET['ProID'])) {
      $ProID = $_GET['ProID'];
      $sqlDetails = "SELECT * FROM product WHERE ProID =" . $ProID;
      $result = $con->query($sqlDetails) or die($con->error);
      if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         $BraID = $row['BraID'];
         $availableQuantity = $row['ProNumber'];
      }
   }
   ?>
   <!-- Breadcrumb Section Begin -->
   <section class="breadcrumb-section set-bg" data-setbg="img/tp229-blogbanner-05-452.jpg">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center">
               <div class="breadcrumb__text">
                  <h2>Shop Details</h2>
                  <div class="breadcrumb__option">
                     <a href="./index.php">Home</a>
                     <span>Shoes</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Breadcrumb Section End -->
   <?php
   if (isset($_GET['search-product'])) {
      include('include/search-product.php');
   } else {

      // 
   ?>
      <!-- Product Details Section Begin -->
      <section class="product-details spad">
         <div class="container">
            <div class="row">
               <div class="col-lg-6 col-md-6">
                  <div class="product__details__pic">
                     <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" style="border: 1px solid #e1e1e1;" src="img/all/<?= $row["ProPicture"] ?>" alt="">
                     </div>
                     <div class="product__details__pic__slider owl-carousel">
                        <?php
                        if (isset($_GET["ProID"])) {
                           $ProID = $_GET["ProID"];
                           $sqlimg = "select * from picture where ProID = " . $ProID;
                           $rs = $con->query($sqlimg) or die($con->error);
                           while ($kq = $rs->fetch_assoc()) {
                        ?>
                              <img data-imgbigurl="img/img-pro/<?= $kq["Image1"] ?>" src="img/img-pro/<?= $kq["Image1"] ?>" alt="">
                              <img data-imgbigurl="img/img-pro/<?= $kq["Image2"] ?>" src="img/img-pro/<?= $kq["Image2"] ?>" alt="">
                              <img data-imgbigurl="img/img-pro/<?= $kq["Image3"] ?>" src="img/img-pro/<?= $kq["Image3"] ?>" alt="">
                              <img data-imgbigurl="img/img-pro/<?= $kq["Image4"] ?>" src="img/img-pro/<?= $kq["Image4"] ?>" alt="">
                        <?php }
                        } ?>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6">
                  <div class="product__details__text">
                     <h3><?= $row["ProName"] ?></h3>
                     <?php
                     $count = 0;
                     $star5Count = 0;
                     $star4Count = 0;
                     $star3Count = 0;
                     $star2Count = 0;
                     $star1Count = 0;
                     $sqlComment = "Select * from comments inner join customer on comments.CusID = customer.CusID where ProID=" . $_GET["ProID"] . " order by ComDate desc";
                     $comments = $con->query($sqlComment) or die($con->error);
                     $reviews = array();
                     while ($rowc = $comments->fetch_array()) {
                        $reviews[] = $rowc;
                        $count++;
                        switch ($rowc['Star']) {
                           case "1";
                              $star1Count++;
                              break;
                           case "2";
                              $star2Count++;
                              break;
                           case "3";
                              $star3Count++;
                              break;
                           case "4";
                              $star4Count++;
                              break;
                           case "5";
                              $star5Count++;
                              break;
                        }
                     }
                     if ($count > 0) {
                        $totalRatings = $star5Count + $star4Count + $star3Count + $star2Count + $star1Count;
                        $totalStars = $star5Count * 5 + $star4Count * 4 + $star3Count * 3 + $star2Count * 2 + $star1Count * 1;
                        $averageRating = round($totalStars / $totalRatings, 1);
                        $wholeStars = floor($averageRating);
                        $decimalStars = $averageRating - $wholeStars;
                     }
                     ?>
                     <div class="product__details__rating">
                        <?php
                        if ($count > 0) {
                           for ($i = 1; $i <= $wholeStars; $i++) {
                              echo '<span class="fa fa-star checked"></span>';
                           }
                           if ($decimalStars > 0) {
                              echo '<span class="fa fa-star-half checked"></span>';
                           }
                        }
                        ?>
                        <?php
                        if ($count > 1) { ?>
                           <span>(<?= $count ?> reviews)</span>
                        <?php
                        } else {
                        ?>
                           <span>(<?= $count ?> review)</span>
                        <?php
                        }
                        ?>
                     </div>
                     <div class="product__details__price"><?= number_format($row['ProPrice'], 0, ",", ".") ?> đ</div>
                     <p><?= $row["ProInfo"] ?></p>
                     <form id="add-to-cart-form" action="shoping-cart.php?action=add" method="POST" style="display:flex">
                        <div class="product__details__quantity">
                           <div class="quantity">
                              <b>Số Lượng:</b>
                              <div class="pro-qty">
                                 <input type="number" value="1" min=0 max=<?= $availableQuantity ?> name="quantity[<?= $row['ProID'] ?>]">
                              </div>
                              <b>Size:</b>
                              <select name="size[<?= $row['ProID'] ?>]" id="size" class="size">
                                 <!-- <option>-- Chọn Size --</option> -->
                                 <?php
                                 $sqlSizes = "SELECT * FROM product_sizes where ProID = " . $ProID;
                                 $resultSizes = $con->query($sqlSizes) or die($con->error);
                                 while ($rowSize = $resultSizes->fetch_assoc()) {
                                    echo '<option value="' . $rowSize['Size'] . '">' . $rowSize['Size'] . '</option>';
                                 }
                                 ?>
                              </select>
                           </div>
                        </div>
                        <?php
                        if (isset($_SESSION["login"]) && $_SESSION["login"] == TRUE) {
                           if ($row['ProNumber'] == 0) {
                        ?>
                              <button type="submit" class="primary-btn" style="border:none; opacity: 0.5; margin:0 auto" disabled>ADD TO CARD</button>
                           <?php
                           } else { ?>
                              <button type="submit" class="primary-btn" style="border:none;margin:0 auto">ADD TO CARD</button>
                           <?php
                           }
                        } else { ?>
                           <a href='#' data-toggle='modal' data-target='#login'><button class="primary-btn" style="border:none;margin:0 auto">ADD TO CARD</button></a>
                        <?php } ?>


                     </form>
                     <ul>
                        <li><b>Availability</b>
                           <?php
                           if ($row['ProNumber'] > 0) {
                              echo "<span>In Stock" . " (" . $availableQuantity . " products)</span>";
                           } else {
                              echo "<span style=color:#dd2222;>Out Of Stock</span>";
                           }
                           ?>
                        </li>
                        <li><b>Shipping</b> <span>03 days shipping. <samp>Free pickup today</samp></span></li>
                        <!-- <li><b>Weight</b> <span>0.5 kg</span></li> -->
                        <li><b>Share on</b>
                           <div class="share">
                              <a href="#"><i class="fa fa-facebook"></i></a>
                              <a href="#"><i class="fa fa-twitter"></i></a>
                              <a href="#"><i class="fa fa-instagram"></i></a>
                              <a href="#"><i class="fa fa-pinterest"></i></a>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
               <!-- <section class="ct"> -->
               <div class="container">
                  <div class="row">
                     <div class="col-lg-3 kmm">
                        <div>
                           <img src="img/deliver.png" alt="">
                        </div>
                        <div class="content-text">
                           <h6 style="font-weight: 600;">Vận chuyển miễn phí</h6>
                           <p>Cho đơn hàng > 500.000đ</p>
                        </div>
                     </div>
                     <div class="col-lg-3 kmm">
                        <div>
                           <img src="img/gift-box.png" alt="" width="50">
                        </div>
                        <div class="content-text">
                           <h6 style="font-weight: 600;">Mua 2 được giảm giá</h6>
                           <p>Lên đến 10% cho đơn hàng kế tiếp</p>
                        </div>
                     </div>
                     <div class="col-lg-3 kmm">
                        <div class="">
                           <img src="img/award.png" alt="" width="50">
                        </div>
                        <div class="content-text">
                           <h6 style="font-weight: 600;">Chứng nhận chất lượng</h6>
                           <p>Sản phẩm chất lượng kiểm định</p>
                        </div>
                     </div>
                     <div class="col-lg-3 kmm">
                        <div class="">
                           <img src="img/hotline.png" alt="" width="50">
                        </div>
                        <div class="content-text">
                           <h6 style="font-weight: 600;">Hotline: 19001234</h6>
                           <p>Hỗ trợ trực tiếp nhanh chóng</p>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- </section> -->
               <div class="col-lg-12">
                  <div class="product__details__tab">
                     <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Total Reviews</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Reviews <span>(<?= $count ?>)</span></a>
                        </li>
                     </ul>
                     <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                           <div class="product__details__tab__desc">
                              <h6>Product Description</h6>
                              <p><?= $row["ProInfo"] ?></p>
                           </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                           <div class="product__details__tab__desc">
                              <h6>Total Product Reviews </h6>
                              <?php if ($count > 0) { ?>
                                 <div class="rating-summary">
                                    <div class="average-rating">
                                       <span class="rating"><?php echo $averageRating; ?></span>
                                       <span class="outof5">out of 5</span>
                                       <div class="total-count">
                                          <?php echo $totalRatings; ?> Ratings
                                       </div>
                                    </div>
                                    <ul class="bar-chart">
                                       <li>
                                          <span class="star">5 star:</span>
                                          <div class="bar-container">
                                             <div class="bar" style="width: <?php echo ($star5Count / $totalRatings) * 100; ?>%"></div>
                                          </div>
                                          <span class="count"><?php echo $star5Count; ?></span>
                                       </li>
                                       <li>
                                          <span class="star">4 star:</span>
                                          <div class="bar-container">
                                             <div class="bar" style="width: <?php echo ($star4Count / $totalRatings) * 100; ?>%"></div>
                                          </div>
                                          <span class="count"><?php echo $star4Count; ?></span>
                                       </li>
                                       <li>
                                          <span class="star">3 star:</span>
                                          <div class="bar-container">
                                             <div class="bar" style="width: <?php echo ($star3Count / $totalRatings) * 100; ?>%"></div>
                                          </div>
                                          <span class="count"><?php echo $star3Count; ?></span>
                                       </li>
                                       <li>
                                          <span class="star">2 star:</span>
                                          <div class="bar-container">
                                             <div class="bar" style="width: <?php echo ($star2Count / $totalRatings) * 100; ?>%"></div>
                                          </div>
                                          <span class="count"><?php echo $star2Count; ?></span>
                                       </li>
                                       <li>
                                          <span class="star">1 star:</span>
                                          <div class="bar-container">
                                             <div class="bar" style="width: <?php echo ($star1Count / $totalRatings) * 100; ?>%"></div>
                                          </div>
                                          <span class="count"><?php echo $star1Count; ?></span>
                                       </li>
                                    </ul>
                                 </div>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                           <div class="product__details__tab__desc">
                              <h6>Product Reviews</h6>
                              <div class="comments-container">
                                 <?php
                                 foreach ($reviews as $key => $review) { ?>
                                    <ul class="comments-list">
                                       <li class="comment">
                                          <div class="comment-content">
                                             <h1 class="comment-author"><?= $review['CusName'] ?></h1>
                                             <?php
                                             $rating = 0;
                                             $rating = $review['Star'];
                                             for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                   echo '<span class="fa fa-star checked"></span>';
                                                } else {
                                                   echo '<span class="fa fa-star" style="color:gray"></span>';
                                                }
                                             }
                                             ?>
                                             <p class="comment-text"><?= $review['ComDate'] ?></p>
                                             <p class="comment-text" style="color:black"><?= $review['ComContent'] ?></p>
                                          </div>
                                       </li>
                                    </ul>
                                 <?php
                                 } ?>
                              </div>
                              <?php
                              if (isset($_SESSION['cusid'])) {
                              ?>
                                 <form action="shop-details.php" method="get">
                                    <div class="rating-container">
                                       <h5>Tap to Rate:</h5>
                                       <div class="rating">
                                          <input type="radio" id="star5" name="rating" value="5">
                                          <label for="star5"></label>
                                          <input type="radio" id="star4" name="rating" value="4">
                                          <label for="star4"></label>
                                          <input type="radio" id="star3" name="rating" value="3">
                                          <label for="star3"></label>
                                          <input type="radio" id="star2" name="rating" value="2">
                                          <label for="star2"></label>
                                          <input type="radio" id="star1" name="rating" value="1">
                                          <label for="star1"></label>
                                       </div>
                                    </div>
                                    <div class="comment-box">
                                       <input type="hidden" name="proid" value="<?= $_GET["ProID"] ?>" />
                                       <textarea id="comment-input" placeholder="Enter your comment!" name="comment"></textarea>
                                       <button id="submit-button">Send</button>
                                    </div>
                                 </form>
                              <?php } else {
                                 echo '<br>';
                                 echo '<div class="notification" style>Vui lòng đăng nhập để có thể review sản phẩm!!!</div>';
                              } ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Product Details Section End -->

      <!-- Related Product Section Begin -->
      <section class="featured spad">
         <div class="container text-center">
            <div class="row">
               <div class="col-lg-12">
                  <div class="section-title">
                     <h4>Related Products</h4>
                  </div>
               </div>
            </div>
            <div class="row featured__filter">
               <?php
               $sql_related = mysqli_query($con, "SELECT DISTINCT * FROM `product` WHERE `ProID` != '$ProID' AND `BraID` = '$BraID' limit 5");
               while ($row_related = mysqli_fetch_array($sql_related)) {
               ?>
                  <div class="col-lg-3 col-md-4 col-sm-4 product-box">
                     <div class="featured__item">
                        <a href="shop-details.php?ProID=<?php echo $row_related['ProID']; ?> ">
                           <div class="featured__item__pic">
                              <div class="container-zoom">
                                 <img src="img/all/<?php echo $row_related['ProPicture'] ?>" alt="" class="zoom-img">
                              </div>
                        </a>
                     </div>
                     <div class="featured__item__text">
                        <h6><a href="shop-details.php?ProID=<?php echo $row_related['ProID']; ?>"><?php echo $row_related['ProName'] ?></a></h6>
                        <h5><?php echo number_format($row_related['ProPrice']) ?>₫
                           <span class="text1"><s><?php echo number_format($row_related['ProBasisPrice']) ?>₫</s></span>
                        </h5>
                     </div>
                  </div>
            </div>
         <?php
               }
         ?>

      </section>
      <!-- Related Product Section End -->
      <div class="modal fade " id="login" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header d-flex justify-content-center">
                  <h4 class="modal-title">Đăng Nhập</h4>
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button> -->
               </div>
               <div class="modal-body">

                  <form method="post" action="#">
                     <!-- Email input -->
                     <div class="form-outline mb-4">
                        <input type="text" id="form2Example1" class="form-control" placeholder="Email address" name="txtuser" />
                        <!-- <label class="form-label" for="form2Example1">Email address</label> -->
                     </div>

                     <!-- Password input -->
                     <div class="form-outline mb-4">
                        <input type="password" id="form2Example2" class="form-control" placeholder="Password" name="txtpass" />
                        <!-- <label class="form-label" for="form2Example2">Password</label> -->
                     </div>

                     <!-- 2 column grid layout for inline styling -->
                     <div class="row mb-4">
                        <div class="col d-flex justify-content-center">

                           <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                              <label class="form-check-label" for="form2Example31"> Remember me </label>
                           </div>
                        </div>

                        <div class="col">
                           <!-- Simple link -->
                           <a href="#!" style="color: #cc9966;">Forgot password?</a>
                        </div>
                     </div>

                     <!-- Submit button -->
                     <button type="submit" class="btn btn-block mb-4 btn-signin">Sign in</button>

                     <!-- Register buttons -->
                     <div class="text-center">
                        <p>Not a member? <a href="#!" style="color: #cc9966;">Register</a></p>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   <?php
   }
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
<?php $con->close() ?>