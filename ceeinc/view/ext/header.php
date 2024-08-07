
<?php
Cee_assets::Assets();
if (empty(users_model::currentUser())) {
    $session_id = session_id();
    $user_id = '';
} else {
    $user_id = users_model::currentUser()['id'];
    $session_id = '';
}

?>




<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> GKAM SHOP INTERNATIONAL STORE </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASE_URL ?>assets/img/favicc.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/preloader.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/slick.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/backToTop.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/meanmenu.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/nice-select.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/animate.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/fontAwesome5Pro.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/ui-range-slider.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/default.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <script src="<?= BASE_URL ?>assets/js/vendor/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>

<body>


    <!-- Add your site or application content here -->

    <!-- preloader area start -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div id="object"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->


    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->

    <!-- header area start -->
    <header>
        <div class="header__area">
            <div class="header__top d-none d-sm-block">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 col-md-5 d-none d-md-block">
                            <div class="header__welcome">
                                <span>Welcome To Gkamstore International Shopping</span>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-7">
                            <div class="header__action d-flex justify-content-center justify-content-md-end">
                                <ul>
                                <?php 
                                    if(empty(Session::ceedata("cip_username"))) { ?>
                                            <li><a href="<?= BASE_URL ?>authenticate/login"> My Account</a></li>
                                        <?php  } else { ?>
                                        <li><a href="#">My Account</a></li>
                                        <li><a href="#">My Wishlist</a></li>
                                        <li><a href="<?= BASE_URL ?>dashboard">Sell</a></li>
                                        <li>
                                            <a href="<?= BASE_URL ?>authenticate/logout"><i data-feather="log-in"> </i><span>Log out</span></a>
                                        </li>
                                        <?php }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header__info">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-4 col-lg-3">
                            <div
                                class="header__info-left d-flex justify-content-center justify-content-sm-between align-items-center">
                                <div class="logo">
                                    <a href="<?= BASE_URL ?>"><img src="<?= BASE_URL ?>assets/img/logo/logo-black.png" width="158px"
                                            alt="logo"></a>
                                </div>
                                <div class="header__hotline align-items-center d-none d-sm-flex  d-lg-none d-xl-flex">
                                    <div class="header__hotline-icon">
                                        <i class="fal fa-headset"></i>
                                    </div>
                                    <div class="header__hotline-info">
                                        <span>Hotline Free:</span>
                                        <h6><a href="tel:06-900-6789-00">06-900-6789-00</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-9">
                            <div class="header__info-right">
                                <div class="header__search f-left d-none d-sm-block">
                                    <form action="#">
                                        <div class="header__search-box">
                                            <input type="text" placeholder="Search For Products...">
                                            <button type="submit">Search</button>
                                        </div>
                                        <div class="header__search-cat">
                                            <select>
                                                <option>All Categories</option>
                                                <option>Best Seller Products</option>
                                                <option>Top 10 Offers</option>
                                                <option>New Arrivals</option>
                                                <option>Phones & Tablets</option>
                                                <option>Electronics & Digital</option>
                                                <option>Fashion & Clothings</option>
                                                <option>Jewelry & Watches</option>
                                                <option>Health & Beauty</option>
                                                <option>Sound & Speakers</option>
                                                <option>TV & Audio</option>
                                                <option>Computers</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="cart__mini-wrapper d-none d-md-flex f-right p-relative">
                                    <a href="javascript:void(0);" class="cart__toggle">
                                        <span class="cart__total-item">
                                        <?php 
                                            $cart_no = (!empty(cart_model::getCartItemCount($user_id, $session_id)) ? cart_model::getCartItemCount($user_id, $session_id) : 0);
                                            echo $cart_no;
                                        ?>
                                        </span>
                                    </a>
                                    <!-- <span class="cart__content"> -->
                                        <!-- <span class="cart__my">My Cart:</span> -->
                                        <!-- <span class="cart__total-price">$ 255.00</span> -->
                                    <!-- </span> -->
                                    <div class="cart__mini">
                                        <div class="cart__close"><button type="button" class="cart__close-btn"><i
                                                    class="fal fa-times"></i></button>
                                        </div>
                                        <ul>
                                            <li>
                                                <div class="cart__title">
                                                    <h4>My Cart</h4>
                                                    <span>(<?= $cart_no; ?> Item(s) in Cart)</span>
                                                </div>
                                            </li>
                                            <?php
                                            if($cart_no > 0) { ?>
                                            <li>
                                                <?php 
                                                $cart_items = cart_model::getUserCartItems($user_id, $session_id);
                                                $sub_total = 0;
                                                $shipping_total = 0;
                                                foreach($cart_items as $cart) {
                                                    $product = product_model::getProductById($cart['product_id']);
                                                    $product_img = product_model::getProductThumbnail($cart['product_id']);
                                                    $thumbnail = $product_img ? $product_img["product_image"] : BASE_URL.'assets/img/no_image.jpg';

                                                    $excerp = str_replace(' ', '-', $product["title"]); 
                                                    $sub_total += $cart["price"];
                                                ?>
                                                <div
                                                    class="cart__item d-flex justify-content-between align-items-center">
                                                    <div class="cart__inner d-flex">
                                                        <div class="cart__thumb">
                                                            <a href="<?= BASE_URL . 'product/show?tit=' . $excerp . '&qu=' . $cart['product_id']; ?>">
                                                               
                                                                <img src="<?= BASE_URL. $thumbnail ?>"
                                                                    alt="">
                                                            </a>
                                                        </div>
                                                        <div class="cart__details">
                                                            <h6><a href="<?= BASE_URL . 'product/show?tit=' . $excerp . '&qu=' . $cart['product_id']; ?>"> <?= $product["title"] ?> </a></h6>
                                                            <div class="cart__price">
                                                                <span>$<?=  number_format($cart["price"], 2) ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cart__del">
                                                        <a data-cart="" onclick="removeFromCart(<?= $product['id'] ?>, '<?= BASE_URL ?>') " ><i class="fal fa-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                              <?php } ?>
                                            </li>
                                            <li>
                                                <div
                                                    class="cart__sub d-flex justify-content-between align-items-center">
                                                    <h6>Subtotal</h6>
                                                    <span class="cart__sub-total">$<?= number_format($sub_total, 2) ?></span>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="<?= BASE_URL ?>checkout" class="t-y-btn w-100 mb-10">Proceed to
                                                    checkout</a>
                                                <a href="<?= BASE_URL ?>cart" class="t-y-btn t-y-btn-border w-100 mb-10">view add
                                                    edit cart</a>
                                            </li>
                                            <?php 

                                            } else { ?>
                                                <tr>
                                                    <td>No Item In Cart</td>
                                                </tr>
                                           <?php }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header__bottom header_bottom-main unhide">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-6 col-6">
                            <div class="header__bottom-left d-flex d-xl-block align-items-center">
                                <div class="side-menu d-xl-none mr-20">
                                    <button type="button" class="side-menu-btn offcanvas-toggle-btn"><i
                                            class="fas fa-bars"></i></button>
                                </div>
                                <div class="main-menu d-none d-md-block">
                                    <nav>
                                        <ul>
                                            <li>
                                                <a href="<?= BASE_URL ?>">Home</i></a>
                                                
                                            </li>
                                            <li><a href="about">about us</a></li>
                                            <li><a href="contact">contact</a></li>
                                            
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3  col-sm-6  col-6 d-md-none d-lg-block">
                            <div class="header__bottom-right d-flex justify-content-end">
                                <div class="header__currency">
                                    <select id="currency-select">
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                                <div class="header__lang d-md-none d-lg-block">
                                    <select id="language-select">
                                        <option value="en">English</option>
                                        <option value="bn">Bangla</option>
                                        <option value="ar">Arabic</option>
                                        <option value="hi">Hindi</option>
                                        <option value="ur">Urdu</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="header__bottom header_bottom-sticky hide" id="header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-6 col-6">
                            <div class="header__bottom-left header__bottom-left-sticky d-flex d-xl-block align-items-center">
                                <div class="side-menu d-xl-none mr-20">
                                    <button type="button" class="side-menu-btn offcanvas-toggle-btn"><i
                                            class="fas fa-bars"></i></button>
                                </div>
                                <div class="logo-sticky">
                                    <a href="index.html"><img src="<?= BASE_URL ?>assets/img/logo/logo-black.png" width="118px"
                                            alt="logo"></a>
                                </div>
                                <div class="main-menu main-menu-sticky d-none d-md-block">
                                    <nav>
                                        <ul>
                                            <li>
                                                <a href="<?= BASE_URL ?>">Home</i></a>
                                               
                                            </li>
                                            <li><a href="<?= BASE_URL ?>about">about us</a></li>
                                            <li><a href="<?= BASE_URL ?>contact">contact</a></li>
                                           
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2  col-sm-6  col-6 d-md-none d-lg-block">
                            <div class="header__bottom-right d-flex justify-content-end">
                                <div class="header__currency">
                                    <select>
                                        <option>USD</option>
                                    </select>
                                </div>
                                <div class="header__lang d-md-none d-lg-block">
                                    <select>
                                        <option>English</option>
                                        <option>Bangla</option>
                                        <option>Arabic</option>
                                        <option>Hindi</option>
                                        <option>Urdu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->


