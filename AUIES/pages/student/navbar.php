
<div class="horizontal-menu">
  <nav class="navbar top-navbar col-lg-12 col-12 p-0" style="background-color: #3e64ff !important;">
    <div class="container-fluid">
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
        <!-- title -->
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <img src="../../images/index.png" alt="logo" width="50px" height="50px" />
          <a class="navbar-brand brand-logo" href="index.html" style="color: white !important;">Admas University Instructor Evaluation system</a>
          <a class="navbar-brand brand-logo-mini" href="index.html" style="color: white !important;">AUIES</a>
        </div>

        <ul class="navbar-nav navbar-nav-right">
          <div class="nav-link">
            <a href="main.php" style="color: white !important;">
              <i class="mdi mdi-home-variant"></i>
            </a>
          </div>
          <li class="nav-item nav-profile dropdown">
            <!-- user image and name -->
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <span class="nav-profile-name" style="color: white !important;"><?php echo $_SESSION['Sname']; ?></span>
              <img src="../../images/av.png" alt="profile" />
            </a>

            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="manage_user.php" class="dropdown-item">
                <i class="mdi mdi-settings text-primary"></i>
                Manage Account
              </a>
              <a href="../../logout.php<?php echo '?logout'; ?>" class="dropdown-item">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>

          </li>
        </ul>
        <!-- navbar toggle button -->
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
          <span class="mdi mdi-menu"></span>
        </button>

      </div>
    </div>
  </nav>

  <nav class="bottom-navbar">
    <div class="container">
      <ul class="nav page-navigation">
        <li class="nav-item">
          <a href="evaluate.php" class="nav-link">
            <i class="mdi mdi-gavel menu-icon"></i>
            <span class="menu-title">Evaluate</span>
            <i class="menu-arrow"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
</div>