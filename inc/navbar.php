<?php
// inc/navbar.php
// Session déjà démarrée dans header.php
$logged = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? '';
$role = $_SESSION['role'] ?? '';
?>
<header class="header-main_area header-main_area-2 header-main_area-3">
  <div class="header-middle_area">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-xl-3 col-lg-2 col-md-3 col-sm-5">
          <div class="header-logo_area">
            <a href="/index.php">
              <img src="/assets/images/menu/logo/2.png" alt="AutoMarket Logo" style="max-height:60px">
            </a>
          </div>
        </div>

        <div class="col-xl-5 col-lg-6 d-none d-lg-block">
          <div class="hm-form_area">
            <form action="/products.php" method="get" class="hm-searchbox">
              <select class="nice-select select-search-category" name="category_id">
                <option value="">Toutes catégories</option>
                <!-- Option dynamique possible -->
              </select>
              <input type="text" name="search" placeholder="Rechercher une annonce...">
              <button class="header-search_btn" type="submit"><i class="ion-ios-search-strong"><span>Search</span></i></button>
            </form>
          </div>
        </div>

        <div class="col-lg-4 col-md-9 col-sm-7">
          <div class="header-right_area text-end">
            <ul style="list-style:none; margin:0; padding:0;">
              <li style="display:inline-block; margin-right:12px;">
                <a href="/products.php">Annonces</a>
              </li>

              <?php if ($logged): ?>
                <li style="display:inline-block; margin-right:12px;">
                  <a href="/dashboard.php">Bonjour <?= htmlspecialchars($username) ?></a>
                </li>

                <?php if ($role === 'admin'): ?>
                  <li style="display:inline-block; margin-right:12px;">
                    <a href="/admin_dashboard.php" class="text-warning">Admin</a>
                  </li>
                <?php endif; ?>

                <li style="display:inline-block;">
                  <a href="/logout.php" style="color:#d9534f;">Déconnexion</a>
                </li>
              <?php else: ?>
                <li style="display:inline-block; margin-right:12px;">
                  <a href="/login.php">Connexion</a>
                </li>
                <li style="display:inline-block;">
                  <a href="/register.php" class="btn btn-sm btn-success">Inscription</a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
