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
        
        // Create the base query
        $sql = "
            SELECT SUM(CAST(AES_DECRYPT(quantity, '" . $key . "') AS UNSIGNED)) as total_quantity 
            FROM cart 
            WHERE ";
        
        // Append conditions based on provided user_id and session_id
        if (!empty($user_id)) {
            $sql .= "user_id = AES_ENCRYPT('" . $user_id . "', '" . $key . "') ";
        } else {
            $sql .= "session_id = AES_ENCRYPT('" . $session_id . "', '" . $key . "') ";
        }
    
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        $count = $result->fetch_assoc();
        return $count['total_quantity'];
    }
    
    
    static function getUserCartItems2($user_id) {
        $key = configurations::systemkey();
        $sql = "SELECT id , AES_DECRYPT(product_id,'" . $key . "') as product_id, AES_DECRYPT(price,'" . $key . "') as price,  AES_DECRYPT(quantity,'" . $key . "') as quantity , AES_DECRYPT(session_id,'" . $key . "') as session_id ,   AES_DECRYPT(created_at,'" . $key . "') as created_at,  AES_DECRYPT(user_id,'" . $key . "') as user_id FROM cart WHERE user_id =  AES_ENCRYPT('".$user_id."','" . $key . "') ";

        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        $data = [];
        while($rows = $result->fetch_assoc()) {
            $data[] = $rows;
        }
        return $data;
    }

    static function getUserCartItems($user_id, $session_id) {
        $key = configurations::systemkey();
        
        // Build the base SQL query
        $sql = "
            SELECT 
                id, 
                AES_DECRYPT(product_id, '" . $key . "') as product_id, 
                AES_DECRYPT(price, '" . $key . "') as price, 
                AES_DECRYPT(quantity, '" . $key . "') as quantity, 
                AES_DECRYPT(session_id, '" . $key . "') as session_id, 
                AES_DECRYPT(created_at, '" . $key . "') as created_at, 
                AES_DECRYPT(user_id, '" . $key . "') as user_id 
            FROM cart 
            WHERE ";
    
        // Add conditions based on whether user_id or session_id is available
        if (!empty($user_id)) {
            // User is logged in
            $sql .= "user_id = AES_ENCRYPT('" . $user_id . "', '" . $key . "')";
        } else {
            // User is not logged in, use session_id
            $sql .= "session_id = AES_ENCRYPT('" . $session_id . "', '" . $key . "')";
        }
    
        // Execute the query
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        $data = [];
        while($rows = $result->fetch_assoc()) {
            $data[] = $rows;
        }
        return $data;
    }
    

    static function moveCartItems($session_id, $user_id) {
        $key = configurations::systemkey();
        $conn = db::createion();
    
        // Select items from cart where session ID matches and user ID is empty
        $sql_select = "SELECT * FROM cart WHERE session_id = AES_ENCRYPT('". $session_id . "','". $key. "') AND (user_id IS NULL || AES_ENCRYPT('','". $key. "'))";
        $result = $conn->query($sql_select);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Update each item with the user ID
                $sql_update = "UPDATE cart SET user_id = AES_ENCRYPT('". $user_id . "','". $key. "') WHERE id = " . $row['id'];
                $conn->query($sql_update);
            }
            return 1;
        } else {
            return 0;
        }
    }
    

    static function clearCart() {
        $user_id = users_model::currentUser()['id'];
        $key = configurations::systemkey();
        $conn = db::createion();

        $sql = "DELETE FROM cart WHERE user_id = AES_ENCRYPT('". $user_id . "','". $key. "')";

        return $conn->query($sql);
    }
    
}