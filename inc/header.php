<header class="header-main_area bg--sapphire">
            <div class="header-top_area d-lg-block d-none">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-7 col-lg-8">
                            <div class="main-menu_area position-relative">
                                <nav class="main-nav">
                                    <ul>
                                        <li class="dropdown-holder active"><a href="index.php">Accueil</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div class="col-xl-5 col-lg-4">
                            <div class="ht-right_area">
                                <div class="ht-menu">
                                    <ul>
                                        <?php if ($logged): ?>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="fa fa-user"></span>
                                                    <span><?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?></span>
                                                    <i class="fa fa-chevron-down"></i>
                                                </a>
                                                <ul class="ht-dropdown ht-my_account">
                                                    <?php if ($role === 'admin'): ?>
                                                        <li><a href="admin_dashboard.php">Dashboard Admin</a></li>
                                                    <?php else: ?>
                                                        <li><a href="dashboard.php">Mon espace</a></li>
                                                    <?php endif; ?>
                                                    <li><a href="logout.php">Se déconnecter</a></li>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                            <li><a href="login.php">Se connecter</a></li>
                                            <li><a href="register.php">S'inscrire</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="header-top_area header-sticky bg--sapphire">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-8 col-lg-7 d-lg-block d-none">
                            <div class="main-menu_area position-relative">
                                <nav class="main-nav">
                                    <ul>
                                        
                                        
                                     
                                        <li class=""><a href="index.php">Accueil </a>
                                            
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-sm-3 d-block d-lg-none">
                            <div class="header-logo_area header-sticky_logo">
                                <a href="">
                                    <img src="assets/images/menu/logo/1.png" alt="Uren's Logo">
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
                                    
                                    <!--<li class="contact-us_wrap">
                                        <a href="tel://+221766487420"><i class="ion-android-call"></i>+221 76 648 74 20</a>
                                    </li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle_area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="custom-logo_col col-12">
                            <div class="header-logo_area">
                                <a href="">
                                    <img src="assets/images/menu/logo/logo-transparent-png.png" alt="Logo">
                                </a>
                            </div>
                        </div>
                        <div class="custom-category_col col-12">
                            <div class="category-menu category-menu-hidden">
                                <div class="category-heading">
                                    <h2 class="categories-toggle">
                                        <span></span>
                                        <span>Mon Compte</span>
                                    </h2>
                                </div>
                                <div id="cate-toggle" class="category-menu-list">
                                    <ul>
                                        
                                        <?php if ($logged): ?>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="fa fa-user"></span>
                                                    <span><?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?></span>
                                                    <i class="fa fa-chevron-down"></i>
                                                </a>
                                                <ul class="ht-dropdown ht-my_account">
                                                    <?php if ($role === 'admin'): ?>
                                                        <li><a href="admin_dashboard.php">Dashboard Admin</a></li>
                                                    <?php else: ?>
                                                        <span class="fa fa-user"></span>
                                                        <li><a href="dashboard.php"><span>Mon espace</span></a></li>
                                                    <?php endif; ?>
                                                    <span class="fa fa-user"></span>
                                                    <li><a href="logout.php"><span>Se déconnecter</span></a></li>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                            <li><a href="login.php">Se connecter</a></li>
                                            <li><a href="register.php">S'inscrire</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="custom-search_col col-12">
                            <div class="hm-form_area">
                                <form action="#" class="hm-searchbox">
                                    <select class="nice-select select-search-category">
                                        <option value="0">All Categories</option>
                                        <option value="10">Laptops</option>
                                    </select>
                                    <input type="text" placeholder="Enter your search key ...">
                                    <button class="header-search_btn" type="submit"><i
                                        class="ion-ios-search-strong"><span>Search</span></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="custom-cart_col col-12">
                            <div class="header-right_area">
                                <ul>
                                    <li class="mobile-menu_wrap d-flex d-lg-none">
                                        <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white">
                                            <i class="ion-navicon"></i>
                                        </a>
                                    </li>
                                    
                                    <!--<li class="contact-us_wrap">
                                        <a href="tel://+221766487420"><i class="ion-android-call"></i>+221 76 648 74 20</a>
                                    </li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mobile-menu_wrapper" id="mobileMenu">
                <div class="offcanvas-menu-inner">
                    <div class="container">
                        <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                        <!--<div class="offcanvas-inner_search">
                            <form action="#" class="inner-searchbox">
                                <input type="text" placeholder="Search for item...">
                                <button class="search_btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>-->
                        <nav class="offcanvas-navigation">
                            <ul class="mobile-menu">
                               <?php if ($logged): ?>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <span class="fa fa-user"></span>
                                                    <span><?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?></span>
                                                    <i class="fa fa-chevron-down"></i>
                                                </a>
                                                <ul class="ht-dropdown ht-my_account">
                                                    <?php if ($role === 'admin'): ?>
                                                        <li><a href="admin_dashboard.php"><span class="mm-text">Dashboard Admin</span></a></li>
                                                    <?php else: ?>
                                                        <li><a href="dashboard.php"><span class="mm-text">Mon espace</span></a></li>
                                                    <?php endif; ?>
                                                    <li><a href="logout.php"><span class="mm-text">Se déconnecter</span></a></li>
                                                </ul>
                                            </li>
                                        <?php else: ?>
                                            <li><a href="login.php"><span class="mm-text">Se connecter</span></a></li>
                                            <li><a href="register.php"><span class="mm-text">S'inscrire</span></a></li>
                                        <?php endif; ?>
                                
                                
                                    </ul>
                        </nav>
                        <!--<nav class="offcanvas-navigation user-setting_area">
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children active"><a href="javascript:void(0)"><span
                                        class="mm-text">User
                                        Setting</span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="">
                                                <span class="mm-text">My Account</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span class="mm-text">Login | Register</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                
                                
                            </ul>
                        </nav>-->
                    </div>
                </div>
            </div>
        </header>