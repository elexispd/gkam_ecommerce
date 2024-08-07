
<?php
Cee_assets::Assets();
if (empty(users_model::currentUser())) {
    $session_id = session_id();
    $user_id = '';
} else {
    $user_id = users_model::currentUser()['id'];
    $session_id = '';
}
$sub_total = 0;
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
                    <a href="<?= BASE_URL ?>">
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
                                      <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                                      <li class="breadcrumb-item active" aria-current="page">Your Cart</li>
                                    </ol>
                                  </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

         <!-- Cart Area Strat-->
         <section class="cart-area pt-100 pb-100">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                        <form action="#" >
                           <div class="table-content table-responsive">
                              <table class="table">
                                    <thead>
                                       <tr>
                                          <th class="product-thumbnail">Images</th>
                                          <th class="cart-product-name">Product</th>
                                          <th class="product-price">Unit Price</th>
                                          <th class="product-quantity">Quantity</th>
                                          <th class="product-subtotal">Total</th>
                                          <th class="product-remove">Remove</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $cart_no = (!empty(cart_model::getCartItemCount($user_id, $session_id)) ? cart_model::getCartItemCount($user_id, $session_id) : 0);
                                        if($cart_no > 0) {
                                        $cart_items = cart_model::getUserCartItems($user_id, $session_id);
                                        
                                        $shipping_total = 0;
                                        foreach($cart_items as $cart) {
                                            $product = product_model::getProductById($cart['product_id']);
                                            $product_img = product_model::getProductThumbnail($cart['product_id']);
                                            $thumbnail = $product_img ? $product_img["product_image"] : BASE_URL.'assets/img/no_image.jpg';

                                            $excerp = str_replace(' ', '-', $product["title"]); 
                                            $sub_total += $cart["price"];
                                        ?>
                                       <tr>
                                          <td class="product-thumbnail"><a href="<?= BASE_URL . 'product/show?tit=' . $excerp . '&qu=' . $cart['product_id']; ?>"><img src="<?= BASE_URL. $thumbnail ?>" alt=""></a></td>
                                          <td class="product-name"><a href="<?= BASE_URL . 'product/show?tit=' . $excerp . '&qu=' . $cart['product_id']; ?>"><?= $product["title"] ?> </a></td>
                                          <td class="product-price"><span class="amount">$<?=  number_format($cart["price"], 2) ?></span></td>
                                          <td class="product-quantity">
                                                <div class="cart-plus-minus"><input type="text" value="<?=  $cart["quantity"] ?>" /></div>
                                          </td>
                                          <td class="product-subtotal"><span class="amount">$<?=  number_format($cart["price"], 2) ?></span></td>
                                          <td class="product-remove"><a  onclick="removeFromMainCart(<?= $product['id'] ?>, '<?= BASE_URL ?>') " ><i class="fa fa-times"></i></a></td>
                                       </tr>

                                       <?php } 
                                        } else {?>
                                            <h4 class="text-muted">No Items in cart</h4>
                                        <?php }
                                       ?>

                                    </tbody>
                              </table>
                           </div>
                           <div class="row">
                              <div class="col-12">
                                    <div class="coupon-all">
                                       <div class="coupon2">
                                          <button class="t-y-btn t-y-btn-border" name="update_cart" type="submit">Update cart</button>
                                       </div>
                                    </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                       <h2>Cart totals</h2>
                                       <ul class="mb-20">
                                          <li>Subtotal <span class="sub_total">$<?=  number_format($sub_total, 2) ?></span></li>
                                          <li>Total <span class="total">$<?=  number_format($sub_total, 2) ?></span></li>
                                       </ul>
                                       <a class="t-y-btn" href="<?= BASE_URL ?>checkout">Proceed to checkout</a>
                                    </div>
                              </div>
                           </div>
                        </form>
                  </div>
               </div>
            </div>
         </section>
         <!-- Cart Area End-->
 
        </main>

      