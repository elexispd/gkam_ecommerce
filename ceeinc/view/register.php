

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
                    <img src="assets/img/logo/logo-black.png" alt="logo">
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

        <main>
            
            <!-- breadcrumb area start -->
            <section class="breadcrumb__area box-plr-75">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__wrapper">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                      <li class="breadcrumb-item active" aria-current="page">Register</li>
                                    </ol>
                                  </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

            <!-- login Area Strat-->
            <section class="login-area pb-100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="basic-login">
                                <h3 class="text-center mb-60">Signup From Here</h3>
                                <form action="<?= BASE_URL ?>authenticate/store" method="post">
                                <?php
                                 Session::form_csfr();
                                 echo Session::ceedata("cip_auth");
                                ?>
                                    <label for="first_name">First Name <span>**</span></label>
                                    <input id="first_name" type="text" name="first_name" />
                                    <label for="last_name"> Last Name <span>**</span></label>
                                    <input id="last_name" type="text" name="last_name" />
                                    <label for="email-id">Email Address <span>**</span></label>
                                    <input id="email-id" type="email" name="email"  />
                                    <label for="pass">Password <span>**</span></label>
                                    <input id="pass" type="password" name="password" />
                                    <div class="mt-10"></div>
                                    <button class="t-y-btn w-100">Register Now</button>
                                    <div class="or-divide"><span>or</span></div>
                                    <a href="<?= BASE_URL ?>authenticate/login" class="t-y-btn t-y-btn-grey w-100">login Now</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- login Area End-->
 
        </main>

        <?php		
			  Session::set_ceedata("cip_auth","");			 
		?>

      