
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
                                      <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                                    </ol>
                                  </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb area end -->

            <!-- coupon-area start -->
            <section class="coupon-area pb-30">
                <div class="container">
                <div class="row">
                <div class="col-md-6">
                    <div class="coupon-accordion">
                            <!-- ACCORDION START -->
                            <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                            <div id="checkout-login" class="coupon-content">
                            <div class="coupon-info">
                                <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est
                                        sit amet ipsum luctus.</p>
                                <form action="#">
                                        <p class="form-row-first">
                                        <label>Username or email <span class="required">*</span></label>
                                        <input type="text" />
                                        </p>
                                        <p class="form-row-last">
                                        <label>Password <span class="required">*</span></label>
                                        <input type="text" />
                                        </p>
                                        <p class="form-row">
                                        <button class="t-y-btn t-y-btn-grey" type="submit">Login</button>
                                        <label>
                                            <input type="checkbox" />
                                            Remember me
                                        </label>
                                        </p>
                                        <p class="lost-password">
                                        <a href="#">Lost your password?</a>
                                        </p>
                                </form>
                            </div>
                            </div>
                            <!-- ACCORDION END -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="coupon-accordion">
                            <!-- ACCORDION START -->
                            <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                            <div id="checkout_coupon" class="coupon-checkout-content">
                            <div class="coupon-info">
                                <form action="#">
                                        <p class="checkout-coupon">
                                        <input type="text" placeholder="Coupon Code" />
                                        <button class="t-y-btn t-y-btn-grey" type="submit">Apply Coupon</button>
                                        </p>
                                </form>
                            </div>
                            </div>
                            <!-- ACCORDION END -->
                    </div>
                </div>
                </div>
            </div>
            </section>
            <!-- coupon-area end -->

            <!-- checkout-area start -->
            <section class="checkout-area pb-70">
                <div class="container">
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkbox-form">
                                    <h3>Billing Details</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="country-select">
                                                <label>Country <span class="required">*</span></label>
                                                <select>
                                                    <option value="volvo">bangladesh</option>
                                                    <option value="saab">Algeria</option>
                                                    <option value="mercedes">Afghanistan</option>
                                                    <option value="audi">Ghana</option>
                                                    <option value="audi2">Albania</option>
                                                    <option value="audi3">Bahrain</option>
                                                    <option value="audi4">Colombia</option>
                                                    <option value="audi5">Dominican Republic</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>First Name <span class="required">*</span></label>
                                                <input type="text" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Last Name <span class="required">*</span></label>
                                                <input type="text" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Company Name</label>
                                                <input type="text" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Address <span class="required">*</span></label>
                                                <input type="text" placeholder="Street address" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <input type="text" placeholder="Apartment, suite, unit etc. (optional)" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Town / City <span class="required">*</span></label>
                                                <input type="text" placeholder="Town / City" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>State / County <span class="required">*</span></label>
                                                <input type="text" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Postcode / Zip <span class="required">*</span></label>
                                                <input type="text" placeholder="Postcode / Zip" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Email Address <span class="required">*</span></label>
                                                <input type="email" placeholder="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Phone <span class="required">*</span></label>
                                                <input type="text" placeholder="Postcode / Zip" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list create-acc">
                                                <input id="cbox" type="checkbox" />
                                                <label>Create an account?</label>
                                            </div>
                                            <div id="cbox_info" class="checkout-form-list create-account">
                                                <p>Create an account by entering the information below. If you are a returning
                                                    customer please login at the top of the page.</p>
                                                <label>Account password <span class="required">*</span></label>
                                                <input type="password" placeholder="password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="different-address">
                                        <div class="ship-different-title">
                                            <h3>
                                                <label>Ship to a different address?</label>
                                                <input id="ship-box" type="checkbox" />
                                            </h3>
                                        </div>
                                        <div id="ship-box-info">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="country-select">
                                                        <label>Country <span class="required">*</span></label>
                                                        <select>
                                                            <option value="volvo">bangladesh</option>
                                                            <option value="saab">Algeria</option>
                                                            <option value="mercedes">Afghanistan</option>
                                                            <option value="audi">Ghana</option>
                                                            <option value="audi2">Albania</option>
                                                            <option value="audi3">Bahrain</option>
                                                            <option value="audi4">Colombia</option>
                                                            <option value="audi5">Dominican Republic</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-form-list">
                                                        <label>First Name <span class="required">*</span></label>
                                                        <input type="text" placeholder="" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-form-list">
                                                        <label>Last Name <span class="required">*</span></label>
                                                        <input type="text" placeholder="" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="checkout-form-list">
                                                        <label>Company Name</label>
                                                        <input type="text" placeholder="" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="checkout-form-list">
                                                        <label>Address <span class="required">*</span></label>
                                                        <input type="text" placeholder="Street address" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="checkout-form-list">
                                                        <input type="text" placeholder="Apartment, suite, unit etc. (optional)" />
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="checkout-form-list">
                                                        <label>Town / City <span class="required">*</span></label>
                                                        <input type="text" placeholder="Town / City" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-form-list">
                                                        <label>State / County <span class="required">*</span></label>
                                                        <input type="text" placeholder="" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-form-list">
                                                        <label>Postcode / Zip <span class="required">*</span></label>
                                                        <input type="text" placeholder="Postcode / Zip" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-form-list">
                                                        <label>Email Address <span class="required">*</span></label>
                                                        <input type="email" placeholder="" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-form-list">
                                                        <label>Phone <span class="required">*</span></label>
                                                        <input type="text" placeholder="Postcode / Zip" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-notes">
                                            <div class="checkout-form-list">
                                                <label>Order Notes</label>
                                                <textarea id="checkout-mess" cols="30" rows="10"
                                                    placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="your-order mb-30 ">
                                    <h3>Your order</h3>
                                    <?php 
                                    $user_id = users_model::currentUser()['id'];
                                    $cart_items = cart_model::getUserCartItems($user_id);
                                    
                                      if(count($cart_items) < 1) { ?>
                                        <h4 class="text-muted">You have no item in cart</h4>
                                      <?php } else {
                                    ?>
                                    <div class="your-order-table table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Product</th>
                                                    <th class="product-total">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $sub_total = 0;
                                                    $shipping_total = 0;
                                                    foreach($cart_items as $cart) {
                                                        $product = product_model::getProductById($cart['product_id']);
                                                    ?>
                                                    <tr class="cart_item">
                                                        <td class="product-name">
                                                            <?= $product["title"] ?> <strong class="product-quantity"> × <?= $cart["quantity"] ?></strong>
                                                        </td>
                                                        <td class="product-total">
                                                            <span class="amount">$<?= number_format($cart["price"], 2) ?></span>
                                                        </td>
                                                    </tr>
                                                    <?php                       
                                                        $sub_total += $cart["price"];
                                                        $shipping_total += $product["shipping"];
                                                    }
                                                ?>

                                            </tbody>
                                            <tfoot>
                                                <tr class="cart-subtotal">
                                                    <th>Cart Subtotal</th>
                                                    <td><span class="amount">$<?= number_format($sub_total, 2) ?></span></td>
                                                </tr>
                                                <tr class="shipping">
                                                    <th>Shipping</th>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <input type="radio"  name="shipping" />
                                                                <label>
                                                                    Flat Rate: <span class="amount">$<?= number_format($shipping_total, 2); ?></span>
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <input type="radio" name="shipping" />
                                                                <label>Free Shipping:</label>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Order Total</th>
                                                    <td><strong><span class="amount">$<?= number_format($sub_total+$shipping_total, 2); ?></span></strong>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="payment-method">
                                        <div class="accordion" id="checkoutAccordion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="checkoutOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#bankOne" aria-expanded="true" aria-controls="bankOne">
                                                Direct Bank Transfer
                                                </button>
                                            </h2>
                                            <div id="bankOne" class="accordion-collapse collapse show" aria-labelledby="checkoutOne" data-bs-parent="#checkoutAccordion">
                                                <div class="accordion-body">
                                                Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="paymentTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#payment" aria-expanded="false" aria-controls="payment">
                                                Cheque Payment
                                                </button>
                                            </h2>
                                            <div id="payment" class="accordion-collapse collapse" aria-labelledby="paymentTwo" data-bs-parent="#checkoutAccordion">
                                                <div class="accordion-body">
                                                Please send your cheque to Store Name, Store Street, Store Town, Store
                                                State / County, Store
                                                Postcode.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="paypalThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#paypal" aria-expanded="false" aria-controls="paypal">
                                                PayPal
                                                </button>
                                            </h2>
                                            <div id="paypal" class="accordion-collapse collapse" aria-labelledby="paypalThree" data-bs-parent="#checkoutAccordion">
                                                <div class="accordion-body">
                                                Pay via PayPal; you can pay with your credit card if you don’t have a
                                                PayPal account.
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="order-button-payment mt-20">
                                        <button type="submit" class="t-y-btn t-y-btn-grey">Place order</button>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <!-- checkout-area end -->
 
        </main>

 