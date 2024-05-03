<style>
    .modal {
        z-index: 9999 !important;
    }
</style>
<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <i class="lni lni-list"></i>
        </button>
        <div class="sidebar-logo">
            <h2 class = "text-white">Ananas</h2>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="<?php echo $rootPath?>/report" class="sidebar-link">
                <i class="lni lni-grid-alt"></i>
                <span>Thống kê</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="<?php echo $rootPath?>/orders" class="sidebar-link">

                <i class="lni lni-printer"></i>
                <span>Đơn hàng</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="<?php echo $rootPath?>/products" class="sidebar-link">

                <i class="lni lni-cart"></i>
                <span>Sản phẩm</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="<?php echo $rootPath?>/users" class="sidebar-link">
                <i class="lni lni-user"></i>
                <span>Người dùng</span>
            </a>
        </li>
        
        <li class="sidebar-item">
            <a href="<?php echo $rootPath?>/posts" class="sidebar-link">
                <i class="lni lni-book"></i>
                <span>Tin tức</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="<?php echo $rootPath?>/contacts" class="sidebar-link">

                <i class="lni lni-envelope"></i>
                <span>Liên hệ</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="<?php echo $rootPath?>/changePassword.php" class="sidebar-link">
                <i class = "lni lni-lock"></i>
                <span>Đổi mật khẩu</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
    <a href="#" class="sidebar-link" data-bs-toggle="modal" data-bs-target="#logoutModal">
    <i class="lni lni-exit"></i>
    <span>Đăng xuất</span>
</a>

    </div>
    

</aside>
<div class="modal" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to log out?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <a href="<?php echo $rootPath?>/logout.php" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

