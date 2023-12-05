<style>
    code {
        color:white;
    }
    .footer_share {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Adjust this value based on your layout */
    }
    .list-inline {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 10px; /* Adjust the gap between icons as needed */
    }
    .brand-name>div{
        display: grid;
        grid-template-columns: auto;
        justify-content: center;
    }
    .brand-name>div>ul{
        margin: auto;
    }
    .footer-row aside{
            display: grid;
            grid-template-columns: auto;
            justify-content: center;
    }
    @media (min-width: 768px) and (max-width: 1280px){
        .footer-row{
            display: grid;
            grid-template-columns: auto;
            justify-items: center;
        }
    }
</style>

<footer class="bg-dark" id="tempaltemo_footer" style="background-image: url(https://wujiateavn.com/images/bg_footer.png);">
    <div class="container" >
        <div class="row footer-row">
            <div class="col-md-3 pt-5 brand-name">
                <div>
                <a href="<?php echo $rootPath?>"><img style="width: 70%;" class="mb-3 mx-auto" src="https://wujiateavn.com/files/systems/logo-l6m1s0u2.png" alt="logo.png"></a>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <!--
                        <li></li>
                        <li></li>
                        <li></li>
                        -->
                        <!-- Facebook -->
                        <li class="list-inline-item text-center">
                            <a class="text-color-primary text-light text-decoration-none rounded-circle text-center" target="_blank" href="https://www.facebook.com/HongTraNgoGia.vn">
                                <i class="fab fa-facebook-f fa-lg fa-fw"></i>
                            </a>
                        </li>
                        <!-- GitHub -->
                        <li class="list-inline-item text-center">
                            <a class="text-color-primary text-light text-decoration-none" target="_blank" href="https://github.com/Conganhluan/Lap_trinh_web">
                                <i class="fab fa-github fa-lg fa-fw"></i>
                            </a>
                        </li>
                        <!-- Google Maps -->
                        <li class="list-inline-item text-center">
                            <a class="text-color-primary text-light text-decoration-none" target="_blank" href="https://maps.app.goo.gl/ch5M15RfMk7D5mfF7">
                                <i class="fas fa-shopping-cart fa-lg fa-fw"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 pt-5">
                <h4 class="border-bottom pb-3 border-light" style="color:black">Thông tin liên hệ</h4>
                <ul class="list-unstyled text-light footer-link-list">
                    <li>
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        <code>Địa chỉ: Đại học Bách Khoa, Bình Dương, Việt Nam</code>
                    </li>
                    <li>
                        <i class="fa fa-info-circle fa-fw"></i>
                        <code>Nhượng quyền: <a class="text-decoration-none" href="tel:0965210839"><span style="color: #ffff00"> 0965-210-839</a> (Thứ 2 - Thứ 7 / 8:00 AM - 17:00 PM)  </span></code>
                    </li>
                    <li>
                        <i class="fa fa-phone fa-fw"></i>
                        <code>Điện thoại: </code><a class="text-decoration-none text-light" href="tel:02822538043"><code><span style="color: #ffff00">02-822-538-043</span></code></a>
                    </li>
                    <li>
                        <i class="fa fa-envelope fa-fw"></i>
                        <code>Email: </code><a class="text-decoration-none text-light" href="mailto:marketingngogia@gmail.com"><code>marketingngogia@gmail.com</code></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 pt-5">
                <aside>
                    <!-- Include the Facebook SDK -->
                    <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0" nonce="YOUR_NONCE_VALUE"></script>

                    <!-- Embed the Facebook Like Box -->
                    <div class="fb-like-box"
                        data-href="https://www.facebook.com/HongTraNgoGia.vn"
                        data-width="320"
                        data-height="450"
                        data-colorscheme="light"
                        data-show-faces="true"
                        data-header="false"
                        data-stream="false"
                        data-show-border="false">
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <div class="w-100 py-1" style="background-color: #058dbf">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-center text-light user-select-none">
                        <code>Copyright &copy; 2023 Bài tập lớn Lập trình Web (CO3049)</code>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>