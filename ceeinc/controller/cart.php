<?php

class cart extends ceemain
{

    function ceem() {
        $this->view("ext/header");
        $this->view("cart/cart");
        $this->view("ext/footer");
    }

    function addToCart() {
        header('Content-Type: application/json'); // Ensure JSON response header
        ob_start(); // Start output buffering
    
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["product_id"]) && !empty($_POST["product_id"]) && isset($_POST["quantity"]) && !empty($_POST["quantity"])) {
                $product_id = Input::post("product_id");
                $single_price = product_model::getProductPrice($product_id);
                $quantity = Input::post("quantity");
                $price = $single_price * $quantity;
                $session_id = '';
                $user_id = '';
                if (empty(users_model::currentUser())) {
                    $session_id = session_id();
                } else {
                    $user_id = users_model::currentUser()['id'];
                }
                
                // Check if product already exists in cart
                $is_in_cart =  cart_model::itemExistInCart($user_id, $session_id, $product_id);
                if($is_in_cart == false) {
                    $is_saved = cart_model::addToCart($user_id, $session_id, $product_id, $quantity, $price);
                    if ($is_saved === 1) {
                        $response = ["status" => "success", "message" => "Item added to cart with quantity ". $quantity];
                    } else {
                        $response = ["status" => "error", "message" => "Failed to add product to cart."];
                    }
                } else {
                    $is_updated = cart_model::updateCart($user_id, $session_id, $quantity, $product_id, $price);
                    if ($is_updated === true) {
                        $response = ["status" => "success", "message" => "Product quantity updated successfully."];
                    } else {
                        $response = ["status" => "error", "message" => "Failed to update product quantity in cart."];
                    }
                }
                
            } else {
                $response = ["status" => "error", "message" => "Invalid Request Or Parameters"];
            }
        } catch (Exception $e) {
            $response = ["status" => "error", "message" => "An unexpected error occurred."];
        }
    
        // Clear any previous output
        ob_end_clean();
    
        // Send JSON response
        echo json_encode($response);
    }

    function removeFromCart() {
        header('Content-Type: application/json'); // Ensure JSON response header
        ob_start(); // Start output buffering
    
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["product_id"]) && !empty($_POST["product_id"])  ) {
                $product_id = Input::post("product_id");
                $user_id = Input::post("user_id");

                $session_id = '';
                $user_id = '';
                if (empty(users_model::currentUser())) {
                    $session_id = session_id();
                } else {
                    $user_id = users_model::currentUser()['id'];
                }
                
                // Check if product already exists in cart
                $is_in_cart =  cart_model::itemExistInCart($user_id, $session_id, $product_id);
                if($is_in_cart == true) {
                    $is_removed = cart_model::deleteCart($user_id, $session_id, $product_id);
                    if ($is_removed === 1) {
                        $response = ["status" => "success", "message" => "Item removed successfully"];
                    } else {
                        $response = ["status" => "error", "message" => "Failed to remove product from cart."];
                    }
                } else {            
                    $response = ["status" => "error", "message" => "Product is not in cart."];
                }
                
            } else {
                $response = ["status" => "error", "message" => "Invalid Request Or Parameters"];
            }
        } catch (Exception $e) {
            $response = ["status" => "error", "message" => "An unexpected error occurred."];
        }
    
        // Clear any previous output
        ob_end_clean();
    
        // Send JSON response
        echo json_encode($response);
    }

    public function getCartContent() {
        $user_id = !empty(users_model::currentUser()) ? users_model::currentUser()['id'] : '';
        $session_id = empty(users_model::currentUser()) ? session_id() : '';
    
        $cart_no = (!empty(cart_model::getCartItemCount($user_id, $session_id)) ? cart_model::getCartItemCount($user_id, $session_id) : 0);
    
        ob_start();
        if($cart_no > 0) { ?>
        
        <ul id="cart-items-list">
            <li class="d-flex justify-content-between">
                <div class="cart__title">
                    <h4>My Cart</h4>
                    <span>(<?= $cart_no; ?> Item(s) in Cart)</span>
                </div>
                <div class="cart__close">
                    <button type="button" class="cart__close-btn"><i class="fal fa-times"></i></button>
                </div>
            </li>
            
            <li>
                <?php 
                $cart_items = cart_model::getUserCartItems($user_id, $session_id);
                $sub_total = 0;
                foreach($cart_items as $cart) {
                    $product = product_model::getProductById($cart['product_id']);
                    $product_img = product_model::getProductThumbnail($cart['product_id']);
                    $thumbnail = $product_img ? $product_img["product_image"] : BASE_URL.'assets/img/no_image.jpg';
    
                    $excerp = str_replace(' ', '-', $product["title"]); 
                    $sub_total += $cart["price"];
                ?>
                <div class="cart__item d-flex justify-content-between align-items-center">
                    <div class="cart__inner d-flex">
                        <div class="cart__thumb">
                            <a href="<?= BASE_URL . 'product/show?tit=' . $excerp . '&qu=' . $cart['product_id']; ?>">
                                <img src="<?= BASE_URL . $thumbnail ?>" alt="">
                            </a>
                        </div>
                        <div class="cart__details">
                            <h6><a href="<?= BASE_URL . 'product/show?tit=' . $excerp . '&qu=' . $cart['product_id']; ?>"> <?= $product["title"] ?> </a></h6>
                            <div class="cart__price">
                                <span>$<?= number_format($cart["price"], 2) ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="cart__del">
                        <a data-cart="" onclick="removeFromCart(<?= $product['id'] ?>, '<?= BASE_URL ?>')"><i class="fal fa-trash-alt"></i></a>
                    </div>
                </div>
                <?php } ?>
            </li>
            <li>
                <div class="cart__sub d-flex justify-content-between align-items-center">
                    <h6>Subtotal</h6>
                    <span class="cart__sub-total">$<?= number_format($sub_total, 2) ?></span>
                </div>
            </li>
            <li>
                <a href="<?= BASE_URL ?>checkout" class="t-y-btn w-100 mb-10">Proceed to checkout</a>
                <a href="<?= BASE_URL ?>cart" class="t-y-btn t-y-btn-border w-100 mb-10">view add edit cart</a>
            </li>
            
        </ul>
        <?php 
        $cartContentHtml = ob_get_clean();
    
        $details = [
            'cart_html' => $cartContentHtml, 
            'itemNumber' => $cart_no, 
            'price' => $sub_total
        ];
    
        echo json_encode($details);    
    } else {
        $cartContentHtml = ob_get_clean(); ?>

       <?php
       
       $details = 
        ['cart_html' => '
            <ul id="cart-items-list">
        <li class="d-flex justify-content-between">
            <div class="cart__title">
                <h4>My Cart</h4>
                <span>(0 Item in Cart)</span>
            </div>
            <div class="cart__close">
                <button type="button" class="cart__close-btn"><i class="fal fa-times"></i></button>
            </div>
        </li>
        <li>No item in cart</li>
        </ul>
        ', 
            'itemNumber' => 0, 
            'price' => 0
        ];
        echo json_encode($details);
    }
            
    
        
    
    }
    


    public function getMainCartContent() {
        $user_id = !empty(users_model::currentUser()) ? users_model::currentUser()['id'] : '';
        $session_id = empty(users_model::currentUser()) ? session_id() : '';
    
        $cart_no = (!empty(cart_model::getCartItemCount($user_id, $session_id)) ? cart_model::getCartItemCount($user_id, $session_id) : 0);
    
        ob_start();
        if($cart_no > 0) { ?>

                <?php 
                $cart_items = cart_model::getUserCartItems($user_id,$session_id);
                $sub_total = 0;
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

                $cartContentHtml = ob_get_clean();
                    
                $details = [
                    'cart_html' => $cartContentHtml, 
                    'itemNumber' => $cart_no, 
                    'price' => $sub_total
                ];

                echo json_encode($details);
            
            } else { 
                $details = [
                    'cart_html' => `<tr>
                    <td>No Item In Cart</td>
                </tr>`, 
                    'itemNumber' => 0, 
                    'price' => 0
                ];
                echo json_encode($details);
        
             }
            


    
        
    }





}