<nav class="navbar navbar-expand-lg bg-light shadow-sm p-3 mb-5 bg-body rounded">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo $rootPath ?>">
        <img src="https://wujiateavn.com/files/systems/logo-l6m1s0u2.png" alt="Logo" width="70" height="30" class="d-inline-block align-text-top">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?php echo $rootPath ?>">Trang chủ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $rootPath?>/report.php">Thống kê</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Quản lý
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo $rootPath?>/users/">Người dùng</a></li>
              <li><a class="dropdown-item" href="<?php echo $rootPath?>/posts/">Tin tức</a></li>
              <li><a class="dropdown-item" href="<?php echo $rootPath?>/products/">Sản phẩm</a></li>
              <li><a class="dropdown-item" href="<?php echo $rootPath?>/contacts/">Liên hệ</a></li>
              <li><a class="dropdown-item" href="<?php echo $rootPath?>/orders">Đơn hàng</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">More</a></li>
            </ul>
          </li>
        </ul>
      <form class="d-flex me-3" role="search">
        <input class="form-control me-2 search-top" type="search" placeholder="Search " aria-label="Search">
        <button class="btn btn-primary round-circle" type="submit">
            <i class="fa-regular fa-magnifying-glass text-white"></i>
        </button>
      </form>
      <ul class="nav navbar-nav pull-right">
        <?php
          if (!isset($_SESSION['email_ad'])) {
        ?>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo $rootPath?>/login.php">Đăng nhập</a>
          </li>
        <?php
          } else {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $rootPath?>/index.php">
            <i class="fa-light fa-crown"></i>
              <?php 
                $email = $_SESSION['email_ad'];
                $sqlAdmin = "SELECT name FROM admin WHERE email = '$email'";
                $ketQua = $conn->query($sqlAdmin);
                $admin = $ketQua->fetch_array();
                echo $admin['name'];
              ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $rootPath?>/logout.php">Đăng xuất</a>
          </li>
          <?php 
          }
          ?>
      </ul>
    </div>
  </div>
</nav>