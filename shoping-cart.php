<?php
session_start();
include_once('connect.php');
if (isset($_SESSION["login"]) && $_SESSION["login"] == TRUE) {
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}
if (!isset($_SESSION["size"])) {
    $_SESSION["size"] = array();
}
$successMessage = false;
$error = false;
if (isset($_GET['action'])) {
    function update_cart($add = false)
    {
        foreach ($_POST['quantity'] as $id => $quantity) {
            if ($quantity == 0) {
                unset($_SESSION["cart"][$id]);
               
            } else {
                if ($add) {
                    $_SESSION['cart'][$id] += $quantity;
                } else {
                    $_SESSION["cart"][$id] = $quantity;
                }
            }
        }
    }
    function update_size() {
        foreach ($_POST['size'] as $id => $size) {
            $_SESSION["size"][$id] = $size;
        }
    }
    switch ($_GET['action']) {
        case "add";
            update_cart(true);
            update_size();
            header('Location: shoping-cart.php');
            break;
        case "delete":
            if (isset($_GET['id'])) {
                unset($_SESSION["cart"][$_GET['id']]);
                unset($_SESSION["size"][$_GET['id']]);
            }
            header('Location: shoping-cart.php');
            break;
        case "submit";
            if (isset($_POST['update_click'])) {
                update_cart();
                update_size();
                header('Location: shoping-cart.php');
            } else if ($_POST['order_click']) {
                if (empty($_POST['name'])) {
                    $error = "You haven't entered the recipient's name!";
                } elseif (empty($_POST['phone'])) {
                    $error = "You haven't entered the recipient's phone!";
                } elseif (empty($_POST['address'])) {
                    $error = "You haven't entered the recipient's address!";
                } elseif (empty($_POST['paymethod'])) {
                    $error = "You haven't entered the payment method!";
                } else {
                    $quantityErrors = array();
                    foreach ($_POST['quantity'] as $id => $quantity) {
                        $product = mysqli_query($con, "SELECT * FROM product WHERE ProID = '$id'");
                        $row = mysqli_fetch_array($product);
                        if ($quantity > $row['ProNumber']) {
                            $quantityErrors[$id] = $row['ProName'];
                        }
                    }
                    if (!empty($quantityErrors)) {
                        $error = "The following products have quantity exceeding the available stock: " . "<br>";
                        foreach ($quantityErrors as $productId => $productName) {
                            $error .= $productName . "<br>";
                        }
                        $error = rtrim($error, "<br>");
                    } else {
                        if ($error == false && !empty($_POST['quantity'])) {
                            $total = 0;
                            $products = mysqli_query($con, "select * from product where ProID in (" . implode(",", array_keys($_POST['quantity'])) . ")");
                            $orders = array();
                            while ($row = mysqli_fetch_array($products)) {
                                $orders[] = $row;
                                $total += $row['ProPrice'] * $_POST['quantity'][$row['ProID']];
                            }
                            $insertOder = mysqli_query($con, "INSERT INTO `oders` (`OrdID`, `PayID`, `CusID`, `OrdStatus`, `OrdDate`, `OrdShipDate`, `OrdCustomer`, `OrdAdr`, `OrdPhone`,`Total`) VALUES (NULL, '" . $_POST['paymethod'] . "', '" . $_SESSION["cusid"] . "', '0', CURRENT_TIMESTAMP, DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 3 DAY),'" . $_POST['name'] . "', '" . $_POST['address'] . "', '" . $_POST['phone'] . "','" . $total . "');");
                            $orderID = $con->insert_id;
                            $insertString = "";
                            foreach ($orders as $key => $product) {
                                $insertString .= "('" . $orderID . "','" . $product['ProID'] . "','" . $_SESSION["size"][$product['ProID']] . "','" . $_POST['quantity'][$product['ProID']] . "','" . $product['ProPrice'] . "')";
                                if ($key != count($orders) - 1) {
                                    $insertString .= ",";
                                }
                                $newQuantity = $product['ProNumber'] - $_POST['quantity'][$product['ProID']];
                                $updateProduct = mysqli_query($con, "UPDATE `product` SET `ProNumber` = '" . $newQuantity . "' WHERE `ProID` = '" . $product['ProID'] . "';");
                            }
                            $insertOder = mysqli_query($con, "INSERT INTO `odersdetail` (`OrdID`, `ProID`,`Size`, `OrdQuantity`, `OrdPrice`) VALUES " . $insertString . ";");
                        }
                        unset($_SESSION["size"]);
                        unset($_SESSION["cart"]);
                        $successMessage = "Order successful! Thank you for your purchase!";
                    }
                }
                break;
            }
    }
}
if (!empty($_SESSION["cart"])) {
    $products = mysqli_query($con, "select * from product where ProID in (" . implode(",", array_keys($_SESSION["cart"])) . ")");
}
}
else{
   
   echo "<script>
   
       alert('Cần Đăng Nhập Để Xem Chi Tiết Giỏ Hàng');
   
</script>";
// header('Location: index.php');
}
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
    <link rel="stylesheet" href="css/shoping-cart.css" type="text/css">
</head>

<body>
    <?php if (!empty($error)) { ?>
        <div id="notify-msg"><?php echo $error ?>
            <br>
            <br>
            <a href="javascript:history.back()">Back</a>
        </div>
    <?php } elseif (!empty($successMessage)) { ?>
        <div class="success-message"><?php echo $successMessage ?>
            <br>
            <br>
            <a href="javascript:history.back()">Back</a>
        </div>
    <?php } else { ?>
        <?php
        include('include/header.php');
        ?>
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <?php

   include('include/categories-search.php');
   ?>
        <!-- Hero Section End -->
        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcrumb__text">
                            <h2>Shopping Cart</h2>
                            <div class="breadcrumb__option">
                                <a href="./index.php">Home</a>
                                <span>Shopping Cart</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Shoping Cart Section Begin -->
        <section class="shoping-cart spad">
            <div class="container">
                <form id="cart-form" action="shoping-cart.php?action=submit" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="shoping__product">Products</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($products)) {
                                            $total = 0;
                                            while ($row = mysqli_fetch_array($products)) { ?>
                                                <tr>
                                                    <td class="shoping__cart__item">
                                                        <img width="20%" src="img/all/<?= $row['ProPicture'] ?>" alt="">
                                                        <h5><?= $row['ProName'] ?></h5>
                                                        <h5 style="color: red; font-size:small">Size <?=$_SESSION["size"][$row['ProID']]?></h5>
                                                    </td>
                                                    <td class="shoping__cart__price">
                                                        <?= number_format($row['ProPrice'], 0, ",", ".") ?>đ
                                                    </td>
                                                    <td class="shoping__cart__quantity">
                                                        <div class="quantity">
                                                            <div class="pro-qty">
                                                                <input type="text" value="<?= $_SESSION["cart"][$row['ProID']] ?>" name="quantity[<?= $row['ProID'] ?>]">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="shoping__cart__total">
                                                        <?= number_format(($row['ProPrice'] * $_SESSION['cart'][$row['ProID']]), 0, ",", ".") ?>đ
                                                    </td>
                                                    <td class="shoping__cart__item__close">
                                                        <a class="" href="shoping-cart.php?action=delete&id=<?= $row['ProID'] ?>">Delete</a>
                                                    </td>
                                                </tr>
                                        <?php
                                                $total += $row['ProPrice'] * $_SESSION['cart'][$row['ProID']];
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($products)) { ?>
                        <div class="row">
                            <div class="col-lg-12" style="margin-bottom:50px">
                                <div class="shoping__cart__btns">
                                    <a href="index.php" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                                    <input type="submit" name="update_click" value="Upadate Cart" class="primary-btn cart-btn cart-btn-right" style="border: none">
                                </div>
                            </div>
                            <div class="col-lg-6 table-container">
                            <table class="form-table">
                                <tr>
                                    <td><label for="recipient">Recipient:</label></td>
                                    <td><input type="text" id="name" name="name"></td>
                                </tr>
                                <tr>
                                    <td><label for="phone">Phone Number:</label></td>
                                    <td><input type="text" id="phone" name="phone"></td>
                                </tr>
                                <tr>
                                    <td><label for="address">Address:</label></td>
                                    <td><input type="text" id="address" name="address"></td>
                                </tr>
                                <tr>
                                    <td><label>Payment methods:</label></td>
                                    <td>
                                        <div class="radio-option">
                                            <input type="radio" id="method1" name="paymethod" value="1">
                                            <label for="method1">Payment upon delivery</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="method2" name="paymethod" value="2">
                                            <label for="method2">Bank transfer</label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="shoping__checkout">
                                    <h5>Cart Total</h5>
                                    <ul>
                                        <li>Subtotal <span><?= number_format($total, 0, ",", ".") ?>đ</span></li>
                                        <li>Total <span><?= number_format($total, 0, ",", ".") ?>đ</span></li>
                                    </ul>
                                    <input type="submit" class="primary-btn" value="PROCEED TO CHECKOUT" name="order_click" style="border:none">
                                </div>
                            </div>

                        </div>
                    <?php } ?>
                </form>
            </div>
        </section>
        <?php
        include('include/footer.php');
        ?>
    <?php } ?>

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