<?php
Cee_assets::Assets();
$password = Session::ceedata("cip_password");
$username = Session::ceedata("cip_username");
// $e = users_model::currentUser()->fetch_assoc();
// print_r($e); exit;
if (users_model::auth($username, $password)) {
} else {
    Session::set_ceedata("cip_auth","<div class='cee_error'> Unauthorized Access </div>"); 
  cee_matchapp::redirect("authenticate/login");
}

$loggedInUser = users_model::currentUser();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Mofi admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities."
    />
    <meta
      name="keywords"
      content="admin template, Mofi admin template, dashboard template, flat admin template, responsive admin template, web app"
    />
    <meta name="author" content="pixelstrap" />
    <link rel="icon" href="<?= BASE_URL ?>dashboard_assets/images/favicon.png" type="image/x-icon" />
    <link
      rel="shortcut icon"
      href="<?= BASE_URL ?>dashboard_assets/images/favicon.png"
      type="image/x-icon"
    />
    <title>User Cards | Mofi - Premium Admin Template By Pixelstrap</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="<?= BASE_URL ?>dashboard_assets/css/font-awesome.css"
    />
    <!-- ico-font-->
    <link
      rel="stylesheet"
      type="text/css"
      href="<?= BASE_URL ?>dashboard_assets/css/vendors/icofont.css"
    />
    <!-- Themify icon-->
    <link
      rel="stylesheet"
      type="text/css"
      href="<?= BASE_URL ?>dashboard_assets/css/vendors/themify.css"
    />
    <!-- Flag icon-->
    <link
      rel="stylesheet"
      type="text/css"
      href="<?= BASE_URL ?>dashboard_assets/css/vendors/flag-icon.css"
    />
    <!-- Feather icon-->
    <link
      rel="stylesheet"
      type="text/css"
      href="<?= BASE_URL ?>dashboard_assets/css/vendors/feather-icon.css"
    />
    <!-- Plugins css start-->
    <link
      rel="stylesheet"
      type="text/css"
      href="<?= BASE_URL ?>dashboard_assets/css/vendors/slick.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="<?= BASE_URL ?>dashboard_assets/css/vendors/slick-theme.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="<?= BASE_URL ?>dashboard_assets/css/vendors/scrollbar.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="<?= BASE_URL ?>dashboard_assets/css/vendors/animate.css"
    />
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link
      rel="stylesheet"
      type="text/css"
      href="<?= BASE_URL ?>dashboard_assets/css/vendors/bootstrap.css"
    />
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>dashboard_assets/css/style.css" />
    <link
      id="color"
      rel="stylesheet"
      href="<?= BASE_URL ?>dashboard_assets/css/color-1.css"
      media="screen"
    />
    <!-- Responsive css-->
    <link
      rel="stylesheet"
      type="text/css"
      href="<?= BASE_URL ?>dashboard_assets/css/responsive.css"
    />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/cutealert/style.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>dashboard_assets/css/vendors/datatables.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>dashboard_assets/css/vendors/datatable-extension.css">
    <!-- Plugins css Ends-->
    <script src="<?= BASE_URL ?>dashboard_assets/js/jquery.min.js"></script>  
    <script src="<?= BASE_URL ?>assets/cutealert/cute-alert.js"></script>
  </head>
  <body>
    <div class="loader-wrapper">
      <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
        <div class="loader-inner-1"></div>
      </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <div class="page-header row">
        <div class="header-logo-wrapper col-auto">
          <div class="logo-wrapper">
            <a href="index.html"
              ><img
                class="img-fluid for-light"
                src="<?= BASE_URL ?>dashboard_assets/images/logo/logo.png"
                alt="" /><img
                class="img-fluid for-dark"
                src="<?= BASE_URL ?>dashboard_assets/images/logo/logo_light.png"
                alt=""
            /></a>
          </div>
        </div>
        <div class="col-4 col-xl-4 page-title">
          <h4 class="f-w-700">User Cards</h4>
          <nav>
            <ol
              class="breadcrumb justify-content-sm-start align-items-center mb-0"
            >
              <li class="breadcrumb-item">
                <a href="index.html"> <i data-feather="home"> </i></a>
              </li>
              <li class="breadcrumb-item f-w-400">Users</li>
              <li class="breadcrumb-item f-w-400 active">User Cards</li>
            </ol>
          </nav>
        </div>
        <!-- Page Header Start-->
        <div class="header-wrapper col m-0">
          <div class="row">
            <form class="form-inline search-full col" action="#" method="get">
              <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                  <div class="u-posRelative">
                    <input
                      class="demo-input Typeahead-input form-control-plaintext w-100"
                      type="text"
                      placeholder="Search Mofi .."
                      name="q"
                      title=""
                      autofocus
                    />
                    <div class="spinner-border Typeahead-spinner" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                    <i class="close-search" data-feather="x"></i>
                  </div>
                  <div class="Typeahead-menu"></div>
                </div>
              </div>
            </form>
            <div class="header-logo-wrapper col-auto p-0">
              <div class="logo-wrapper">
                <a href="index.html"
                  ><img
                    class="img-fluid"
                    src="<?= BASE_URL ?>dashboard_assets/images/logo/logo.png"
                    alt=""
                /></a>
              </div>
              <div class="toggle-sidebar">
                <svg class="stroke-icon sidebar-toggle status_toggle middle">
                  <use href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#toggle-icon"></use>
                </svg>
              </div>
            </div>
            <div
              class="nav-right col-xxl-8 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto"
            >
              <ul class="nav-menus">
                <li>
                  <span class="header-search">
                    <svg>
                      <use
                        href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#search"
                      ></use></svg
                  ></span>
                </li>
                <li>
                  <div class="form-group w-100">
                    <div class="Typeahead Typeahead--twitterUsers">
                      <div class="u-posRelative d-flex align-items-center">
                        <svg class="search-bg svg-color">
                          <use
                            href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#search"
                          ></use>
                        </svg>
                        <input
                          class="demo-input py-0 Typeahead-input form-control-plaintext w-100"
                          type="text"
                          placeholder="Search Mofi .."
                          name="q"
                          title=""
                        />
                      </div>
                    </div>
                  </div>
                </li>
                <li class="fullscreen-body">
                  <span>
                    <svg id="maximize-screen">
                      <use
                        href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#full-screen"
                      ></use></svg
                  ></span>
                </li>
                <li class="onhover-dropdown">
                  <div class="notification-box">
                    <svg>
                      <use
                        href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#notification"
                      ></use></svg
                    ><span class="badge rounded-pill badge-primary">4 </span>
                  </div>
                  <div class="onhover-show-div notification-dropdown">
                    <h5 class="f-18 f-w-600 mb-0 dropdown-title">
                      Notifications
                    </h5>
                    <ul class="notification-box">
                      <li
                        class="toast default-show-toast align-items-center border-0 fade show"
                        aria-live="assertive"
                        aria-atomic="true"
                        data-bs-autohide="false"
                      >
                        <div class="d-flex justify-content-between">
                          <div class="toast-body d-flex p-0">
                            <div class="flex-shrink-0 bg-light-primary">
                              <img
                                class="w-auto"
                                src="<?= BASE_URL ?>dashboard_assets/images/dashboard/icon/wallet.png"
                                alt="Wallet"
                              />
                            </div>
                            <div class="flex-grow-1">
                              <a href="private-chat.html">
                                <h6 class="m-0">Daily offer added</h6></a
                              >
                              <p class="m-0">User-only offer added</p>
                            </div>
                          </div>
                          <button
                            class="btn-close btn-close-white shadow-none"
                            type="button"
                            data-bs-dismiss="toast"
                            aria-label="Close"
                          ></button>
                        </div>
                      </li>
                      <li
                        class="toast default-show-toast align-items-center border-0 fade show"
                        aria-live="assertive"
                        aria-atomic="true"
                        data-bs-autohide="false"
                      >
                        <div class="d-flex justify-content-between">
                          <div class="toast-body d-flex p-0">
                            <div class="flex-shrink-0 bg-light-info">
                              <img
                                class="w-auto"
                                src="<?= BASE_URL ?>dashboard_assets/images/dashboard/icon/shield-dne.png"
                                alt="Shield-dne"
                              />
                            </div>
                            <div class="flex-grow-1">
                              <a href="private-chat.html">
                                <h6 class="m-0">Product Review</h6></a
                              >
                              <p class="m-0">Changed to a workflow</p>
                            </div>
                          </div>
                          <button
                            class="btn-close btn-close-white shadow-none"
                            type="button"
                            data-bs-dismiss="toast"
                            aria-label="Close"
                          ></button>
                        </div>
                      </li>
                      <li
                        class="toast default-show-toast align-items-center border-0 fade show"
                        aria-live="assertive"
                        aria-atomic="true"
                        data-bs-autohide="false"
                      >
                        <div class="d-flex justify-content-between">
                          <div class="toast-body d-flex p-0">
                            <div class="flex-shrink-0 bg-light-warning">
                              <img
                                class="w-auto"
                                src="<?= BASE_URL ?>dashboard_assets/images/dashboard/icon/graph.png"
                                alt="Graph"
                              />
                            </div>
                            <div class="flex-grow-1">
                              <a href="private-chat.html">
                                <h6 class="m-0">Return Products</h6></a
                              >
                              <p class="m-0">52 items were returned</p>
                            </div>
                          </div>
                          <button
                            class="btn-close btn-close-white shadow-none"
                            type="button"
                            data-bs-dismiss="toast"
                            aria-label="Close"
                          ></button>
                        </div>
                      </li>
                      <li
                        class="toast default-show-toast align-items-center border-0 fade show"
                        aria-live="assertive"
                        aria-atomic="true"
                        data-bs-autohide="false"
                      >
                        <div class="d-flex justify-content-between">
                          <div class="toast-body d-flex p-0">
                            <div class="flex-shrink-0 bg-light-tertiary">
                              <img
                                class="w-auto"
                                src="<?= BASE_URL ?>dashboard_assets/images/dashboard/icon/ticket-star.png"
                                alt="Ticket-star"
                              />
                            </div>
                            <div class="flex-grow-1">
                              <a href="private-chat.html">
                                <h6 class="m-0">Recently Paid</h6></a
                              >
                              <p class="m-0">Card payment of $343</p>
                            </div>
                          </div>
                          <button
                            class="btn-close btn-close-white shadow-none"
                            type="button"
                            data-bs-dismiss="toast"
                            aria-label="Close"
                          ></button>
                        </div>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="onhover-dropdown">
                  <svg>
                    <use
                      href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#header-bookmark"
                    ></use>
                  </svg>
                  <div class="onhover-show-div bookmark-flip">
                    <div class="flip-card">
                      <div class="flip-card-inner">
                        <div class="front">
                          <h5 class="f-18 f-w-600 mb-0 dropdown-title">
                            Bookmark
                          </h5>
                          <ul class="bookmark-dropdown">
                            <li>
                              <div class="row">
                                <div class="col-4 text-center">
                                  <div class="bookmark-content">
                                    <div class="bookmark-icon bg-light-primary">
                                      <i
                                        class="stroke-primary"
                                        data-feather="file-text"
                                      ></i>
                                    </div>
                                    <span class="font-primary">Forms</span>
                                  </div>
                                </div>
                                <div class="col-4 text-center">
                                  <div class="bookmark-content">
                                    <div
                                      class="bookmark-icon bg-light-secondary"
                                    >
                                      <i
                                        class="stroke-secondary"
                                        data-feather="user"
                                      ></i>
                                    </div>
                                    <span class="font-secondary">Profile</span>
                                  </div>
                                </div>
                                <div class="col-4 text-center">
                                  <div class="bookmark-content">
                                    <div class="bookmark-icon bg-light-warning">
                                      <i
                                        class="stroke-warning"
                                        data-feather="server"
                                      ></i>
                                    </div>
                                    <span class="font-warning">Tables</span>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="text-center">
                              <a
                                class="flip-btn f-w-700 btn btn-primary w-100"
                                id="flip-btn"
                                href="javascript:void(0)"
                                >Add Bookmark</a
                              >
                            </li>
                          </ul>
                        </div>
                        <div class="back">
                          <ul>
                            <li>
                              <div class="bookmark-dropdown flip-back-content">
                                <input type="text" placeholder="search..." />
                              </div>
                            </li>
                            <li>
                              <a
                                class="f-w-700 d-block flip-back btn btn-primary w-100"
                                id="flip-back"
                                href="javascript:void(0)"
                                >Back</a
                              >
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="mode">
                    <svg>
                      <use href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#moon"></use>
                    </svg>
                  </div>
                </li>
                <li class="onhover-dropdown">
                  <div class="notification-box">
                    <svg>
                      <use
                        href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#header-message"
                      ></use></svg
                    ><span class="badge rounded-pill badge-info">3 </span>
                  </div>
                  <div class="onhover-show-div notification-dropdown">
                    <h5 class="f-18 f-w-600 mb-0 dropdown-title">Messages</h5>
                    <ul class="messages">
                      <li class="d-flex b-light1-primary gap-2">
                        <div class="flex-shrink-0">
                          <img
                            src="<?= BASE_URL ?>dashboard_assets/images/dashboard-2/user/1.png"
                            alt="Graph"
                          />
                        </div>
                        <div class="flex-grow-1">
                          <a href="private-chat.html">
                            <h6 class="font-primary f-w-600">
                              Hackett Yessenia
                            </h6></a
                          >
                          <p>Hello Miss...&#128522;</p>
                        </div>
                        <span>2 hours</span>
                      </li>
                      <li class="d-flex b-light1-secondary gap-2">
                        <div class="flex-shrink-0">
                          <img
                            src="<?= BASE_URL ?>dashboard_assets/images/dashboard-2/user/2.png"
                            alt="Graph"
                          />
                        </div>
                        <div class="flex-grow-1">
                          <a href="private-chat.html">
                            <h6 class="font-secondary f-w-600">
                              schneider Adan
                            </h6></a
                          >
                          <p>Wishing You a Happy Birthday Dear.. 🥳&#127882;</p>
                        </div>
                        <span>3 hours</span>
                      </li>
                      <li class="d-flex b-light1-success gap-2">
                        <div class="flex-shrink-0">
                          <img
                            src="<?= BASE_URL ?>dashboard_assets/images/dashboard-2/user/3.png"
                            alt="Graph"
                          />
                        </div>
                        <div class="flex-grow-1">
                          <a href="private-chat.html">
                            <h6 class="font-success f-w-600">
                              Mahdi Gholizadeh
                            </h6></a
                          >
                          <p>Hello Dear!! This Theme Is Very beautiful</p>
                        </div>
                        <span>5 hours</span>
                      </li>
                      <li class="bg-transparent">
                        <a
                          class="f-w-700 btn btn-primary w-100"
                          href="letter-box.html"
                          >View all</a
                        >
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="cart-nav onhover-dropdown">
                  <div class="cart-box">
                    <svg>
                      <use
                        href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#stroke-ecommerce"
                      ></use>
                    </svg>
                  </div>
                  <div class="cart-dropdown onhover-show-div">
                    <h5 class="f-18 f-w-600 mb-0 dropdown-title">Cart</h5>
                    <ul>
                      <li>
                        <div class="d-flex">
                          <img
                            class="img-fluid b-r-5 me-3 img-60"
                            src="<?= BASE_URL ?>dashboard_assets/images/other-images/cart-img.jpg"
                            alt=""
                          />
                          <div class="flex-grow-1">
                            <span class="f-w-600"
                              >Furniture Chair for Home</span
                            >
                            <div class="qty-box">
                              <div class="input-group">
                                <span class="input-group-prepend">
                                  <button
                                    class="btn quantity-left-minus"
                                    type="button"
                                    data-type="minus"
                                    data-field=""
                                  >
                                    -
                                  </button></span
                                >
                                <input
                                  class="form-control input-number"
                                  type="text"
                                  name="quantity"
                                  value="1"
                                /><span class="input-group-prepend">
                                  <button
                                    class="btn quantity-right-plus"
                                    type="button"
                                    data-type="plus"
                                    data-field=""
                                  >
                                    +
                                  </button></span
                                >
                              </div>
                            </div>
                            <h6 class="font-primary">$500</h6>
                          </div>
                          <div class="close-circle">
                            <a class="bg-danger" href="#"
                              ><i data-feather="x"></i
                            ></a>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="d-flex">
                          <img
                            class="img-fluid b-r-5 me-3 img-60"
                            src="<?= BASE_URL ?>dashboard_assets/images/other-images/table-img.jpg"
                            alt=""
                          />
                          <div class="flex-grow-1">
                            <span class="f-w-600"
                              >Furniture Table for Office</span
                            >
                            <div class="qty-box">
                              <div class="input-group">
                                <span class="input-group-prepend">
                                  <button
                                    class="btn quantity-left-minus"
                                    type="button"
                                    data-type="minus"
                                    data-field=""
                                  >
                                    -
                                  </button></span
                                >
                                <input
                                  class="form-control input-number"
                                  type="text"
                                  name="quantity"
                                  value="1"
                                /><span class="input-group-prepend">
                                  <button
                                    class="btn quantity-right-plus"
                                    type="button"
                                    data-type="plus"
                                    data-field=""
                                  >
                                    +
                                  </button></span
                                >
                              </div>
                            </div>
                            <h6 class="font-primary">$500.00</h6>
                          </div>
                          <div class="close-circle">
                            <a class="bg-danger" href="#"
                              ><i data-feather="x"></i
                            ></a>
                          </div>
                        </div>
                      </li>
                      <li class="total">
                        <h6 class="mb-0">
                          Order Total :
                          <span class="f-w-600 f-right">$1000.00</span>
                        </h6>
                      </li>
                      <li class="text-center">
                        <a
                          class="d-block view-cart f-w-700 btn btn-primary w-100"
                          href="cart.html"
                          >View Cart</a
                        ><a
                          class="btn btn-primary view-checkout w-100 f-w-700"
                          href="checkout.html"
                          >Checkout</a
                        >
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="profile-nav onhover-dropdown px-0 py-0">
                  <div class="d-flex profile-media align-items-center">
                    <img
                      class="img-30"
                      src="<?= BASE_URL ?>dashboard_assets/images/dashboard/profile.png"
                      alt=""
                    />
                    <div class="flex-grow-1">
                      <span><?= $loggedInUser["first_name"] . " " . $loggedInUser["last_name"] ?></span>
                      <p class="mb-0 font-outfit">
                        UI Designer<i class="fa fa-angle-down"></i>
                      </p>
                    </div>
                  </div>
                  <ul class="profile-dropdown onhover-show-div">
                    <li>
                      <a href="<?= BASE_URL ?>bank/setup"
                        ><i data-feather="user"></i><span>Account </span></a
                      >
                    </li>
                   
                    <li>
                      <a href="edit-profile.html"
                        ><i data-feather="settings"></i><span>Settings</span></a
                      >
                    </li>
                    <li>
                      <a href="<?= BASE_URL ?>authenticate/logout"><i data-feather="log-in"> </i><span>Log out</span></a>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
            <script class="result-template" type="text/x-handlebars-template">
              <div class="ProfileCard u-cf">
                <div class="ProfileCard-avatar"><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-airplay m-0"
                  ><path
                      d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"
                    ></path><polygon
                      points="12 15 17 21 7 21 12 15"
                    ></polygon></svg></div>
                <div class="ProfileCard-details">
                  <div class="ProfileCard-realName">{{name}}</div>
                </div>
              </div>
            </script>
            <script class="empty-template" type="text/x-handlebars-template">
              <div class="EmptyMessage">Your search turned up 0 results. This
                most likely means the backend is down, yikes!</div>
            </script>
          </div>
        </div>
        <!-- Page Header Ends                              -->

        
      </div>
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" data-layout="stroke-svg">
          <div>
            <div class="logo-wrapper">
              <a href="<?= BASE_URL; ?>dashboard" 
                ><img
                  class="img-fluid"
                  src="<?= BASE_URL ?>dashboard_assets/images/logo/logo_light.png"
                  alt=""
              /></a>
              <div class="back-btn"><i class="fa fa-angle-left"></i></div>
              <div class="toggle-sidebar">
                <svg class="stroke-icon sidebar-toggle status_toggle middle">
                  <use href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#toggle-icon"></use>
                </svg>
                <svg class="fill-icon sidebar-toggle status_toggle middle">
                  <use
                    href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#fill-toggle-icon"
                  ></use>
                </svg>
              </div>
            </div>
            <div class="logo-icon-wrapper">
              <a href="index.html"
                ><img
                  class="img-fluid"
                  src="<?= BASE_URL ?>dashboard_assets/images/logo/logo-icon.png"
                  alt=""
              /></a>
            </div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow">
                
              </div>
              <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                  <li class="back-btn">
                    <a href="index.html"
                      ><img
                        class="img-fluid"
                        src="<?= BASE_URL ?>dashboard_assets/images/logo/logo-icon.png"
                        alt=""
                    /></a>
                 
                  </li>
                 
                  
                  <li class="sidebar-list">
                    <a
                      class="sidebar-link sidebar-title"
                      href="#"
                    >
                      <svg class="stroke-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#stroke-home"
                        ></use>
                      </svg>
                      <svg class="fill-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#fill-home"
                        ></use></svg
                      ><span class="lan-3">Dashboard </span></a
                    >
                    
                  </li>
                  
                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-8">Category</h6>
                    </div>
                  </li>
                  <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"> </i
                    ><a
                      class="sidebar-link sidebar-title"
                      href="javascript:void(0)"
                    >
                      <svg class="stroke-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#stroke-project"
                        ></use>
                      </svg>
                      <svg class="fill-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#fill-project"
                        ></use></svg
                      ><span> Categories </span></a
                    >
                    <ul class="sidebar-submenu">
                      <li><a href="<?= BASE_URL ?>category/create">Add Category</a></li>
                      <li><a href="<?= BASE_URL ?>category_param/create">Add Category Options</a></li>
                      <li><a href="<?= BASE_URL ?>category/list">View Categories</a></li>                      
                    </ul>
                  </li>

                  <!-- Ecommerce -->
                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-8">Products</h6>
                    </div>
                  </li>
                  <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i
                    ><a
                      class="sidebar-link sidebar-title"
                      href="javascript:void(0)"
                    >
                      <svg class="stroke-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#stroke-ecommerce"
                        ></use>
                      </svg>
                      <svg class="fill-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#fill-ecommerce"
                        ></use></svg
                      ><span>Products</span></a
                    >
                    <ul class="sidebar-submenu">
                      <li><a href="<?= BASE_URL ?>product/create">Add Product</a></li>
                      <li><a href="<?= BASE_URL ?>product/all_products">Product List</a></li>
                      <li><a href="<?= BASE_URL ?>product/my_products">My Products</a></li>                   
                      <li>
                        <label class="badge badge-light-success">New</label
                        ><a href="category.html">Category page</a>
                      </li>
                      <li><a href="product-page.html">Product page</a></li>
                      <li><a href="list-products.html">Product list</a></li>                     
                    </ul>
                  </li>
                  <!-- Orders -->
                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-8">Orders</h6>
                    </div>
                  </li>
                  <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i
                    ><a
                      class="sidebar-link sidebar-title"
                      href="javascript:void(0)"
                    >
                      <svg class="stroke-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#stroke-ecommerce"
                        ></use>
                      </svg>
                      <svg class="fill-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#fill-ecommerce"
                        ></use></svg
                      ><span>Orders</span></a
                    >
                    <ul class="sidebar-submenu">
                      <li><a href="product.html">Pending Orders</a></li>
                      <li><a href="product.html">Cancelled Orders</a></li>
                      <li><a href="product.html">Approved Orders</a></li>
                      <li><a href="order-history.html">Order History</a></li>
                      
                    </ul>
                  </li>


                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-8">Approvals</h6>
                    </div>
                  </li>
                  <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"> </i
                    ><a
                      class="sidebar-link sidebar-title"
                      href="javascript:void(0)"
                    >
                      <svg class="stroke-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#stroke-project"
                        ></use>
                      </svg>
                      <svg class="fill-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#fill-project"
                        ></use></svg
                      ><span> Approvals </span></a
                    >
                    <ul class="sidebar-submenu">
                      <li><a href="projectcreate.html">Approved</a></li>
                      <li><a href="projects.html">Pendingt</a></li>                      
                    </ul>
                  </li>


                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-1"> Users </h6>
                    </div>
                  </li>
                  <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i
                    ><a
                      class="sidebar-link sidebar-title link-nav"
                      href="support-ticket.html"
                    >
                      <svg class="stroke-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#stroke-support-tickets"
                        ></use>
                      </svg>
                      <svg class="fill-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#fill-support-tickets"
                        ></use></svg
                      ><span>Users</span></a
                    >
                  </li>

                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-1"> Support </h6>
                    </div>
                  </li>
                  <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"> </i
                    ><a
                      class="sidebar-link sidebar-title"
                      href="javascript:void(0)"
                    >
                      <svg class="stroke-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#stroke-project"
                        ></use>
                      </svg>
                      <svg class="fill-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#fill-project"
                        ></use></svg
                      ><span> Support Ticket </span></a
                    >
                    <ul class="sidebar-submenu">
                      <li><a href="projectcreate.html">Create Ticket</a></li>
                      <li><a href="support-ticket.html">View Tickets</a></li>                      
                    </ul>
                  </li>
                  

                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-1">General </h6>
                    </div>
                  </li>
                  <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i
                    ><a
                      class="sidebar-link sidebar-title link-nav"
                      href="support-ticket.html"
                    >
                      <svg class="stroke-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#stroke-support-tickets"
                        ></use>
                      </svg>
                      <svg class="fill-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#fill-support-tickets"
                        ></use></svg
                      ><span>My Profile</span></a
                    >
                  </li>
                  
                  <li class="sidebar-list">
                    <i class="fa fa-thumb-tack"></i
                    ><a
                      class="sidebar-link sidebar-title link-nav"
                      href="support-ticket.html"
                    >
                      <svg class="stroke-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#stroke-support-tickets"
                        ></use>
                      </svg>
                      <svg class="fill-icon">
                        <use
                          href="<?= BASE_URL ?>dashboard_assets/svg/icon-sprite.svg#fill-support-tickets"
                        ></use></svg
                      ><span>Settings</span></a
                    >
                  </li>

                 

                </ul>
              </div>
              <div class="right-arrow" id="right-arrow">
                <i data-feather="arrow-right"></i>
              </div>
            </nav>
          </div>
        </div>
        <!-- Page Sidebar Ends-->