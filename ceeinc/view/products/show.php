
<?php 

    $product_id = Input::get('qu');
    $product_title = str_replace('-',' ', Input::get('tit') );
    $product = product_model::getProductByIdTitle($product_title, $product_id);
    $product_images = product_model::getProductImages($product["id"]);

?>
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
                                      <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                                    </ol>
                                  </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

            <!-- product area start -->
            <section class="product__area box-plr-75 pb-70">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-5 col-xl-5 col-lg-5">
                            <div class="product__details-nav d-sm-flex align-items-start">
                                <ul class="nav nav-tabs flex-sm-column justify-content-between" id="productThumbTab" role="tablist">
                                <?php 
                                    foreach ($product_images as $index => $image) { 
                                        $tab_id = 'thumb' . ($index + 1); // Generate a unique ID for each tab
                                        $active_class = ($index === 0) ? 'active' : ''; // Add active class for the first item
                                        ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link <?= $active_class ?>" id="<?= $tab_id ?>-tab" data-bs-toggle="tab"
                                                data-bs-target="#<?= $tab_id ?>" type="button" role="tab" aria-controls="<?= $tab_id ?>"
                                                aria-selected="true">
                                                <img src="<?= BASE_URL . $image['product_image'] ?>" alt="">
                                            </button>
                                        </li>
                                    <?php }
                                    ?>
                                </ul>
                                <div class="product__details-thumb">
                                    <div class="tab-content" id="productThumbContent">
                                    <?php 
                                        foreach ($product_images as $index => $image) {
                                            $tab_id = 'thumb' . ($index + 1); // Generate a unique ID for each tab
                                            $active_class = ($index === 0) ? 'show active' : ''; // Add active class for the first item
                                            ?>
                                            <div class="tab-pane fade <?= $active_class ?>" id="<?= $tab_id ?>" role="tabpanel"
                                                aria-labelledby="<?= $tab_id ?>-tab">
                                                <div class="product__details-nav-thumb">
                                                    <img src="<?= BASE_URL . $image['product_image'] ?>" style="width: 378.5px; height: 378.5px; object-fit:cover;" alt="">
                                                </div>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-7 col-xl-7 col-lg-7">
                            <div class="product__details-wrapper">
                                <div class="product__details">
                                    <h3 class="product__details-title">
                                        <a href="#"><?= $product['title'] ?></a>
                                    </h3>
                                    <div class="product__review d-sm-flex">
                                        <div class="rating rating__shop mb-15 mr-35">
                                            <ul>
                                                <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                <li><a href="#"><i class="fal fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__add-review mb-15">
                                        <span><a href="#">1 Review</a></span>
                                        <span><a href="#">Add Review</a></span>
                                        </div>
                                    </div>
                                    <div class="product__price">
                                        <span class="new">$<?= number_format($product['price'], 2) ?></span>
                                        <span class="old">$<?= !isset($product['old_price']) ? number_format($product['price'], 2) : number_format($product['old_price'], 2) ?></span>
                                    </div>
                                    <div class="product__stock">
                                        <span>Availability :</span>
                                        <span>In Stock</span>
                                    </div>
                                    <div class="product__stock sku mb-30">
                                        <span>SKU:</span>
                                        <span><?= $product['title'] ?></span>
                                    </div>
                                    <div class="product__details-des mb-30">
                                        <p>
                                        <?php 
                                            $paragraphs = explode("\n", $product['description']);
                                            if (isset($paragraphs[1]) && !empty(trim($paragraphs[1]))) {
                                                echo $paragraphs[1];
                                            } else {
                                                echo $paragraphs[0];
                                            }
                                        ?>
                                        </p>
                                    </div>
                                    <div class="product__details-stock">
                                        <?php 
                                            if($product['stock_quantity'] >= 1) { ?>
                                                <h3><span>Hurry Up!</span> Only <?=  $product['stock_quantity']?> product(s) left in stock.</h3>
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                        role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                                        data-width="100%"></div>
                                                </div>
                                            <?php }
                                        ?>
                                    </div>
                                    <div class="product__details-quantity mb-20">
                                        <form action="#">
                                            <div class="pro-quan-area d-lg-flex align-items-center">
                                                <div class="product-quantity mr-20 mb-25">
                                                    <div class="cart-plus-minus p-relative">
                                                    <input type="text" id="quantityInput" value="1" <?= $product['stock_quantity'] == 0 ? 'disabled' : '' ?> />
                                                    </div>
                                                </div>
                                                <div class="pro-cart-btn mb-25">
                                                    <a class="t-y-btn" type="" onclick="addToCart({  url: '<?= BASE_URL ?>product/addToCart', productId: <?= $product['id'] ?>, quantity: document.getElementById('quantityInput').value })" > Add to cart</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="product__details-action">
                                        <ul>
                                            <li><a href="#" title="Add to Wishlist"><i class="fal fa-heart"></i></a></li>
                                            <li><a href="#" title="Compare"><i class="far fa-sliders-h"></i></a></li>
                                            <li><a href="#" title="Print"><i class="fal fa-print"></i></a></li>
                                            <li><a href="#" title="Print"><i class="fal fa-share-alt"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="product__details-des-tab mb-40 mt-110">
                                <ul class="nav nav-tabs" id="productDesTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link active" id="des-tab" data-bs-toggle="tab" data-bs-target="#des" type="button" role="tab" aria-controls="des" aria-selected="true">Details</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Review 5</button>
                                    </li>
                                  </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="tab-content" id="prodductDesTaContent">
                                <div class="tab-pane fade show active" id="des" role="tabpanel" aria-labelledby="des-tab">
                                    <div class="product__details-des-wrapper">
                                        <div class="product__details-des mb-20">
                                            <?= $product['description']; ?>
                                        </div>
                                        
                                        <div class="product__details-des-banner w-img">
                                            <img src="<?= BASE_URL ?>assets/img/shop/product/details/product-details-banner.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                    <div class="product__details-review">
                                        <div class="row">
                                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                <div class="review-wrapper">
                                                    <h3 class="block-title">Customer Reviews</h3>
                                                    <div class="review-item">
                                                        <h3 class="review-title">Awesome product</h3>
                                                        <div class="review-ratings mb-10">
                                                            <div class="review-ratings-single d-flex align-items-center">
                                                                <span>Quality</span>
                                                                <ul>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-ratings-single d-flex align-items-center">
                                                                <span>Price</span>
                                                                <ul>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-ratings-single d-flex align-items-center">
                                                                <span>Value</span>
                                                                <ul>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="review-text">
                                                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti quia eligendi molestias illum libero et.</p>
                                                        </div>
                                                        <div class="review-meta">
                                                            <div class="review-author">
                                                                <span>Review By </span>
                                                                <span>Shahnewaz Sakil</span>
                                                            </div>
                                                            <div class="review-date">
                                                                <span>Posted on</span>
                                                                <span>1/21/20</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="review-item">
                                                        <h3 class="review-title">Nice</h3>
                                                        <div class="review-ratings mb-10">
                                                            <div class="review-ratings-single d-flex align-items-center">
                                                                <span>Quality</span>
                                                                <ul>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-ratings-single d-flex align-items-center">
                                                                <span>Price</span>
                                                                <ul>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-ratings-single d-flex align-items-center">
                                                                <span>Value</span>
                                                                <ul>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="review-text">
                                                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti quia eligendi molestias illum libero et.</p>
                                                        </div>
                                                        <div class="review-meta">
                                                            <div class="review-author">
                                                                <span>Review By </span>
                                                                <span>Selena Gomz</span>
                                                            </div>
                                                            <div class="review-date">
                                                                <span>Posted on</span>
                                                                <span>1/21/20</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="review-item">
                                                        <h3 class="review-title">Best product</h3>
                                                        <div class="review-ratings mb-10">
                                                            <div class="review-ratings-single d-flex align-items-center">
                                                                <span>Quality</span>
                                                                <ul>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-ratings-single d-flex align-items-center">
                                                                <span>Price</span>
                                                                <ul>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="review-ratings-single d-flex align-items-center">
                                                                <span>Value</span>
                                                                <ul>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="review-text">
                                                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti quia eligendi molestias illum libero et.</p>
                                                        </div>
                                                        <div class="review-meta">
                                                            <div class="review-author">
                                                                <span>Review By </span>
                                                                <span>Jonson</span>
                                                            </div>
                                                            <div class="review-date">
                                                                <span>Posted on</span>
                                                                <span>1/21/20</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-4 col-xl-4 col-lg-4">
                                                <div class="review-form">
                                                    <h3>Your Reviewing</h3>
                                                    <p>Australian Certified Organic Royal Gala Apples</p>
                                                    <form action="#">
                                                        <div class="review-input-box mb-15 d-flex align-items-start">
                                                            <h4 class="review-input-title">Your Rating</h4>
                                                            <div class="review-input">
                                                                <div class="review-ratings mb-10">
                                                                    <div class="review-ratings-single d-flex align-items-center">
                                                                        <span>Quality</span>
                                                                        <ul>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="review-ratings-single d-flex align-items-center">
                                                                        <span>Price</span>
                                                                        <ul>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="review-ratings-single d-flex align-items-center">
                                                                        <span>Value</span>
                                                                        <ul>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-input-box d-flex align-items-start">
                                                            <h4 class="review-input-title">Nickname</h4>
                                                            <div class="review-input">
                                                                <input type="text" required>
                                                            </div>
                                                        </div>
                                                        <div class="review-input-box d-flex align-items-start">
                                                            <h4 class="review-input-title">Summary</h4>
                                                            <div class="review-input">
                                                                <input type="text" required>
                                                            </div>
                                                        </div>
                                                        <div class="review-input-box d-flex align-items-start">
                                                            <h4 class="review-input-title">Review</h4>
                                                            <div class="review-input">
                                                                <textarea></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="review-sub-btn">
                                                            <button type="submit" class="t-y-btn t-y-btn-grey">submit review</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            
                        </div>
                    </div>
                </div>
            </section>
            <!-- product area end -->

            <!-- product area start -->
            <section class="product__area box-plr-75 pb-20">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="section__head mb-40">
                                <div class="section__title">
                                    <h3>Best Selling<span>Products</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="product__slider owl-carousel">
                            <?php

                            $best_sellers = product_model::getProducts();

                            foreach ($best_sellers as $best_seller) {
                                $best_seller_img = product_model::getProductImages($best_seller["id"]);
                                $excerp = str_replace(' ', '-', $best_seller["title"]);  
                            ?>
                                <div class="product__item white-bg mb-30">
                                    <div class="product__thumb p-relative">
                                        <a href="<?= BASE_URL . 'product/show?tit=' . $excerp . '&qu=' . $best_seller['id']; ?>" class="w-img">
                                            <img src="<?= BASE_URL . $best_seller_img[0]['product_image'] ?>" alt="product">
                                            <img class="second-img" src="<?= BASE_URL . $best_seller_img[1]['product_image'] ?>" alt="product">
                                        </a>
                                        <div class="product__action p-absolute">
                                            <ul>
                                                <li><a href="#" title="Add to Wishlist"><i class="fal fa-heart"></i></a></li>
                                                <li><a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#productModalId"><i class="fal fa-search"></i></a></li>
                                                <li><a href="#" title="Compare"><i class="far fa-sliders-h"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__content text-center">
                                        <h6 class="product-name">
                                            <a class="product-item-link" href="#"> <?= $best_seller["title"] ?> </a>
                                        </h6>
                                        <div class="rating">
                                            <ul>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <span class="price">$<?= number_format($best_seller["price"], 2) ?></span>
                                    </div>
                                    <div class="product__add-btn">
                                        <a class="t-y-btn" type="" onclick="addToCart({  url: '<?= BASE_URL ?>product/addToCart', productId: <?= $best_seller['id'] ?>, quantity: 1 })" >Add to cart</a>
                                    </div>
                                </div>
                                <?php }

                            ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- product area end -->

            <!-- brand area start -->
            <section class="brand__area">
                <div class="container custom-container">
                    <div class="row align-items-center">
                        <div class="col-xl-12">
                        <div class="brand__slider owl-carousel">
                            <div class="brand__item">
                            <img src="<?= BASE_URL ?>assets/img/brand/brand-1.jpg" alt="">
                            </div>
                            <div class="brand__item">
                            <img src="<?= BASE_URL ?>assets/img/brand/brand-2.jpg" alt="">
                            </div>
                            <div class="brand__item">
                            <img src="<?= BASE_URL ?>assets/img/brand/brand-3.jpg" alt="">
                            </div>
                            <div class="brand__item">
                            <img src="<?= BASE_URL ?>assets/img/brand/brand-4.jpg" alt="">
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- brand area end -->
 
            <!-- shop modal start -->
            <div class="modal fade" id="productModalId" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered product__modal" role="document">
                    <div class="modal-content">
                        <div class="product__modal-wrapper p-relative">
                            <div class="product__modal-close p-absolute">
                                <button data-bs-dismiss="modal"><i class="fal fa-times"></i></button>
                            </div>
                            <div class="product__modal-inner">
                                <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="product__modal-box">
                                        <div class="tab-content" id="modalTabContent">
                                            <div class="tab-pane fade show active" id="nav1" role="tabpanel" aria-labelledby="nav1-tab">
                                                <div class="product__modal-img w-img">
                                                    <img src="<?= BASE_URL ?>assets/img/shop/product/quick-view/quick-view-1.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav2" role="tabpanel" aria-labelledby="nav2-tab">
                                                <div class="product__modal-img w-img">
                                                    <img src="<?= BASE_URL ?>assets/img/shop/product/quick-view/quick-view-2.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav3" role="tabpanel" aria-labelledby="nav3-tab">
                                                <div class="product__modal-img w-img">
                                                    <img src="<?= BASE_URL ?>assets/img/shop/product/quick-view/quick-view-3.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav4" role="tabpanel" aria-labelledby="nav4-tab">
                                                <div class="product__modal-img w-img">
                                                    <img src="<?= BASE_URL ?>assets/img/shop/product/quick-view/quick-view-4.jpg" alt="">
                                                </div>
                                            </div>
                                          </div>
                                        <ul class="nav nav-tabs" id="modalTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link active" id="nav1-tab" data-bs-toggle="tab" data-bs-target="#nav1" type="button" role="tab" aria-controls="nav1" aria-selected="true">
                                                    <img src="<?= BASE_URL ?>assets/img/shop/product/quick-view/nav/quick-nav-1.jpg" alt="">
                                              </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link" id="nav2-tab" data-bs-toggle="tab" data-bs-target="#nav2" type="button" role="tab" aria-controls="nav2" aria-selected="false">
                                                <img src="<?= BASE_URL ?>assets/img/shop/product/quick-view/nav/quick-nav-2.jpg" alt="">
                                              </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link" id="nav3-tab" data-bs-toggle="tab" data-bs-target="#nav3" type="button" role="tab" aria-controls="nav3" aria-selected="false">
                                                <img src="<?= BASE_URL ?>assets/img/shop/product/quick-view/nav/quick-nav-3.jpg" alt="">
                                              </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link" id="nav4-tab" data-bs-toggle="tab" data-bs-target="#nav4" type="button" role="tab" aria-controls="nav4" aria-selected="false">
                                                <img src="<?= BASE_URL ?>assets/img/shop/product/quick-view/nav/quick-nav-4.jpg" alt="">
                                              </button>
                                            </li>
                                          </ul>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="product__modal-content">
                                        <h4><a href="#"><?= $product['title'] ?></a></h4>
                                        <div class="product__modal-des mb-40">
                                            <p>Typi non habent claritatem insitam, est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt </p>
                                        </div>
                                        <div class="product__stock">
                                            <span>Availability :</span>
                                            <span>In Stock</span>
                                        </div>
                                        <div class="product__stock sku mb-30">
                                            <span>SKU:</span>
                                            <span>Samsung C49J89: £875, Debenhams Plus</span>
                                        </div>
                                        <div class="product__review d-sm-flex">
                                            <div class="rating rating__shop mb-15 mr-35">
                                            <ul>
                                                <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                <li><a href="#"><i class="fal fa-star"></i></a></li>
                                                <li><a href="#"><i class="fal fa-star"></i></a></li>
                                            </ul>
                                            </div>
                                            <div class="product__add-review mb-15">
                                            <span><a href="#">1 Review</a></span>
                                            <span><a href="#">Add Review</a></span>
                                            </div>
                                        </div>
                                        <div class="product__price">
                                            <span>$560.00</span>
                                        </div>
                                        <div class="product__modal-form mb-30">
                                            <form action="#">
                                                <div class="pro-quan-area d-lg-flex align-items-center">
                                                    <div class="product-quantity mr-20 mb-25">
                                                        <div class="cart-plus-minus p-relative"><input type="text" value="1" /></div>
                                                    </div>
                                                    <div class="pro-cart-btn mb-25">
                                                        <button class="t-y-btn" type="submit">Add to cart</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="product__modal-links">
                                            <ul>
                                                <li><a href="#" title="Add to Wishlist"><i class="fal fa-heart"></i></a></li>
                                                <li><a href="#" title="Compare"><i class="far fa-sliders-h"></i></a></li>
                                                <li><a href="#" title="Print"><i class="fal fa-print"></i></a></li>
                                                <li><a href="#" title="Print"><i class="fal fa-share-alt"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- shop modal end -->

        </main>

    