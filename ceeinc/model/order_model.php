<?php

class order_model extends Cee_Model
{
    static function store($amount, $ad_id, $vendor_id, $quantity, $tax)
    {
        $key = configurations::systemkey();
        $user_id = users_model::currentUser()['id'];
        $date = date("YmdHis", time());
        $order_id = time() + rand(1, 999);

        $conn = db::createion();
        $conn->begin_transaction(); // Start the transaction

        try {
            // Insert order details
            $sql = "INSERT INTO orders SET 
                    user_id = AES_ENCRYPT('" . $user_id . "','" . $key . "') ,
                    product_id = AES_ENCRYPT('" . $ad_id . "','" . $key . "') ,
                    order_id = AES_ENCRYPT('" . $order_id . "','" . $key . "') ,
                    vendor_id = AES_ENCRYPT('" . $vendor_id . "','" . $key . "') , 
                    quantity = AES_ENCRYPT('" . $quantity . "','" . $key . "') ,
                    amount = AES_ENCRYPT('" . $amount . "','" . $key . "') ,
                    tax = AES_ENCRYPT('" . $tax . "','" . $key . "') ,
                    created_at = AES_ENCRYPT('" . $date . "','" . $key . "') ,
                    status = AES_ENCRYPT('0','" . $key . "') ";

            $result = $conn->query($sql);
            if ($result === true) {
                return 1;
            } else {
                return $conn->error;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}