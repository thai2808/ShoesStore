<?php
session_start();
include_once('connect.php');
$param = "";

//sap xep
$order = "";
$sortparam = "";
$orderfield = isset($_GET["field"]) ? $_GET["field"] : "";
$ordersort = isset($_GET["sort"]) ? $_GET["sort"] : "";
if (!empty($orderfield) && !empty($ordersort)) {
   $order = "ORDER BY product." . $orderfield . "   " . $ordersort;
   $param .= "field=" . $orderfield . "&sort=" . $ordersort . "&";
   // var_dump($order);
}
// ------------------------Phan trang------------------- //
$limit = !empty($_GET['limit']) ? $_GET['limit'] : 8;
$current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $limit;
// ------------------------Phan trang------------------- //
// ------------------------Hien Thi San Pham------------------- //
if (isset($_GET['CateID']) && isset($_GET['BraID'])) {
   $cid = $_GET['CateID'];
   $bid = $_GET['BraID'];
   $param .= "CateID=" . $_GET['CateID'] . "&BraID=" . $_GET['BraID'];
   $sql = "Select * from product WHERE product.CateID ='$cid' and product.BraID='$bid' " . $order . " Limit " . $limit . " offset " . $offset;
   // var_dump($sql);
   $result = $con->query($sql) or die($con->error);
   $total_sql = "Select * from product WHERE product.CateID ='$cid' and product.BraID='$bid' " . $order;
   $total = $con->query($total_sql);
} elseif (isset($_GET['CateID'])) {
   $cid = $_GET['CateID'];
   $param .= "CateID=" . $_GET['CateID'];
   $sql = "SELECT * FROM `product` WHERE CateID = '$cid'" . $order . " Limit " . $limit . " offset " . $offset;
   // var_dump($sql);
   $result = $con->query($sql) or die($con->error);
   $total_sql = "Select * from product WHERE product.CateID ='$cid'";
   $total = $con->query($total_sql);
} else {
   if (isset($_GET['BraID'])) {
      $bid = $_GET['BraID'];
      $param .= "BraID=" . $_GET['BraID'];
      $sql = "SELECT * FROM `product` WHERE BraID =  '$bid' "  . $order . " Limit " . $limit . " offset " . $offset;
      // var_dump($sql);
      $result = $con->query($sql) or die($con->error);
      $total_sql = "Select * from product WHERE product.BraID='$bid'";
      $total = $con->query($total_sql);
   }
}
// ------------------------Hien Thi San Pham------------------- //

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
   <!-- <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet"> -->

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
<?php
if (isset($_GET['Category'])) {
?>
   <style>
   .header__menu ul li a.sale {
         color: #cc9966;
      }
   </style>
<?php } ?>

<body>
   <div id="preloder">
      <div class="loader"></div>
   </div>
   <!-- Header Section Begin -->
   <?php include('include/header.php') ?>
   <!-- Header Section End -->

   <!-- Hero Section Begin -->
   <?php
   include('include/categories-search.php');
   ?>
   <!-- Hero Section End -->

   <!-- Breadcrumb Section Begin -->
   <section class="breadcrumb-section set-bg" data-setbg="img/tp229-blogbanner-05-452.jpg">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center">
               <div class="breadcrumb__text">
                  <h2>Shoes Shop</h2>
                  <div class="breadcrumb__option">
                     <a href="./index.php">Home</a>
                     <span>Shop/</span>
                     <?php
                     if (isset($_GET['CateID'])) {
                        $cid = $_GET['CateID'];
                        $sql1 = "Select * from categories where CateID = '$cid'";
                        $result1 = $con->query($sql1) or die($con->error);
                        while ($row = $result1->fetch_assoc()) {
                           echo "<span>" . $row['CateName'] . "/</span>";
                        }
                        if (isset($_GET['BraID'])) {
                           $bid = $_GET['BraID'];
                           $sql1 = "Select * from brand where BraID = '$bid'";
                           $result1 = $con->query($sql1) or die($con->error);
                           while ($row = $result1->fetch_assoc()) {
                              echo "<span>" . $row['BraName'] . "</span>";
                           }
                        }
                     } elseif (isset($_GET['BraID'])) {
                        $bid = $_GET['BraID'];
                        $sql1 = "Select * from brand where BraID = '$bid'";
                        $result1 = $con->query($sql1) or die($con->error);
                        while ($row = $result1->fetch_assoc()) {
                           echo "<span>" . $row['BraName'] . "</span>";
                        }
                     }
                     ?>
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
   } elseif (isset($_GET['Category'])) { ?>
      <section class="featured spad">
         <div class="container text-center">
            <div class="row">
               <div class="col-lg-12">
                  <div class="section-title">
                     <h4>Sản Phẩm Sale</h4>
                  </div>
               </div>
            </div>
            <div class="row featured__filter">
               <?php
               $sql_product = mysqli_query($con, 'SELECT * FROM `product` WHERE ProBasisPrice > 0');
               while ($row_product = mysqli_fetch_array($sql_product)) {
               ?>
                  <div class="col-lg-3 col-md-4 col-sm-4 product-box">
                     <div class="featured__item">
                        <div class="featured__item__pic">
                           <a href='shop-details.php?ProID=<?php echo $row_product['ProID']; ?> '>
                              <div class="container-zoom">
                                 <img src="img/all/<?php echo $row_product['ProPicture'] ?>" alt="" class="zoom-img">
                              </div>
                              <span class="badge bg-danger dis">-<?php echo round((($row_product['ProBasisPrice'] - $row_product['ProPrice']) / $row_product['ProBasisPrice']) * 100) ?>%</span>

                           </a>
                        </div>
                        <div class="featured__item__text">
                           <h6><a href="#"><?php echo $row_product['ProName'] ?></a></h6>
                           <h5><?php echo number_format($row_product['ProPrice']) ?>₫
                              <span class="text1"><s><?php echo number_format($row_product['ProBasisPrice']) ?>₫</s></span>
                           </h5>
                        </div>
                     </div>
                  </div>
               <?php
               }
               ?>
      </section>
   <?php
   } else {
   ?>


      <!-- Product Section Begin -->
      <section class="product spad">
         <div class="container">
            <div class="row">
               <div class="col-lg-3 col-md-5">
                  <div class="sidebar">
                     <!-- ----------- Chon Brand khi đã có Cate --------- -->
                     <div class="sidebar__item">
                        <h4>Thương Hiệu</h4>
                        <ul>
                           <?php
                           $braid = isset($_GET["BraID"]) ? $_GET["BraID"] : "";
                           if (isset($_GET['CateID'])) {
                              $cid = $_GET['CateID'];
                              $brasql = "Select * from brand ";
                              $rs = $con->query($brasql) or die($con->error);
                              while ($row = $rs->fetch_assoc()) {
                                 if ($braid != $row['BraID']) {
                           ?>
                                    <li>
                                       <input type="checkbox" name="brand" value="CateID=<?= $cid ?>&BraID=<?= $row['BraID'] ?>" onchange="handleCheckboxChange(this)">
                                       <a><?= $row['BraName'] ?></a>
                                    </li>
                                 <?php
                                 } else {
                                 ?>
                                    <input type="checkbox" name="brand" checked>
                                    <a><?= $row['BraName'] ?></a>
                           <?php
                                 }
                              }
                           }
                           ?>
                        </ul>
                     </div>
                     <!-- ----------- Chon Brand khi đã có Cate --------- -->
                     <!-- ------------ Chọn khoảng giá của sản phẩm------------- -->
                     <div class="sidebar__item">
                        <h4>Price</h4>
                        <div class="price-range-wrap">
                           <div id="myRange" class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="500000" data-max="6000000" oninput="updateURL()">
                              <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                              <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                              <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                           </div>
                           <div class="range-slider">
                              <div class="price-input">
                                 <input type="text" id="minamount">
                                 <input type="text" id="maxamount">
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- ------------ Chọn khoảng giá của sản phẩm------------- -->
                     <!-- <div class="sidebar__item">
                     <h4>Popular Size</h4>
                     <div class="sidebar__item__size">
                        <label for="large">
                           Large
                           <input type="radio" id="large">
                        </label>
                     </div>
                     <div class="sidebar__item__size">
                        <label for="medium">
                           Medium
                           <input type="radio" id="medium">
                        </label>
                     </div>
                     <div class="sidebar__item__size">
                        <label for="small">
                           Small
                           <input type="radio" id="small">
                        </label>
                     </div>
                     <div class="sidebar__item__size">
                        <label for="tiny">
                           Tiny
                           <input type="radio" id="tiny">
                        </label>
                     </div>
                  </div> -->
                  </div>
               </div>
               <div class="col-lg-9 col-md-7">

                  <div class="filter__item">
                     <div class="row">
                        <div class="col-lg-4 col-md-5">
                           <div class="filter__sort">
                              <span>Sort By</span>
                              <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                 <option value="">Default</option>
                                 <option value="?<?= $param ?>&field=ProPrice&sort=asc">Price Thấp - Cao</option>
                                 <option value="?<?= $param ?>&field=ProPrice&sort=DESC">Price Cao - Thấp</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                           <div class="filter__found">
                              <!-- <h6><span>16</span> Products found</h6> -->
                           </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                           <div class="filter__option">
                              <span class="icon_grid-2x2"></span>
                              <span class="icon_ul"></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- --------------- Chọn Kiểu Sắp xếp sản phẩm ------------ -->
                  <!-- ------------------San Pham--------------- -->
                  <div>
                     <div class="row featured__filter">
                        <?php
                        if ($result->num_rows > 0) {
                           while ($row = $result->fetch_assoc()) {
                        ?>
                              <div class="col-lg-3 col-md-4 col-sm-6">
                                 <div class="featured__item">
                                    <a href='shop-details.php?ProID=<?php echo $row['ProID']; ?> '>
                                       <div class="featured__item__pic">
                                          <div class="container-zoom">
                                             <img src="img/all/<?php echo $row['ProPicture'] ?>" alt="" class="zoom-img">
                                          </div>
                                       </div>
                                    </a>
                                    <div class="featured__item__text">
                                       <h6><a href="#"><?php echo $row['ProName'] ?></a></h6>
                                       <h5><?php echo number_format($row['ProPrice']) ?>₫
                                          <?php if ($row['ProBasisPrice'] > 0) { ?>
                                             <span class="text1"><s><?php echo number_format($row['ProBasisPrice']) ?>₫</s></span>
                                          <?php } ?>
                                       </h5>
                                    </div>
                                 </div>
                              </div>
                        <?php
                           }
                        }
                        ?>
                     </div>
                  </div>
                  <!-- ------------------San Pham--------------- -->
                  <!-- ------------------Phan trang--------------- -->
                  <div class="product__pagination">
                     <?php if ($current_page > 1) {
                        $prevpage = $current_page - 1;
                     ?>
                        <a href="?<?= $param ?>&limit=<?= $limit ?>&page=<?= $prevpage ?>"><i class="fa fa-long-arrow-left"></i></a>
                     <?php } ?>
                     <?php $total = $total->num_rows;
                     // var_dump($total);
                     $totalpage = ceil($total / $limit);
                     for ($num = 1; $num <= $totalpage; $num++) { ?>
                        <?php if ($current_page != $num) { ?>
                           <a href="?<?= $param ?>&limit=<?= $limit ?>&page=<?= $num ?>"><?= $num ?></a>
                        <?php } else { ?>
                           <a style="background-color: #cc9966;color:white"><?= $num ?></a>
                        <?php } ?>
                     <?php } ?>
                     <?php if ($current_page <= $totalpage - 1) {
                        $nextpage = $current_page + 1;
                     ?>
                        <a href="?<?= $param ?>&limit=<?= $limit ?>&page=<?= $nextpage ?>"><i class="fa fa-long-arrow-right"></i></a>
                     <?php } ?>
                  </div>
                  <!-- ------------------Phan trang--------------- -->
               </div>
            </div>
         </div>
      </section>
      <!-- Product Section End -->

      <!-- Footer Section Begin -->
   <?php
   }
   include("include/footer.php");
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
   <script src="js/tesst.js"></script>



</body>

</html>