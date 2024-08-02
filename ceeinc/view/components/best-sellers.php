<section class="best__sell pt-15 pb-40 grey-bg-2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section__head d-md-flex justify-content-between mb-40">
                    <div class="section__title">
                        <h3>Best Selling<span>Products</span></h3>
                    </div>
                    <div class="product__nav-tab mr-75">
                        <ul class="nav nav-tabs" id="best-sell-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="new-tab" data-bs-toggle="tab" data-bs-target="#new"
                                    type="button" role="tab" aria-controls="new" aria-selected="true">New
                                    Arrival</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="featured-tab" data-bs-toggle="tab"
                                    data-bs-target="#featured" type="button" role="tab" aria-controls="featured"
                                    aria-selected="false">Featured</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="hot-tab" data-bs-toggle="tab" data-bs-target="#hot"
                                    type="button" role="tab" aria-controls="hot" aria-selected="false">Hot Sale</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="random-tab" data-bs-toggle="tab" data-bs-target="#random"
                                    type="button" role="tab" aria-controls="random"
                                    aria-selected="false">Random</button>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>


    </div>
</section>

<div class="row">
    <div class="col-xl-12">
        <div class="tab-content" id="best-sell">
            <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
                <div class="product__slider owl-carousel">
                    <?php

                    $best_sellers = product_model::getProducts();

                    foreach ($best_sellers as $best_seller) {
                        $best_seller_img = product_model::getProductImages($best_seller["id"]);
                        ?>
                        <div class="product__item white-bg">
                            <div class="product__thumb p-relative">
                                <a href="<?= BASE_URL ?>product/show" class="w-img">
                                    <img src="<?= BASE_URL . $best_seller_img[0]['product_image'] ?>" alt="product">
                                    <img class="second-img" src="<?= BASE_URL . $best_seller_img[1]['product_image'] ?>"
                                        alt="product">
                                </a>
                                <div class="product__action p-absolute">
                                    <ul>
                                        <li><a href="#" title="Add to Wishlist"><i class="fal fa-heart"></i></a></li>
                                        <li><a href="#" title="Quick View" data-bs-toggle="modal"
                                                data-bs-target="#productModalId"><i class="fal fa-search"></i></a></li>
                                        <li><a href="#" title="Compare"><i class="far fa-sliders-h"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product__content text-center">
                                <h6 class="product-name">
                                    <a class="product-item-link" href="product-details.html">
                                        <?= $best_seller["title"] ?>
                                    </a>
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
                                <button type="button">Add to Cart</button>
                            </div>
                        </div>
                    <?php }

                    ?>

                </div>
            </div>

        </div>
    </div>
</div>