<?php 
    Cee_assets::Assets();
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>E-commerce </title>
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


        <!-- offcanvas area start -->
        <div class="offcanvas__area">
            <div class="offcanvas__wrapper">
            <div class="offcanvas__close">
                <button class="offcanvas__close-btn" id="offcanvas__close-btn">
                    <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="offcanvas__content">
                <div class="offcanvas__logo mb-40">
                    <a href="index.html">
                    <img src="<?= BASE_URL ?>assets/img/logo/logo-black.png" alt="logo">
                    </a>
                </div>
                <div class="offcanvas__search mb-25">
                    <form action="#">
                        <input type="text" placeholder="What are you searching for?">
                        <button type="submit" ><i class="far fa-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-2 fix"></div>
                <div class="offcanvas__action">

                </div>
            </div>
            </div>
        </div>
        <!-- offcanvas area end -->      
        <div class="body-overlay"></div>
        <!-- offcanvas area end -->

        <main style="padding-bottom: 20px;padding-top: 20px;">
            
            <!-- login Area Strat-->
            <section class="login-area2 ">
                <div class="container">
                <div class="row">
                    <div class="col-lg-5 login-offset">
                            <div class="basic-login2">
                                <div class="login-logo mb-15">
                                    <a href="index.html">
                                        <img src="<?= BASE_URL ?>assets/img/logo/logo-black.png" width="130px" alt="logo">
                                    </a>
                                </div>
                                <h3 class="text-center">Create a new account</h3>
                                <p class="text-center mb-30">Enter your details to register</p>
                                    <form action="<?= BASE_URL ?>authenticate/store" method="post">
                                    <?php
                                    Session::form_csfr();
                                    echo Session::ceedata("cip_auth");
                                    ?>
                                     <!-- <label for="name">Email Address <span>**</span></label> -->
                                    <input id="last_name" type="text" name="first_name" placeholder="Enter your first name..." required />
                                    <input id="last_name" type="text" name="last_name" placeholder="Enter your last name..." required />
                                    <input id="email" type="email" name="email" placeholder="Enter your email..."  required />
                                    <div class="password-wrapper">
                                        <input id="pass" type="password" placeholder="Enter your placeholder..." name="password" required style="margin-bottom: 0px;"/>
                                        <span class="toggle-password" onclick="togglePassword()">
                                            <i id="eyeIcon" class="fas fa-eye"></i>
                                        </span>
                                    </div>

                                    <div class="password-condition fix">
                                        <!-- <span>Must contain 1 uppercase letter, 1 number, min. 6 characters.</span> -->
                                    </div>

                                    <button class="t-y-btn w-100">Sign Up</button>

                                        <div class="register-terms-condition">
                                            <p>By clicking Sign Up, you agree to accept our financial <span> <a href="#" class="terms-btn">Terms and Conditions</a></span></p>                                    
                                        </div>

                                    <div class="login-footer">
                                        <span>Already a member?</span>
                                        <a href="<?= BASE_URL ?>authenticate/login" class="sign-up-btn">Sign In</a>
                                    </div>

                                    <!-- <div class="social-login">
                                        <button class="social-button google-button">
                                            <i class="fab fa-google"></i> Google
                                        </button>
                                        <button class="social-button facebook-button">
                                            <i class="fab fa-facebook-f"></i> Facebook
                                        </button>
                                        <button class="social-button linkedin-button">
                                            <i class="fab fa-linkedin-in"></i> LinkedIn
                                        </button>
                                    </div> -->
                                </form>
                            </div>
                    </div>
                </div>
                </div>
            </section>
            <!-- login Area End-->
 
        </main>

        <div class="footer">
            Copyright&copy;<span id="currentYear"></span> gkamshop. All rights reserved.
        </div>

        <script>
            // TO HIDE OR VIEW LOGIN PASSWORD WHILE TYPING
            function togglePassword() {
                const passwordInput = document.getElementById('pass');
                const eyeIcon = document.getElementById('eyeIcon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            }
             // Set current year in footer
        document.getElementById('currentYear').textContent = new Date().getFullYear();
        </script>

		<!-- JS here -->
        <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="<?= BASE_URL ?>assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/f6de0a4519.js" crossorigin="anonymous"></script>
        <script src="<?= BASE_URL ?>assets/js/vendor/waypoints.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/meanmenu.js"></script>
        <script src="<?= BASE_URL ?>assets/js/slick.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/backToTop.js"></script>
        <script src="<?= BASE_URL ?>assets/js/jquery.fancybox.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/countdown.js"></script>
        <script src="<?= BASE_URL ?>assets/js/nice-select.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/isotope.pkgd.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/owl.carousel.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/magnific-popup.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/jquery-ui-slider-range.js"></script>
        <script src="<?= BASE_URL ?>assets/js/ajax-form.js"></script>
        <script src="<?= BASE_URL ?>assets/js/wow.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="<?= BASE_URL ?>assets/js/main.js"></script>
    </body>

</html>
<?php		
    Session::set_ceedata("cip_auth","");			 
?>
