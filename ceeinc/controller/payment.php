<?php



class payment extends ceemain {
    function generatePayment1() {
        try {
            \Stripe\Stripe::setApiKey('sk_test_51PjSyUDq80qrBqISRmjNDLxV65kFsOfKakD9tWMon9DvknqIVJKfeM6ZxEHJgRDY02WZHiYciGU3lO85ag00B63600hQ4wLgA6');

            header('Content-Type: application/json');

            $YOUR_DOMAIN = BASE_URL;

            $input = json_decode(file_get_contents('php://input'), true);
            $cart_items = $input['cart_items'];

            


            $total_shipping = $input['total_shipping'];
            $total_sub_shipping = $input['total_sub_shipping'];

            $line_items = [];
            foreach ($cart_items as $item) {
                $line_items[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $item['title'],
                        ],
                        'unit_amount' => $item['price'], // Amount in cents
                    ],
                    'quantity' => $item['quantity'],
                ];
            }

            // Add shipping and handling as separate line items
            if ($total_shipping > 0) {
                $line_items[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Shipping Fee',
                        ],
                        'unit_amount' => $total_shipping, // Amount in cents
                    ],
                    'quantity' => 1,
                ];
            }
            
            if ($total_sub_shipping > 0) {
                $line_items[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Additional Shipping Fee',
                        ],
                        'unit_amount' => $total_sub_shipping, // Amount in cents
                    ],
                    'quantity' => 1,
                ];
            }

            $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => $YOUR_DOMAIN . '/payment/success',
                'cancel_url' => $YOUR_DOMAIN . '/payment/cancel',
            ]);

            echo json_encode(['id' => $checkout_session->id]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }


    function generatePayment() {

        if(!empty($user = users_model::currentUser())) {
            try {
                $user = $user["email"];
                \Stripe\Stripe::setApiKey('sk_test_51PjSyUDq80qrBqISRmjNDLxV65kFsOfKakD9tWMon9DvknqIVJKfeM6ZxEHJgRDY02WZHiYciGU3lO85ag00B63600hQ4wLgA6');
        
                header('Content-Type: application/json');
        
                $YOUR_DOMAIN = BASE_URL;
        
                $input = json_decode(file_get_contents('php://input'), true);
                $cart_items = $input['cart_items'];
                $billing_details = $input['billing_details'];
        
                $total_shipping = $input['total_shipping'];
                $total_sub_shipping = $input['total_sub_shipping'];
        
                $line_items = [];
                $order_amount = 0;
        
                foreach ($cart_items as $item) {
                    $amount = ($item['price'] * $item['quantity']);
                    $order_amount += $amount;
                    $line_items[] = [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $item['title'],
                            ],
                            'unit_amount' => $item['price'], // Amount in cents
                        ],
                        'quantity' => $item['quantity'],
                    ];
                }
        
                // Add shipping and handling as separate line items
                if ($total_shipping > 0) {
                    $line_items[] = [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Shipping Fee',
                            ],
                            'unit_amount' => $total_shipping, // Amount in cents
                        ],
                        'quantity' => 1,
                    ];
                }
        
                if ($total_sub_shipping > 0) {
                    $line_items[] = [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'Additional Shipping Fee',
                            ],
                            'unit_amount' => $total_sub_shipping, // Amount in cents
                        ],
                        'quantity' => 1,
                    ];
                }
        
                $tax = 0;
        
                // Generate a unique order ID
                $order_id = time() + rand(1, 999);
        
                // Loop through each cart item and store them in the orders table
                foreach ($cart_items as $item) {
                    $product_id = $item['product_id'];
                    $product_values = product_model::getProductById($product_id);
                    $vendor_id = $product_values["user_id"];
        
                    // Store each item with the same order_id
                    $price = ($item['price']/100) * $item["quantity"];
                    $shipping =  ($total_shipping + $total_sub_shipping)/100;
                    $order_result = order_model::store(
                        $price ,
                        $product_id,
                        $vendor_id,
                        $item['quantity'],
                        $shipping,
                        $tax,
                        $order_id
                    );

                }
        

                $checkout_session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => $line_items,
                    'mode' => 'payment',
                    'success_url' => BASE_URL.'payment/success?order_id=' . urlencode($order_id),
                    'cancel_url' => BASE_URL.'payment/cancel?order_id=' . urlencode($order_id),
                ]);

                // Only store billing details if the Stripe session is successfully created
            if (billing_model::isBillingExist($user) == 0) {
                // Store billing details
                billing_model::store(
                    $billing_details['full_name'],
                    $billing_details['email'],
                    $billing_details['address'],
                    $billing_details['country'],
                    $billing_details['state'],
                    $billing_details['city'],
                    $billing_details['zip_code'],
                    '',
                    $billing_details['note'],
                    $billing_details['is_default']
                );
            }
                
        
                echo json_encode(['id' => $checkout_session->id]);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
        } else {
            echo 0;
        }
    }
    
    

    function success() {
        // Retrieve order ID from query parameters if passed
        $orderId = isset($_GET['order_id']) ? $_GET['order_id'] : null;
    
        if ($orderId) {
            // Update order status to 'completed'
            order_model::updateStatus($orderId, 'paid');
            cart_model::clearCart();
            Session::set_ceedata("cip_payment","success"); 
            cee_matchapp::redirect("checkout");
        } else {
            echo 'Payment successful, but order ID not found.';
        }
    }
    

    function cancel() {
        // Retrieve order ID from query parameters if passed
        $orderId = isset($_GET['order_id']) ? $_GET['order_id'] : null;
    
        if ($orderId) {
            // Update order status to 'cancelled'
            order_model::updateStatus($orderId, 'failed');
            Session::set_ceedata("cip_payment","error"); 
            cee_matchapp::redirect("checkout");
        } else {
            echo 'Payment cancelled, but order ID not found.';
        }
    }

    function test() {
        $this->view('checkouts/test');
    }
}


// This endpoint should be a public URL where Stripe can send the POST request
function stripeWebhook() {
    \Stripe\Stripe::setApiKey('sk_test_51PjSyUDq80qrBqISRmjNDLxV65kFsOfKakD9tWMon9DvknqIVJKfeM6ZxEHJgRDY02WZHiYciGU3lO85ag00B63600hQ4wLgA6');

    $endpoint_secret = 'your-webhook-signing-secret';

    $payload = @file_get_contents('php://input');
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

    try {
        $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
        );
    } catch(\UnexpectedValueException $e) {
        // Invalid payload
        http_response_code(400);
        exit();
    } catch(\Stripe\Exception\SignatureVerificationException $e) {
        // Invalid signature
        http_response_code(400);
        exit();
    }

    // Handle the event
    switch ($event['type']) {
        case 'checkout.session.completed':
            $session = $event['data']['object'];
            // Update order status based on session ID
            $orderId = $session['client_reference_id'];
            order_model::updateStatus($orderId, 'completed');
            break;
        case 'checkout.session.async_payment_succeeded':
            $session = $event['data']['object'];
            // Update order status based on session ID
            $orderId = $session['client_reference_id'];
            order_model::updateStatus($orderId, 'completed');
            break;
        case 'checkout.session.async_payment_failed':
            $session = $event['data']['object'];
            // Update order status based on session ID
            $orderId = $session['client_reference_id'];
            order_model::updateStatus($orderId, 'failed');
            break;
        // ... handle other event types
        default:
            echo 'Received unknown event type ' . $event['type'];
    }

    http_response_code(200);
}



