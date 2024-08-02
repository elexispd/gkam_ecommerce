<?php

class category_model extends Cee_Model
{

    static function store($name, $description, $parent, $icon)
    {
        $key = configurations::systemkey();
        $user_id = users_model::currentUser()['id'];
        $date = date("YmdHis", time());
        $sql = "INSERT INTO categories SET 
                name = AES_ENCRYPT('" . $name . "','" . $key . "') ,
                description = AES_ENCRYPT('" . $description . "','" . $key . "') , 
                parent = AES_ENCRYPT('" . $parent . "','" . $key . "') ,
                created_at = AES_ENCRYPT('" . $date . "','" . $key . "') ,
                icon = AES_ENCRYPT('" . $icon . "','" . $key . "') , 
                status = AES_ENCRYPT('1','" . $key . "') ,
                user_id = AES_ENCRYPT('" . $user_id . "','" . $key . "')  ";
        $conn = db::createion();
        $result = $conn->query($sql);
        if ($result === true) {
            return 1;
        } else {
            return $conn->error;
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

    static function getCategoryList()
    {
        $key = configurations::systemkey();
        $sql = "SELECT id , AES_DECRYPT(name,'" . $key . "') as name, AES_DECRYPT(parent,'" . $key . "') as parent ,  AES_DECRYPT(description,'" . $key . "') as description , AES_DECRYPT(icon,'" . $key . "') as icon,  AES_DECRYPT(created_at,'" . $key . "') as created_at, AES_DECRYPT(status,'" . $key . "') as status,  AES_DECRYPT(user_id,'" . $key . "') as user_id FROM categories";

        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        return $result;
    }
    

    static function getParentCategory() {
        $key = configurations::systemkey();
        $sql = "SELECT id , AES_DECRYPT(name,'" . $key . "') as name  , AES_DECRYPT(parent,'" . $key . "') as parent , AES_DECRYPT(description,'" . $key . "') as description,  AES_DECRYPT(created_at,'" . $key . "') as created_at, AES_DECRYPT(status,'" . $key . "') as status FROM categories WHERE parent = AES_ENCRYPT('','" . $key . "') ";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        return $result;
    }
    static function getCategoryById($id)
    {
        $key = configurations::systemkey();
        $sql = "SELECT id , AES_DECRYPT(name,'" . $key . "') as name , AES_DECRYPT(description,'" . $key . "') as description,  AES_DECRYPT(created_at,'" . $key . "') as created_at, AES_DECRYPT(status,'" . $key . "') as status FROM categories WHERE id = $id";

        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        return $result->fetch_assoc();
    }

    


 



}