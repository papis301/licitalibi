<?php
session_start();

// Données de session
$logged = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? '';
$phone = $_SESSION['phone'] ?? '';
$role = $_SESSION['role'] ?? '';

// Comme on n'utilise pas d'includes, définir $baseUrl pour les assets (ajuste si nécessaire)
$baseUrl = '.';
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Auto Market - Accueil</title>

  <!-- Exemples de CSS nécessaires (ajuste/ajoute selon ton thème) -->
  <!-- HEAD : CSS -->
<link rel="stylesheet" href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/css/vendor/bootstrap.min.css">
<link rel="stylesheet" href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/css/plugins/nice-select.css">
<link rel="stylesheet" href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/css/vendor/ion-fonts.css">
<link rel="stylesheet" href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/css/style.css">
<meta name="viewport" content="width=device-width,initial-scale=1">
</head>
<body>

<!-- Begin Uren's Header Main Area -->
<header class="header-main_area header-main_area-2 header-main_area-3">
    <div class="header-middle_area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-2 col-md-3 col-sm-5">
                    <div class="header-logo_area">
                        <a href="index.php">
                            <img src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/images/menu/logo/2.png" alt="Uren's Logo">
                        </a>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 d-none d-lg-block">
                    <div class="hm-form_area">
                        <form action="#" class="hm-searchbox">
                            <select class="nice-select select-search-category">
                                <option value="0">All Categories</option>
                                <option value="10">Laptops</option>
                                <option value="17">Prime Video</option>
                                <option value="20">All Videos</option>
                                <option value="21">Blouses</option>
                                <option value="22">Evening Dresses</option>
                                <option value="23">Summer Dresses</option>
                                <option value="24">T-shirts</option>
                                <option value="25">Rent or Buy</option>
                                <option value="26">Your Watchlist</option>
                                <option value="27">Watch Anywhere</option>
                                <option value="28">Getting Started</option>
                                <option value="18">Computers</option>
                                <option value="29">More to Explore</option>
                                <option value="30">TV &amp; Video</option>
                                <option value="31">Audio &amp; Theater</option>
                                <option value="32">Camera, Photo </option>
                                <option value="33">Cell Phones</option>
                                <option value="34">Headphones</option>
                                <option value="35">Video Games</option>
                                <option value="36">Wireless Speakers</option>
                                <option value="19">Electronics</option>
                                <option value="37">Amazon Home</option>
                                <option value="38">Kitchen &amp; Dining</option>
                                <option value="39">Furniture</option>
                                <option value="40">Bed &amp; Bath</option>
                                <option value="41">Appliances</option>
                                <option value="11">TV &amp; Audio</option>
                                <option value="42">Chamcham</option>
                                <option value="45">Office</option>
                                <option value="47">Gaming</option>
                                <option value="48">Chromebook</option>
                                <option value="49">Refurbished</option>
                                <option value="50">Touchscreen</option>
                                <option value="51">Ultrabooks</option>
                                <option value="52">Blouses</option>
                                <option value="43">Sanai</option>
                                <option value="53">Hard Drives</option>
                                <option value="54">Graphic Cards</option>
                                <option value="55">Processors (CPU)</option>
                                <option value="56">Memory</option>
                                <option value="57">Motherboards</option>
                                <option value="58">Fans &amp; Cooling</option>
                                <option value="59">CD/DVD Drives</option>
                                <option value="44">Meito</option>
                                <option value="60">Sound Cards</option>
                                <option value="61">Cases &amp; Towers</option>
                                <option value="62">Casual Dresses</option>
                                <option value="63">Evening Dresses</option>
                                <option value="64">T-shirts</option>
                                <option value="65">Tops</option>
                                <option value="12">Smartphone</option>
                                <option value="66">Camera Accessories</option>
                                <option value="68">Octa Core</option>
                                <option value="69">Quad Core</option>
                                <option value="70">Dual Core</option>
                                <option value="71">7.0 Screen</option>
                                <option value="72">9.0 Screen</option>
                                <option value="73">Bags &amp; Cases</option>
                                <option value="67">XailStation</option>
                                <option value="74">Batteries</option>
                                <option value="75">Microphones</option>
                                <option value="76">Stabilizers</option>
                                <option value="77">Video Tapes</option>
                                <option value="78">Memory Card Readers</option>
                                <option value="79">Tripods</option>
                                <option value="13">Cameras</option>
                                <option value="14">headphone</option>
                                <option value="15">Smartwatch</option>
                                <option value="16">Accessories</option>
                            </select>
                            <input type="text" placeholder="Enter your search key ...">
                            <button class="header-search_btn" type="submit"><i
                                class="ion-ios-search-strong"><span>Search</span></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-9 col-sm-7">
                    <div class="header-right_area">
                        <ul>
                            <li class="mobile-menu_wrap d-flex d-lg-none">
                                <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white">
                                    <i class="ion-navicon"></i>
                                </a>
                            </li>
                            <li class="minicart-wrap">
                                <a href="#miniCart" class="minicart-btn toolbar-btn">
                                    <div class="minicart-count_area">
                                        <span class="item-count">3</span>
                                        <i class="ion-bag"></i>
                                    </div>
                                    <div class="minicart-front_text">
                                        <span>Cart:</span>
                                        <span class="total-price">462.4</span>
                                    </div>
                                </a>
                            </li>
                            <li class="contact-us_wrap">
                                <a href="tel://+123123321345"><i class="ion-android-call"></i>+123 321 345</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-top_area bg--primary">
        <div class="container-fluid">
            <div class="row">
                <div class="custom-category_col col-12">
                    <div class="category-menu category-menu-hidden">
                        <div class="category-heading">
                            <h2 class="categories-toggle">
                                <span>Shop By</span>
                                <span>Department</span>
                            </h2>
                        </div>
                        <div id="cate-toggle" class="category-menu-list">
                            
                        </div>
                    </div>
                </div>
                <div class="custom-menu_col col-12 d-none d-lg-block">
                    <div class="main-menu_area position-relative">
                        <nav class="main-nav">
                            <ul>
                                <li class="dropdown-holder active"><a href="index.php">Home</a>
                                    <ul class="hm-dropdown">
                                        <li><a href="index.php">Home One</a></li>
                                        <li><a href="index-2.php">Home Two</a></li>
                                        <li><a href="index-3.php">Home Three</a></li>
                                    </ul>
                                </li>
                                <li class="megamenu-holder "><a href="shop-left-sidebar.php">Shop <i
                                        class="ion-ios-arrow-down"></i></a>
                                    <ul class="hm-megamenu">
                                        <li><span class="megamenu-title">Shop Page Layout</span>
                                            <ul>
                                                <li><a href="shop-grid-fullwidth.php">Grid Fullwidth</a></li>
                                                <li><a href="shop-left-sidebar.php">Left Sidebar</a></li>
                                                <li><a href="shop-right-sidebar.php">Right Sidebar</a></li>
                                                <li><a href="shop-list-fullwidth.php">List Fullwidth</a></li>
                                                <li><a href="shop-list-left-sidebar.php">List Left Sidebar</a>
                                                </li>
                                                <li><a href="shop-list-right-sidebar.php">List Right
                                                        Sidebar</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><span class="megamenu-title">Single Product Style</span>
                                            <ul>
                                                <li><a href="single-product-gallery-left.php">Gallery Left</a>
                                                </li>
                                                <li><a href="single-product-gallery-right.php">Gallery
                                                        Right</a>
                                                </li>
                                                <li><a href="single-product-tab-style-left.php">Tab Style
                                                        Left</a>
                                                </li>
                                                <li><a href="single-product-tab-style-right.php">Tab Style
                                                        Right</a>
                                                </li>
                                                <li><a href="single-product-sticky-left.php">Sticky Left</a>
                                                </li>
                                                <li><a href="single-product-sticky-right.php">Sticky Right</a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                    </ul>
                                </li>
                                
                                
                                
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="custom-setting_col col-12 d-none d-lg-block">
                    <div class="ht-right_area">
                        <div class="ht-menu">
                            <ul>
                                <li><a href="javascript:void(0)"><span>$</span> <span>Currency</span><i
                                        class="fa fa-chevron-down"></i></a>
                                    <ul class="ht-dropdown ht-currency">
                                        <li><a href="javascript:void(0)">€ EUR</a></li>
                                        <li class="active"><a href="javascript:void(0)">£ Pound Sterling</a></li>
                                        <li><a href="javascript:void(0)">$ Us Dollar</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)"><span><img src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/images/menu/icon/1.jpg"
                                            alt=""></span> <span>Language</span> <i
                                        class="fa fa-chevron-down"></i></a>
                                    <ul class="ht-dropdown">
                                        <li class="active"><a href="javascript:void(0)"><img src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/images/menu/icon/1.jpg" alt="JB's Language Icon">English</a></li>
                                        <li><a href="javascript:void(0)"><img src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/images/menu/icon/2.jpg" alt="JB's Language Icon">Français</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="my-account.php"><span class="fa fa-user"></span> <span>My
                                        Account</span><i class="fa fa-chevron-down"></i></a>
                                    <ul class="ht-dropdown ht-my_account">
                                        <li><a href="javascript:void(0)">Register</a></li>
                                        <li class="active"><a href="javascript:void(0)">Login</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="custom-search_col col-12 d-none d-md-block d-lg-none">
                    <div class="hm-form_area">
                        <form action="#" class="hm-searchbox">
                            <select class="nice-select select-search-category">
                                <option value="0">All Categories</option>
                                <option value="10">Laptops</option>
                                <option value="17">Prime Video</option>
                                <option value="20">All Videos</option>
                            </select>
                            <input type="text" placeholder="Enter your search key ...">
                            <button class="header-search_btn" type="submit"><i
                                class="ion-ios-search-strong"><span>Search</span></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-top_area header-sticky bg--primary">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-7 d-lg-block d-none">
                    <div class="main-menu_area position-relative">
                        <nav class="main-nav">
                            <ul>
                                <li class="dropdown-holder active"><a href="index.php">Home</a>
                                    <ul class="hm-dropdown">
                                        <li><a href="index.php">Home One</a></li>
                                        <li><a href="index-2.php">Home Two</a></li>
                                        <li><a href="index-3.php">Home Three</a></li>
                                    </ul>
                                </li>
                                <li class="megamenu-holder "><a href="shop-left-sidebar.php">Shop
                                        <i class="ion-ios-arrow-down"></i></a>
                                    <ul class="hm-megamenu">
                                        <li><span class="megamenu-title">Shop Page Layout</span>
                                            <ul>
                                                <li><a href="shop-grid-fullwidth.php">Grid Fullwidth</a></li>
                                                <li><a href="shop-left-sidebar.php">Left Sidebar</a></li>
                                                <li><a href="shop-right-sidebar.php">Right Sidebar</a></li>
                                                <li><a href="shop-list-fullwidth.php">List Fullwidth</a></li>
                                                <li><a href="shop-list-left-sidebar.php">List Left Sidebar</a>
                                                </li>
                                                <li><a href="shop-list-right-sidebar.php">List Right
                                                        Sidebar</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><span class="megamenu-title">Single Product Style</span>
                                            <ul>
                                                <li><a href="single-product-gallery-left.php">Gallery Left</a>
                                                </li>
                                                <li><a href="single-product-gallery-right.php">Gallery
                                                        Right</a>
                                                </li>
                                                <li><a href="single-product-tab-style-left.php">Tab Style
                                                        Left</a>
                                                </li>
                                                <li><a href="single-product-tab-style-right.php">Tab Style
                                                        Right</a>
                                                </li>
                                                <li><a href="single-product-sticky-left.php">Sticky Left</a>
                                                </li>
                                                <li><a href="single-product-sticky-right.php">Sticky Right</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><span class="megamenu-title">Single Product Type</span>
                                            <ul>
                                                <li><a href="single-product.php">Single Product</a></li>
                                                <li><a href="single-product-sale.php">Single Product Sale</a>
                                                </li>
                                                <li><a href="single-product-group.php">Single Product Group</a>
                                                </li>
                                                <li><a href="single-product-variable.php">Single Product
                                                        Variable</a>
                                                </li>
                                                <li><a href="single-product-affiliate.php">Single Product
                                                        Affiliate</a>
                                                </li>
                                                <li><a href="single-product-slider.php">Single Product
                                                        Slider</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)">Specials</a></li>
                                <li class=""><a href="javascript:void(0)">Pages <i
                                        class="ion-ios-arrow-down"></i></a>
                                    <ul class="hm-dropdown">
                                        <li><a href="my-account.php">My Account</a></li>
                                        <li><a href="login.php">Login | Register</a></li>
                                        <li><a href="wishlist.php">Wishlist</a></li>
                                        <li><a href="cart.php">Cart</a></li>
                                        <li><a href="checkout.php">Checkout</a></li>
                                        <li><a href="compare.php">Compare</a></li>
                                        <li><a href="faq.php">FAQ</a></li>
                                        <li><a href="404.php">404 Error</a></li>
                                    </ul>
                                </li>
                                <li class=""><a href="about-us.php">About Us</a></li>
                                <li class=""><a href="contact.php">Contact</a></li>
                                <li class=""><a href="blog-left-sidebar.php">Blog <i
                                        class="ion-ios-arrow-down"></i></a>
                                    <ul class="hm-dropdown">
                                        <li><a href="blog-left-sidebar.php">Grid View</a>
                                            <ul class="hm-dropdown hm-sub_dropdown">
                                                <li><a href="blog-2-column.php">Column Two</a></li>
                                                <li><a href="blog-3-column.php">Column Three</a></li>
                                                <li><a href="blog-left-sidebar.php">Left Sidebar</a></li>
                                                <li><a href="blog-right-sidebar.php">Right Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="blog-list-left-sidebar.php">List View</a>
                                            <ul class="hm-dropdown hm-sub_dropdown">
                                                <li><a href="blog-list-fullwidth.php">List Fullwidth</a></li>
                                                <li><a href="blog-list-left-sidebar.php">List Left Sidebar</a>
                                                </li>
                                                <li><a href="blog-list-right-sidebar.php">List Right
                                                        Sidebar</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="blog-details-left-sidebar.php">Blog Details</a>
                                            <ul class="hm-dropdown hm-sub_dropdown">
                                                <li><a href="blog-details-left-sidebar.php">Left Sidebar</a>
                                                </li>
                                                <li><a href="blog-details-right-sidebar.php">Right Sidebar</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="blog-gallery-format.php">Blog Format</a>
                                            <ul class="hm-dropdown hm-sub_dropdown">
                                                <li><a href="blog-gallery-format.php">Gallery Format</a></li>
                                                <li><a href="blog-audio-format.php">Audio Format</a></li>
                                                <li><a href="blog-video-format.php">Video Format</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-sm-3 d-block d-lg-none">
                    <div class="header-logo_area header-sticky_logo">
                        <a href="index.php">
                            <img src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/images/menu/logo/3.png" alt="Uren's Logo">
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-sm-9">
                    <div class="header-right_area">
                        <ul>
                            <li class="mobile-menu_wrap d-flex d-lg-none">
                                <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white">
                                    <i class="ion-navicon"></i>
                                </a>
                            </li>
                            <li class="minicart-wrap">
                                <a href="#miniCart" class="minicart-btn toolbar-btn">
                                    <div class="minicart-count_area">
                                        <span class="item-count">3</span>
                                        <i class="ion-bag"></i>
                                    </div>
                                    <div class="minicart-front_text">
                                        <span>Cart:</span>
                                        <span class="total-price">462.4</span>
                                    </div>
                                </a>
                            </li>
                            <li class="contact-us_wrap">
                                <a href="tel://+123123321345"><i class="ion-android-call"></i>+123 321 345</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Offcanvas minicart -->
    <div class="offcanvas-minicart_wrapper" id="miniCart">
        <div class="offcanvas-menu-inner">
            <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
            <div class="minicart-content">
                <div class="minicart-heading">
                    <h4>Shopping Cart</h4>
                </div>
                <ul class="minicart-list">
                    <li class="minicart-product">
                        <a class="product-item_remove" href="javascript:void(0)"><i
                            class="ion-android-close"></i></a>
                        <div class="product-item_img">
                            <img src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/images/product/small-size/1.jpg" alt="Uren's Product Image">
                        </div>
                        <div class="product-item_content">
                            <a class="product-item_title" href="shop-left-sidebar.php">Autem ipsa ad</a>
                            <span class="product-item_quantity">1 x $145.80</span>
                        </div>
                    </li>
                    <li class="minicart-product">
                        <a class="product-item_remove" href="javascript:void(0)"><i
                            class="ion-android-close"></i></a>
                        <div class="product-item_img">
                            <img src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/images/product/small-size/2.jpg" alt="Uren's Product Image">
                        </div>
                        <div class="product-item_content">
                            <a class="product-item_title" href="shop-left-sidebar.php">Tenetur illum amet</a>
                            <span class="product-item_quantity">1 x $150.80</span>
                        </div>
                    </li>
                    <li class="minicart-product">
                        <a class="product-item_remove" href="javascript:void(0)"><i
                            class="ion-android-close"></i></a>
                        <div class="product-item_img">
                            <img src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/images/product/small-size/3.jpg" alt="Uren's Product Image">
                        </div>
                        <div class="product-item_content">
                            <a class="product-item_title" href="shop-left-sidebar.php">Non doloremque placeat</a>
                            <span class="product-item_quantity">1 x $165.80</span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="minicart-item_total">
                <span>Subtotal</span>
                <span class="ammount">$462.4‬0</span>
            </div>
            <div class="minicart-btn_area">
                <a href="cart.php" class="uren-btn uren-btn_dark uren-btn_fullwidth">Minicart</a>
            </div>
            <div class="minicart-btn_area">
                <a href="checkout.php" class="uren-btn uren-btn_dark uren-btn_fullwidth">Checkout</a>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="mobile-menu_wrapper" id="mobileMenu">
        <div class="offcanvas-menu-inner">
            <div class="container">
                <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                <div class="offcanvas-inner_search">
                    <form action="#" class="inner-searchbox">
                        <input type="text" placeholder="Search for item...">
                        <button class="search_btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                    </form>
                </div>
                <nav class="offcanvas-navigation">
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children active"><a href="index.php"><span
                                class="mm-text">Home</span></a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="index.php">
                                        <span class="mm-text">Home One</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="index-2.php">
                                        <span class="mm-text">Home Two</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="index-3.php">
                                        <span class="mm-text">Home Three</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="shop-left-sidebar.php">
                                <span class="mm-text">Shop</span>
                            </a>
                            <ul class="sub-menu">
                                <li class="menu-item-has-children">
                                    <a href="shop-left-sidebar.php">
                                        <span class="mm-text">Grid View</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="shop-grid-fullwidth.php">
                                                <span class="mm-text">Column Three</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-4-column.php">
                                                <span class="mm-text">Column Four</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-left-sidebar.php">
                                                <span class="mm-text">Left Sidebar</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-right-sidebar.php">
                                                <span class="mm-text">Right Sidebar</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- ... (mobile menu items truncated for brevity) -->
                            </ul>
                        </nav>

                        <nav class="offcanvas-navigation user-setting_area">
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children active"><a href="javascript:void(0)"><span
                                        class="mm-text">User
                                        Setting</span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="my-account.php">
                                                <span class="mm-text">My Account</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="login.php">
                                                <span class="mm-text">Login | Register</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><a href="javascript:void(0)"><span
                                        class="mm-text">Currency</span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">EUR €</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">USD $</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><a href="javascript:void(0)"><span
                                        class="mm-text">Language</span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">English</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">Français</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">Romanian</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">Japanese</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Uren's Header Main Area -->

<main class="container mt-4">
  <h1>Auto Market</h1>

  <?php if ($logged): ?>
    <p>
      Bienvenue, <?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>
      (<?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') ?>)
    </p>

    <p>
        <a href="post_ad.php">Poster une annonce</a> |
        <?php if ($role === 'admin'): ?>
            <a href="admin_dashboard.php">Dashboard Admin</a> |
        <?php else: ?>
            <a href="dashboard.php">Dashboard</a> |
        <?php endif; ?>
        <a href="logout.php">Se déconnecter</a>
    </p>

  <?php else: ?>
    <p>
        <a href="login.php">Se connecter</a> ou
        <a href="register.php">S'inscrire</a>
    </p>
  <?php endif; ?>
</main>

<!-- Scripts JS : remplacer par ce bloc -->
<script src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/js/jquery.min.js"></script>
<script>
  // fallback CDN si jquery local ne charge pas
  if (typeof jQuery === 'undefined') {
    var s = document.createElement('script');
    s.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
    s.integrity = 'sha256-/xUj+3OJ+Y6qf2Q7G1T4u/6w5e0v3K5f5a1a8pYb4k=';
    s.crossOrigin = 'anonymous';
    document.head.appendChild(s);
    console.warn('jQuery local absent — fallback CDN chargé');
  }
</script>

<script src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/js/jquery.nice-select.min.js"></script>

<!-- Debug + initialisations (garder avant main.js pour corriger rapidement) -->
<script>
  // Debug simple
  console.log('DEBUG: scripts start');
  (function waitForjQuery(cb){
    if (typeof jQuery !== 'undefined') return cb();
    setTimeout(function(){ waitForjQuery(cb); }, 50);
  })(function(){
    console.log('jQuery version:', jQuery.fn && jQuery.fn.jquery ? jQuery.fn.jquery : 'inconnue');

    jQuery(function($){
      // Vérifier plugin niceSelect
      if ($.fn.niceSelect) {
        $('.select-search-category').niceSelect();
        console.log('niceSelect initialisé');
      } else {
        console.warn('niceSelect NON trouvé — vérifie assets/js/jquery.nice-select.min.js');
      }

      // Exemple d'init pour menu mobile / offcanvas (adapte selon ton HTML/CSS)
      $('.mobile-menu_btn').on('click', function(e){
        e.preventDefault();
        $('#mobileMenu').toggleClass('open');
        console.log('mobileMenu toggled');
      });

      // Minicart open/close
      $('.minicart-btn').on('click', function(e){
        e.preventDefault();
        $('#miniCart').toggleClass('open');
        console.log('minicart toggled');
      });

      // Vérif éléments trouvés
      console.log('.select-search-category count:', $('.select-search-category').length);
      console.log('.mobile-menu_btn count:', $('.mobile-menu_btn').length);
      console.log('.minicart-btn count:', $('.minicart-btn').length);
    });
  });
</script>

<!-- Ton main.js (doit être le dernier) -->
<!-- SCRIPTS : JS (placer juste avant </body>) -->

<!-- 1) jQuery local (si présent) -->
<script src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/js/vendor/jquery.min.js"></script>

<!-- 2) Fallback CDN si jQuery local absent (SANS attribut integrity pour éviter blocage) -->
<script>
  if (typeof jQuery === 'undefined') {
    var s = document.createElement('script');
    s.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
    s.crossOrigin = 'anonymous';
    document.head.appendChild(s);
    console.warn('jQuery local absent — fallback CDN chargé (sans SRI)');
  }
</script>

<!-- 3) bootstrap (local si tu l'as) -->
<script src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/js/vendor/bootstrap.bundle.min.js"></script>

<!-- 4) plugins (nice-select...) -->
<script src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/js/plugins/jquery.nice-select.min.js"></script>

<!-- 5) debug + init (garder avant main.js pour voir rapidement si jQuery/plugins sont OK) -->
<script>
  (function waitForjQuery(cb){
    if (typeof jQuery !== 'undefined') return cb();
    setTimeout(function(){ waitForjQuery(cb); }, 50);
  })(function(){
    console.log('DEBUG: jQuery version:', jQuery && jQuery.fn ? jQuery.fn.jquery : '(non detecté)');

    jQuery(function($){
      // init nice-select si dispo
      if ($.fn.niceSelect) {
        $('.select-search-category').niceSelect();
        console.log('niceSelect initialized');
      } else {
        console.warn('niceSelect non trouvé. Vérifie assets/js/plugins/jquery.nice-select.min.js');
      }

      // petits toggles utiles pour debug
      $('.mobile-menu_btn').on('click', function(e){ e.preventDefault(); $('#mobileMenu').toggleClass('open'); });
      $('.minicart-btn').on('click', function(e){ e.preventDefault(); $('#miniCart').toggleClass('open'); });

      console.log('.select-search-category count:', $('.select-search-category').length);
      console.log('.mobile-menu_btn count:', $('.mobile-menu_btn').length);
      console.log('.minicart-btn count:', $('.minicart-btn').length);
    });
  });
</script>

<!-- 6) main.js (toujours en dernier) -->
<script src="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/assets/js/main.js"></script></body>
</html>