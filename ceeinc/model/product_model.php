<?php

class product_model extends Cee_Model
{

    static function store($title, $price, $description, $stock, $photo_paths, $category)
    {
        $key = configurations::systemkey();
        $user_id = users_model::currentUser()['id'];
        $date = date("YmdHis", time());

        $conn = db::createion();
        $conn->begin_transaction(); // Start the transaction

        try {
            // Insert product details
            $sql = "INSERT INTO products SET 
                    title = AES_ENCRYPT('" . $title . "','" . $key . "') ,
                    description = AES_ENCRYPT('" . $description . "','" . $key . "') , 
                    category = AES_ENCRYPT('" . $category . "','" . $key . "') ,
                    price = AES_ENCRYPT('" . $price . "','" . $key . "') ,
                    stock_quantity = AES_ENCRYPT('" . $stock . "','" . $key . "') ,
                    created_at = AES_ENCRYPT('" . $date . "','" . $key . "') ,
                    status = AES_ENCRYPT('1','" . $key . "') ,
                    user_id = AES_ENCRYPT('" . $user_id . "','" . $key . "')";

            $result = $conn->query($sql);
            if (!$result) {
                throw new Exception($conn->error);
            }

            $product_id = $conn->insert_id;

            // Insert each photo path into the database
            foreach ($photo_paths as $photo_path) {
                $photo_sql = "INSERT INTO product_images SET 
                    product_id = AES_ENCRYPT('" . $product_id . "','" . $key . "') ,
                    product_image = AES_ENCRYPT('" . $photo_path . "','" . $key . "')";
                $photo_result = $conn->query($photo_sql);
                if (!$photo_result) {
                    throw new Exception($conn->error);
                }
            }

            $conn->commit(); // Commit the transaction
            return 1;
        } catch (Exception $e) {
            $conn->rollback(); // Rollback the transaction on error
            return $e->getMessage();
        }
    }

    static function update_payment($reg_no, $classm, $session, $term, $component, $amount)
    {
        $key = configurations::systemkey();
        $date = date("YmdHis", time());
        $sql = "UPDATE account_fee SET amount = AES_ENCRYPT('" . $amount . "','" . $key . "')  WHERE classm = AES_ENCRYPT('" . $classm . "','" . $key . "') && session = AES_ENCRYPT('" . $session . "','" . $key . "') &&  term = AES_ENCRYPT('" . $term . "','" . $key . "') &&  reg_no = AES_ENCRYPT('" . $reg_no . "','" . $key . "')";
        $conn = db::createion();
        $result = $conn->query($sql);
        if ($result === true) {
            return 1;
        } else {
            return $conn->error;
        }
    }

    static function getProductList()
    {
        $key = configurations::systemkey();
        $sql = "SELECT id , AES_DECRYPT(title,'" . $key . "') as title, AES_DECRYPT(description,'" . $key . "') as description ,  AES_DECRYPT(price,'" . $key . "') as price, AES_DECRYPT(created_at,'" . $key . "') as created_at, AES_DECRYPT(status,'" . $key . "') as status,  AES_DECRYPT(user_id,'" . $key . "') as user_id FROM products ORDER BY id";

        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        return $result;
    }

    // static function getProductImages($product_id) {
    //     $key = configurations::systemkey();
    //     $sql = "SELECT id , AES_DECRYPT(product_id,'" . $key . "') as product_id  , AES_DECRYPT(product_image,'" . $key . "') as product_image FROM product_images WHERE product_id = AES_ENCRYPT(''.$product_id.'" . $key . "') ";
    //     $result1 = Cee_Model::query($sql);
    //     $result = $result1[0];
    //     $conn = $result1[1];
    //     return $result;
    // }
    static function getProductThumbnail($product_id) {
        $key = configurations::systemkey();
        $sql = "SELECT id , AES_DECRYPT(product_id,'" . $key . "') as product_id  , AES_DECRYPT(product_image,'" . $key . "') as product_image FROM product_images WHERE product_id = AES_ENCRYPT('" . $product_id . "','" . $key . "') LIMIT 1";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        return $result->fetch_assoc();
    }
   

 



}