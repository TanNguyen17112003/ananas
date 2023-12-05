<nav class="navbar navbar-expand-lg bg-primary p-3 bg-body rounded" id="navbar-top">
  <div class="container">
    <a class="navbar-brand" href="<?php echo $rootPath; ?>">
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
          <a class="nav-link" href="<?php echo $rootPath; ?>/product.php">Sản phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $rootPath; ?>/contact.php">Liên hệ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $rootPath; ?>/posts.php">Tin tức</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $rootPath; ?>/policy.php">Chính sách</a>
        </li>
      </ul>
      <form action="<?php echo $rootPath ?>/search.php" method="get" class="d-flex me-3" role="search">
        <div class="input-group flex-nowrap search-top">
          <input hidden=true name="sort" value="all">
          <input class="form-control" type="search" name="key" placeholder="Search..." id="live-search" aria-label="Search" value="<?php if (!empty($_GET['key'])) echo $_GET['key']; ?>">
          <button class="btn btn-primary round-circle" type="submit"><i class="fa-regular fa-magnifying-glass text-white"></i></button>
          <div id="live-search__result"></div>
        </div>
      </form>
      <ul class="nav navbar-nav pull-right">
        <li class="nav-item me-2">
          <a href="<?php echo $rootPath ?>/cart.php" class="btn btn-light" id="headerCart">
            <i class="fa-sharp fa-solid fa-bag-shopping me-1"></i>
          </a>
        </li>
        <?php
        if (!isset($_SESSION['email_user'])) {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $rootPath ?>/sign_up.php">Đăng ký</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $rootPath ?>/customer/login.php">Đăng nhập</a>
          </li>
        <?php
        } else {
        ?>
          <li class="nav-item">
            <div class="dropdown">
              <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php
                $email = $_SESSION['email_user'];
                $sqlUser = "SELECT name FROM user WHERE email = '$email'";
                $ketQua = $conn->query($sqlUser);
                $user = $ketQua->fetch_array();
                echo $user['name'];
                ?>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo $rootPath ?>/customer/my_account.php">Tài khoản</a></li>
                <li><a class="dropdown-item" href="<?php echo $rootPath ?>/customer/my_order.php">Đơn hàng</a></li>
                <li><a class="dropdown-item" href="<?php echo $rootPath ?>/customer/check_out.php">Thanh toán</a></li>
                <li><a class="dropdown-item" href="<?php echo $rootPath ?>/customer/changePassword.php">Đổi mật khẩu</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $rootPath ?>/customer/logout.php">Đăng xuất</a>
          </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>