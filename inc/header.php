<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
include './lib/session.php';
Session::init();
include_once('lib/database.php');
include_once('helpers/format.php');
$db = new Database();
$fm = new Format();
spl_autoload_register(function ($class) {
    include_once "classes/" . $class . ".php";
});
$ct = new cart();
$us = new user();
$cat = new category();
$cs = new customer();
$product = new product();
if (isset($_GET['logout']) && $_GET['logout'] == true) {
    unset($_SESSION['customer']);
    echo "<script>window.location='login.php'</script>";
}
?>
<!DOCTYPE HTML>

<head>
    <title>Store Website</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
    <script src="js/jquerymain.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/nav.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/nav-hover.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
        $(document).ready(function($) {
            $('#dc_mega-menu-orange').dcMegaMenu({
                rowItems: '4',
                speed: 'fast',
                effect: 'fade'
            });
        });
    </script>
</head>

<body>
    <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="" /></a>
            </div>
            <div class="header_top_right">
                <div class="search_box">
                    <form action="search.php" method="POST">
                        <input type="text" name="keyword" placeholder="Search for Products">
                        <input type="submit" value="SEARCH">
                    </form>
                </div>
                <div class="shopping_cart">
                    <div class="cart">
                        <a href="cart.php" title="View my shopping cart" rel="nofollow">
                            <span class="cart_title">Cart</span>
                            <span class="no_product">
                                (<?php
                                    if (isset($_SESSION['cart'])) {
                                        echo count($_SESSION['cart']) . ' sản phẩm';
                                    } else {
                                        echo '0 sản phẩm';
                                    }
                                    ?>)
                            </span>
                        </a>
                    </div>
                </div>
                <div class="login">
                    <?php
                    if (!isset($_SESSION['customer'])) {
                        echo "<a href='login.php'>Login</a>";
                    } else {
                        echo "<a href='?logout=true'>Logout</a>";
                    }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="menu">
            <ul id="dc_mega-menu-orange" class="dc_mm-orange">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="topbrands.php">Top Brands</a></li>
                <?php
                if (isset($_SESSION['customer'])) {
                    echo "<li><a href='profile.php'>Profile</a></li>";
                    echo "<li><a href='order.php'>Your ORDER</a></li>";
                }
                ?>
                <li><a href="contact.php">Contact</a></li>
                <div class="clear"></div>
            </ul>
        </div>