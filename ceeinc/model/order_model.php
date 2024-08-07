<?php

class order_model extends Cee_Model
{
    static function store($amount, $ad_id, $vendor_id, $quantity, $shipping, $tax, $order_id) {
        $key = configurations::systemkey();
        $user_id = users_model::currentUser()['id'];
        $date = date("YmdHis", time());

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
                    shipping = AES_ENCRYPT('" . $shipping . "','" . $key . "') ,
                    tax = AES_ENCRYPT('" . $tax . "','" . $key . "') ,
                    created_at = AES_ENCRYPT('" . $date . "','" . $key . "') ,
                    status = AES_ENCRYPT('pending','" . $key . "') ";

            $result = $conn->query($sql);
            if ($result === true) {
                $conn->commit(); // Commit transaction
                return $order_id; // Return the order ID
            } else {
                $conn->rollback(); // Rollback transaction
                return $conn->error;
            }
        } catch (Exception $e) {
            $conn->rollback(); // Rollback transaction
            return $e->getMessage();
        }
    }

    static function updateStatus($orderId, $status) {
        $key = configurations::systemkey();
        $conn = db::createion();

        $sql = "UPDATE orders SET 
                status = AES_ENCRYPT('" . $status . "','" . $key . "') 
                WHERE order_id = AES_ENCRYPT('" . $orderId . "','" . $key . "')";

        return $conn->query($sql);
    }

    static function getOrders() {
        $key = configurations::systemkey();
        $sql = "SELECT id, 
               AES_DECRYPT(user_id, '".$key."') AS user_id,
               AES_DECRYPT(order_id, '".$key."') AS order_id,
               AES_DECRYPT(product_id, '".$key."') AS product_id,  
               AES_DECRYPT(vendor_id, '".$key."') AS vendor_id,
               AES_DECRYPT(quantity, '".$key."') AS quantity,
               AES_DECRYPT(shipping, '".$key."') AS shipping,
               AES_DECRYPT(tax, '".$key."') AS tax,
               AES_DECRYPT(amount, '".$key."') AS amount,
               AES_DECRYPT(status, '".$key."') AS status,
               AES_DECRYPT(created_at, '".$key."') AS created_at
              FROM orders";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn =  $result1[1];
        $result = $conn->query($sql);
        $data = [];
    
        while ($rows = $result->fetch_assoc()) {
            $data[] = $rows;
        }
    
        return $data;
    }
    static function getOrdersById($order_id) {
        $key = configurations::systemkey();
        $sql = "SELECT id, 
               AES_DECRYPT(user_id, '".$key."') AS user_id,
               AES_DECRYPT(order_id, '".$key."') AS order_id,
               AES_DECRYPT(product_id, '".$key."') AS product_id,  
               AES_DECRYPT(vendor_id, '".$key."') AS vendor_id,
               AES_DECRYPT(quantity, '".$key."') AS quantity,
               AES_DECRYPT(shipping, '".$key."') AS shipping,
               AES_DECRYPT(tax, '".$key."') AS tax,
               AES_DECRYPT(amount, '".$key."') AS amount,
               AES_DECRYPT(status, '".$key."') AS status,
               AES_DECRYPT(created_at, '".$key."') AS created_at
              FROM orders WHERE order_id  = AES_ENCRYPT('".$order_id."','".$key."')";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn =  $result1[1];
        $result = $conn->query($sql);
        $data = [];
    
        while ($rows = $result->fetch_assoc()) {
            $data[] = $rows;
        }
    
        return $data;
    }
    static function getOrdersByUser($user_id) {
        $key = configurations::systemkey();
        $sql = "SELECT id, 
               AES_DECRYPT(user_id, '".$key."') AS user_id,
               AES_DECRYPT(order_id, '".$key."') AS order_id,
               AES_DECRYPT(product_id, '".$key."') AS product_id,  
               AES_DECRYPT(vendor_id, '".$key."') AS vendor_id,
               AES_DECRYPT(quantity, '".$key."') AS quantity,
               AES_DECRYPT(shipping, '".$key."') AS shipping,
               AES_DECRYPT(tax, '".$key."') AS tax,
               AES_DECRYPT(amount, '".$key."') AS amount,
               AES_DECRYPT(status, '".$key."') AS status,
               AES_DECRYPT(created_at, '".$key."') AS created_at
              FROM orders WHERE user_id  = AES_ENCRYPT('".$user_id."','".$key."')";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn =  $result1[1];
        $result = $conn->query($sql);
        $data = [];
    
        while ($rows = $result->fetch_assoc()) {
            $data[] = $rows;
        }
    
        return $data;
    }
    static function getUserOrderSales($user_id) {
        $key = configurations::systemkey();
        $sql = "SELECT id, 
               AES_DECRYPT(user_id, '".$key."') AS user_id,
               AES_DECRYPT(order_id, '".$key."') AS order_id,
               AES_DECRYPT(product_id, '".$key."') AS product_id,  
               AES_DECRYPT(vendor_id, '".$key."') AS vendor_id,
               AES_DECRYPT(quantity, '".$key."') AS quantity,
               AES_DECRYPT(shipping, '".$key."') AS shipping,
               AES_DECRYPT(tax, '".$key."') AS tax,
               AES_DECRYPT(amount, '".$key."') AS amount,
               AES_DECRYPT(status, '".$key."') AS status,
               AES_DECRYPT(created_at, '".$key."') AS created_at
              FROM orders WHERE vendor_id  = AES_ENCRYPT('".$user_id."','".$key."')";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn =  $result1[1];
        $result = $conn->query($sql);
        $data = [];
    
        while ($rows = $result->fetch_assoc()) {
            $data[] = $rows;
        }
    
        return $data;
    }
    static function getOrdersByStatus($status) {
        $key = configurations::systemkey();
        $sql = "SELECT id, 
               AES_DECRYPT(user_id, '".$key."') AS user_id,
               AES_DECRYPT(order_id, '".$key."') AS order_id,
               AES_DECRYPT(product_id, '".$key."') AS product_id,  
               AES_DECRYPT(vendor_id, '".$key."') AS vendor_id,
               AES_DECRYPT(quantity, '".$key."') AS quantity,
               AES_DECRYPT(shipping, '".$key."') AS shipping,
               AES_DECRYPT(tax, '".$key."') AS tax,
               AES_DECRYPT(amount, '".$key."') AS amount,
               AES_DECRYPT(status, '".$key."') AS status,
               AES_DECRYPT(created_at, '".$key."') AS created_at
              FROM orders WHERE status  = AES_ENCRYPT('".$status."','".$key."')";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn =  $result1[1];
        $result = $conn->query($sql);
        $data = [];
    
        while ($rows = $result->fetch_assoc()) {
            $data[] = $rows;
        }
    
        return $data;
    }
    static function getUserOrdersByStatus($user_id, $status) {
        $key = configurations::systemkey();
        $sql = "SELECT id, 
               AES_DECRYPT(user_id, '".$key."') AS user_id,
               AES_DECRYPT(order_id, '".$key."') AS order_id,
               AES_DECRYPT(product_id, '".$key."') AS product_id,  
               AES_DECRYPT(vendor_id, '".$key."') AS vendor_id,
               AES_DECRYPT(quantity, '".$key."') AS quantity,
               AES_DECRYPT(shipping, '".$key."') AS shipping,
               AES_DECRYPT(tax, '".$key."') AS tax,
               AES_DECRYPT(amount, '".$key."') AS amount,
               AES_DECRYPT(status, '".$key."') AS status,
               AES_DECRYPT(created_at, '".$key."') AS created_at
              FROM orders WHERE status  = AES_ENCRYPT('".$status."','".$key."') AND user_id  = AES_ENCRYPT('".$user_id."','".$key."')";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn =  $result1[1];
        $result = $conn->query($sql);
        $data = [];
    
        while ($rows = $result->fetch_assoc()) {
            $data[] = $rows;
        }
    
        return $data;
    }

    static function getUserOrderSalesByStatus($user_id, $status) {
        $key = configurations::systemkey();
        $sql = "SELECT id, 
               AES_DECRYPT(user_id, '".$key."') AS user_id,
               AES_DECRYPT(order_id, '".$key."') AS order_id,
               AES_DECRYPT(product_id, '".$key."') AS product_id,  
               AES_DECRYPT(vendor_id, '".$key."') AS vendor_id,
               AES_DECRYPT(quantity, '".$key."') AS quantity,
               AES_DECRYPT(shipping, '".$key."') AS shipping,
               AES_DECRYPT(tax, '".$key."') AS tax,
               AES_DECRYPT(amount, '".$key."') AS amount,
               AES_DECRYPT(status, '".$key."') AS status,
               AES_DECRYPT(created_at, '".$key."') AS created_at
              FROM orders WHERE status  = AES_ENCRYPT('".$status."','".$key."') AND vendor_id  = AES_ENCRYPT('".$user_id."','".$key."')";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn =  $result1[1];
        $result = $conn->query($sql);
        $data = [];
    
        while ($rows = $result->fetch_assoc()) {
            $data[] = $rows;
        }
    
        return $data;
    }


}
