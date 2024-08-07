<?php 

class test {

    function getBillings() {
        $result = billing_model::getBillings();
        echo "<pre>";
        print_r($result);
        echo "</pre>";

        $result = order_model::getOrders();
        echo "<pre> Orders::";
        print_r($result);
        echo "</pre>";

        $user_id = users_model::currentUser()['email'];
        $user_billing = Billing_model::getBillingByUser($user_id);
        echo "<pre> Billings::";
        print_r($user_billing);
        echo "</pre>";

        $product_values = product_model::getProductById(8);
        echo "<pre> Product::";
        print_r($product_values);
        echo "</pre>";
    }

    function getOrders() {
        $result = order_model::getOrders();
        echo "<pre>";
        print_r($result);
        echo "</pre>";
    }

    function ceem() {
        if(!empty($user = users_model::currentUser())) {
        echo "yes";
        }else{
            echo "no";
        }
    }

    function generatePayment() {
        \Stripe\Stripe::setApiKey('sk_test_51PjSyUDq80qrBqISRmjNDLxV65kFsOfKakD9tWMon9DvknqIVJKfeM6ZxEHJgRDY02WZHiYciGU3lO85ag00B63600hQ4wLgA6');

            header('Content-Type: application/json');
        $YOUR_DOMAIN = 'http://localhost';

        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Product Name',
                    ],
                    'unit_amount' => 2000, // Amount in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);

        echo json_encode(['id' => $checkout_session->id]);
    }

    function session() {
        $f = cart_model::getCartItemCount('', '');
        print_r($f);
    }

    function update_role() {
        $user_id = 3;
        $role = 'super_admin';
        $result = users_model::update_role($user_id, $role);
        echo $result;
    }


}