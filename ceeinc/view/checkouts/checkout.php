
<?php 
    $full_name = '';
    $email = '';
    $country = '';
    $state = '';
    $city = '';
    $zip_code = '';
    $address = '';
    $note = '';
    $is_default = 0;
    if (empty(users_model::currentUser())) {
        
    } else {
        $user = users_model::currentUser();
        $full_name = $user["first_name"]. " " .$user["last_name"];
        $email = $user["username"];
        $user_billing_details = Billing_model::getBillingByUser($email);



        if(!empty($user_billing_details)) {
            if($user_billing_details["is_default"] == 1) {
                $country = $user_billing_details["country"];
                $state = $user_billing_details["state"];
                $city = $user_billing_details["city"];
                $zip_code = $user_billing_details["zip_code"];
                $address = $user_billing_details["address"];
                $note = $user_billing_details["note"];
                $is_default = $user_billing_details["is_default"];
            } else {
                $country = '';
                $state = '';
                $city = '';
                $zip_code = '';
                $address = '';
                $note = '';
                $is_default = 0;
            }
        } 
    }
    

?>


<style>
    .processing-btn {
    cursor: not-allowed;
    pointer-events: none;
}

.processing-btn::after {
    content: "";
    display: inline-block;
    margin-left: 10px;
}

.loading-icon {
    border: 2px solid #f3f3f3;
    border-radius: 50%;
    border-top: 2px solid #3498db;
    width: 12px;
    height: 12px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
    display: inline-block;
    vertical-align: middle;
    margin-left: 5px;
}

/* Safari */
@-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>

<?php  

$payment_msg = Session::ceedata("cip_payment");


?>

<script>
    if('<?= $payment_msg ?>' == "success") {
        Toastify({
            text: "Payment made successfully",
            duration: 10000,
            close: true,
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            offset: {
                x: 50,
                y: 10,
            },
        }).showToast();
    } else if('<?= $payment_msg ?>' == "error") {
        Toastify({
            text: "Payment failed or cancelled",
            duration: 10000,
            close: true,
            style: {
                background: "linear-gradient(to right, #f1c40f, #f39c12)",
            },
            offset: {
                x: 50,
                y: 10,
            },
        }).showToast();
    }
</script>


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
                    <form action="<?= BASE_URL ?>payment/generatePayment" method="POST" id="billing-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkbox-form">
                                    <h3>Billing Details</h3>
                                        <div class="row">
    
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Full Name <span class="required">*</span></label>
                                                    <input type="text" name="full_name" id="full_name" <?= (!empty($user['id']) ? 'readonly' : '') ?> value="<?= $full_name ?>" required />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Email</label>
                                                    <input type="email" name="email" id="email" <?= (!empty($user['id']) ? 'readonly' : '') ?> value="<?= $email ?>" required />
                                                </div>
                                            </div>

                                            <div class="country-select">
                                                    <label>Country <span class="required">*</span></label>
                                                    <select name="country" id="country" >
                                                        <?php 
                                                            if(!empty($country)) { ?>
                                                                <option value="<?= $country ?>"><?= $country ?></option>
                                                            <?php } else { ?>
                                                                <option value="">Select Country</option>
                                                            <?php }
                                                        ?>
                                                        
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
                                        
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>State / County <span class="required">*</span></label>
                                                    <input type="text" name="state" id="state" value="<?= $state ?>" required />
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Town / City <span class="required">*</span></label>
                                                    <input type="text" name="city" id="city" value="<?= $city ?>" required />
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Address <span class="required">*</span></label>
                                                    <input type="text" name="address" id="address" value="<?= $address ?>" required />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Postcode / Zip <span class="required">*</span></label>
                                                    <input type="text" name="zip_code" id="zip_code" value="<?= $zip_code ?>" required />
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="checkout-form-list create-acc">
                                                    <input id="is_default" type="checkbox" 
                                                    <?php 
                                                        if($is_default == 1) {
                                                            echo 'checked';
                                                        }
                                                    ?>
                                                    name="is_default" />
                                                    <label>Set as default</label>
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
                                        
                                            <div class="order-notes">
                                                <div class="checkout-form-list">
                                                    <label>Order Notes</label>
                                                    <textarea  id="note" name="note" cols="30" rows="10"
                                                        placeholder="Notes about your order, e.g. special notes for delivery."><?= $note ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="your-order mb-30 ">
                                    <h3>Your order</h3>
                                    <?php 
                                    if (empty(users_model::currentUser())) {
                                        $session_id = session_id();
                                        $user_id = '';
                                    } else {
                                        $user_id = users_model::currentUser()['id'];
                                        $session_id = '';
                                    }
                                    $cart_items = cart_model::getUserCartItems($user_id, $session_id);
                                    
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
                                                    $sub_shipping_total = 0;
                                                    $grand_total = 0;
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
                                                        $sub_shipping_total += $product["sub_shipping"];
                                                        $grand_total = $sub_total+$shipping_total+$sub_shipping_total;
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
                                                                <label>Sub Shipping: <span class="amount">$<?= number_format($sub_shipping_total, 2); ?></span></label>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Order Total</th>
                                                    <td><strong><span class="amount">$<?= number_format($grand_total, 2); ?></span></strong>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="payment-method">
                                        <div class="accordion" id="checkoutAccordion">
                                       
                                        <div class="order-button-payment mt-20">
                                        <button type="submit" id="order-btn" class="t-y-btn t-y-btn-grey">Place order</button>
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

 
        <script>
            $("#ship-box").change(function() {
                if ($(this).is(':checked')) {
                    $("input").val('');
                    $("select").val('');
                    $('#is_default').prop('checked', false);
                } else {
                    
                }
            });
        </script>

<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('pk_test_51PjSyUDq80qrBqISLFFz1Auc99k1AJspiSKNYis8yav7vTMo2fg1JhOWdEvNUSCK2oCTqhsbVsN14euo3c2crHK100i5juRtgY');
</script> 


<script>
   $(document).ready(function() {
    $('#billing-form').submit(function(e) {
        e.preventDefault();

        // Disable the submit button and show loading message
        var $orderBtn = $('#order-btn');
        $orderBtn.prop('disabled', true).addClass('processing-btn');
        $orderBtn.html('Processing <div class="loading-icon"></div>');

        var cartItems = [];
        var totalShipping = 0;
        var totalSubShipping = 0;

        <?php foreach($cart_items as $cart) { 
            $product = product_model::getProductById($cart['product_id']);
            $shipping = $product["shipping"];
            $sub_shipping = $product["sub_shipping"];
        ?>
            totalShipping += <?= (int)$shipping ?>;
            totalSubShipping += <?= (int)$sub_shipping ?>;
            cartItems.push({
                product_id: '<?= $cart['product_id'] ?>',
                title: '<?= $product["title"] ?>',
                quantity: <?= (int)$cart["quantity"] ?>,
                price: <?= (int)($product["price"] * 100) ?> // Convert to cents
            });
        <?php } ?>

        var billingDetails = {
            full_name: $('#full_name').val(),
            email: $('#email').val(),
            address: $('#address').val(),
            country: $('#country').val(),
            state: $('#state').val(),
            city: $('#city').val(),
            zip_code: $('#zip_code').val(),
            note: $('#note').val(),
            is_default: $('#is_default').is(':checked') ? 1 : 0
        };

        $.ajax({
            url: '<?= BASE_URL ?>payment/generatePayment',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ 
                cart_items: cartItems, 
                total_shipping: totalShipping * 100, // Convert to cents
                total_sub_shipping: totalSubShipping * 100, // Convert to cents
                billing_details: billingDetails
            }),
            success: function(response) {

                console.log(response);
                if (response.id) {
                    stripe.redirectToCheckout({ sessionId: response.id }).then(function(result) {
                        if (result.error) {
                            alert(result.error.message);
                            // Re-enable the button if there is an error
                            $orderBtn.prop('disabled', false).removeClass('processing-btn').html('Place order');
                        }
                    });
                } 
                else if(response == 0) {
                    Toastify({
                        text: "You need to login to make payment",
                        duration: 10000,
                        close: true,
                        style: {
                            background: "linear-gradient(to right, #f1c40f, #f39c12)",
                        },
                        offset: {
                            x: 50,
                            y: 10,
                        },
                    }).showToast();
                    $orderBtn.prop('disabled', false).removeClass('processing-btn').html('Place order');
                } 
                else {                    
                    Toastify({
                    text: 'Failed to create a checkout session.',
                    duration: 10000,
                    close: true,
                    style: {
                        background: "linear-gradient(to right, #f1c40f, #f39c12)",
                    },
                    offset: {
                        x: 50,
                        y: 10,
                    },
                }).showToast();
                    // Re-enable the button if there is an error
                    $orderBtn.prop('disabled', false).removeClass('processing-btn').html('Place order');
                }
            },
            error: function(error) {
                // console.error('Error:', error);
                Toastify({
                    text: 'Error to create a checkout session.',
                    duration: 10000,
                    close: true,
                    style: {
                        background: "linear-gradient(to right, #f1c40f, #f39c12)",
                    },
                    offset: {
                        x: 50,
                        y: 10,
                    },
                }).showToast();
                
                // Re-enable the button if there is an error
                $orderBtn.prop('disabled', false).removeClass('processing-btn').html('Place order');
            }
        });
    });
});

</script>

<?php		
    Session::set_ceedata("cip_payment","");			 
?>






