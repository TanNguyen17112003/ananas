<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<style>
    code {
        color: white;
    }

    .no-bullets {
        color: white;
    }

    .arrow-icon {
        font-size: 1rem;
        color: black;
    }

    .icon {
        font-size: 2rem;
        color: white;
    }

    .no-bullets li a {
        color: white;
        opacity: 0.6;
        text-decoration: none;
    }

    .footer_share {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        /* Adjust this value based on your layout */
    }

    .list-inline {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 10px;
        /* Adjust the gap between icons as needed */
    }

    .brand-name>div {
        display: grid;
        grid-template-columns: auto;
        justify-content: center;
    }

    .search-button {
        width: 100%;
        font-weight: bold;
        margin-top: 20px;
    }

    .brand-name>div>a {
        display: grid;
        grid-template-columns: auto;
        justify-items: center;
    }

    .brand-name>div>ul {
        margin: auto;
    }

    .footer-row aside {
        display: grid;
        grid-template-columns: auto;
        justify-content: center;
    }

    .submit-form {
        display: flex;
        align-items: center;
        gap: 3;
    }

    .border-bottom-dash {
        border-bottom: 1px dashed white;
    }
    @media (min-width: 768px) and (max-width: 1280px) {
        .footer-row {
            display: grid;
            grid-template-columns: auto;
            justify-items: center;
        }
    }
</style>


<footer class="footer container-fluid hidden-xs hidden-sm bg-secondary py-3">
    <div class="row">
        <div class="col-lg-3 sec-search">
            <div class="row center d-xs-none d-none d-lg-block">
                <img src="https://ananas.vn/wp-content/themes/ananas/fe-assets/images/svg/Store.svg">
            </div>
            <button class="btn btn-warning search-button text-white mb-3">TÌM CỬA HÀNG</button>
        </div>

        <div class="col-lg-9 sec-cont">
            <div class="row sec-cont-menu">
                <div class="col-lg-3 py-4 border-bottom-dash">
                    <h5 class="user-select-none text-white d-lg-block font-bold d-inline">SẢN PHẨM</h5>
                    <a class="dropdown-toggle list text-decoration-none text-white d-lg-none" data-toggle="collapse" href="#collapseProduct" role="button" aria-expanded="false" aria-controls="collapseProduct">
                    </a>
                    <ul class="no-bullets d-lg-block collapse list-unstyled" id="collapseProduct">
                        <li><a href="/product-list?gender=men&amp;category=shoes&amp;attribute=">Giày Nam</a></li>
                        <li><a href="/product-list?gender=women&amp;category=shoes&amp;attribute=">Giày Nữ</a></li>
                        <li><a href="/product-list?gender=men,women&amp;category=top,bottom,accessories&amp;attribute=">Thời trang &amp; Phụ kiện</a></li>
                        <li><a href="/promotion/clearance-sale/">Sale-off</a></li>
                    </ul>
                    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapseProduct" aria-controls="collapseProduct" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="col-lg-3 py-4 border-bottom-dash ">
                    <h5 class="user-select-none text-white d-lg-block font-bold d-inline">VỀ CÔNG TY</h5>
                    <a class="dropdown-toggle list text-decoration-none text-white d-lg-none" data-toggle="collapse" href="#collapseCompany" role="button" aria-expanded="false" aria-controls="collapseCompany">
                    </a>
                    <ul class="no-bullets d-lg-block collapse list-unstyled" id="collapseCompany">
                        <li><a href="/career">Dứa tuyển dụng</a></li>
                        <li><a href="/franchise-policy">Liên hệ nhượng quyền</a></li>
                        <li><a href="/comming-soon">Về Ananas</a></li>
                    </ul>
                    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapseCompany" aria-controls="collapseCompany" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="col-lg-3 py-4 border-bottom-dash">
                    <h5 class="user-select-none text-white d-lg-block font-bold d-inline">HỖ TRỢ</h5>
                    <a class="dropdown-toggle list text-decoration-none text-white d-lg-none" data-toggle="collapse" href="#collapseSupport" role="button" aria-expanded="false" aria-controls="collapseSupport">
                    </a>
                    <ul class="no-bullets d-lg-block collapse list-unstyled" id="collapseSupport">
                        <li><a href="/faqs">FAQs</a></li>
                        <li><a href="/privacy">Bảo mật thông tin</a></li>
                        <li><a href="/policy">Chính sách chung</a></li>
                        <li><a href="/search-order/">Tra cứu đơn hàng</a></li>
                    </ul>
                    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapseSupport" aria-controls="collapseSupport" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="col-lg-3 py-4 border-bottom-dash ">
                    <h5 class="user-select-none text-white d-lg-block font-bold d-inline">LIÊN HỆ</h5>
                    <a class="dropdown-toggle list text-decoration-none text-white d-lg-none" data-toggle="collapse" href="#collapseContact" role="button" aria-expanded="false" aria-controls="collapseContact">
                    </a>
                    <ul class="no-bullets d-lg-block collapse list-unstyled" id="collapseContact">
                         <li><a href="/comming-soon">Email góp ý</a></li>
                        <li><a href="">Hotline</a></li>
                        <li><a href="">0963 429 749</a></li>
                    </ul>
                    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapseContact" aria-controls="collapseContact" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6 col-lg-3">
                    <h4 class="text-white mb-3">ANANAS SOCIAL</h4>
                    <a href="https://www.facebook.com/Ananas.vietnam/"><i class="fa-brands fa-facebook icon"></i></a>&nbsp;
                    <a href="https://www.instagram.com/ananasvn/"><i class="fa-brands fa-instagram icon"></i></a>&nbsp;
                    <a href="https://www.youtube.com/discoveryou"><i class="fa-brands fa-youtube icon mb-3"></i></a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h4 class="text-white mb-3">ĐĂNG KÝ NHẬN MAIL</h4>
                    <div class="form-group subscribe-group submit-form">
                        <input type="email" class="form-control inputReceiveMail" id="inputRecieveMail">
                        <button class="btn btn-primary" type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
                <div class="col-md-6 logo-footer d-none d-lg-block">
                    <a href="https://ananas.vn"><img src="https://ananas.vn/wp-content/themes/ananas/fe-assets/images/svg/Logo_Ananas_Footer.svg"></a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 icon-bct">
                    <a href="http://online.gov.vn/Home/WebDetails/61921"><img src=""></a>
                </div>
                <div class="col-md-9 copyright text-primary mt-5">
                    Copyright © 2022 Ananas. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</footer>