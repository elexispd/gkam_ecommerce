<?php 

class cart_model extends Cee_Model
{

    static function addToCart($user_id, $session_id, $product_id, $quantity, $price) {
        $key = configurations::systemkey();
        $date = date("YmdHis", time());
        $sql = "INSERT INTO cart SET 
                    user_id = AES_ENCRYPT('". $user_id . "','". $key. "') ,
                    session_id = AES_ENCRYPT('". $session_id . "','". $key. "') ,
                    product_id = AES_ENCRYPT('". $product_id . "','". $key. "') ,
                    quantity = AES_ENCRYPT('". $quantity . "','". $key. "') ,
                    price = AES_ENCRYPT('". $price . "','". $key. "'),
                    created_at = AES_ENCRYPT('" . $date . "','" . $key . "') ";
        $conn = db::createion();
        $result = $conn->query($sql);
        if ($result === true) {
            return 1;
        } else {
            return $conn->error;
        }
    }

    static function updateCart($user_id, $session_id, $quantity, $product_id, $price) {
        $key = configurations::systemkey();
        $sql = "UPDATE cart 
                SET quantity = AES_ENCRYPT('" . $quantity . "', '" . $key . "') , price = AES_ENCRYPT('" . $price . "', '" . $key . "') 
                WHERE product_id = AES_ENCRYPT('" . $product_id . "', '" . $key . "') 
                AND user_id = AES_ENCRYPT('" . $user_id . "', '" . $key . "') ";
        $conn = db::createion();
        $result = $conn->query($sql);
        if ($result === true) {
            if ($conn->affected_rows > 0) {
                return true;
            } else {
                return "No rows updated.";
            }
        } else {
            return $conn->error;
        }
    }
    
    static function itemExistInCart($user_id, $session_id, $product_id) {
        $key = configurations::systemkey();
        $sql = "SELECT id FROM cart WHERE (user_id = AES_ENCRYPT('". $user_id . "','". $key. "') || session_id = AES_ENCRYPT('". $session_id . "','". $key. "')) AND product_id = AES_ENCRYPT('". $product_id . "','". $key. "') ";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        if($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    static function deleteCart($user_id, $session_id, $product_id) {
        $key = configurations::systemkey();
        $sql = "DELETE FROM cart WHERE (user_id = AES_ENCRYPT('". $user_id . "','". $key. "') || session_id = AES_ENCRYPT('". $session_id . "','". $key. "')) AND product_id = AES_ENCRYPT('". $product_id . "','". $key. "') ";
        $conn = db::createion();
        $result = $conn->query($sql);
        if ($result === true) {
            return 1;
        } else {
            return $conn->error;
        }
    }

    static function getCartItemCount($user_id, $session_id) {
        $key = configurations::systemkey();
        $sql = "
            SELECT SUM(CAST(AES_DECRYPT(quantity, '" . $key . "') AS UNSIGNED)) as total_quantity 
            FROM cart 
            WHERE (user_id = AES_ENCRYPT('" . $user_id . "', '" . $key . "') 
            OR session_id = AES_ENCRYPT('" . $session_id . "', '" . $key . "'))
        ";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        $count = $result->fetch_assoc();
        return $count['total_quantity'];
    }
    
    static function getUserCartItems($user_id) {
        $key = configurations::systemkey();
        $sql = "SELECT id , AES_DECRYPT(product_id,'" . $key . "') as product_id, AES_DECRYPT(price,'" . $key . "') as price,  AES_DECRYPT(quantity,'" . $key . "') as quantity ,  AES_DECRYPT(created_at,'" . $key . "') as created_at,  AES_DECRYPT(user_id,'" . $key . "') as user_id FROM cart WHERE user_id =  AES_ENCRYPT('".$user_id."','" . $key . "') ";

        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        $data = [];
        while($rows = $result->fetch_assoc()) {
            $data[] = $rows;
        }
        return $data;
    }
}