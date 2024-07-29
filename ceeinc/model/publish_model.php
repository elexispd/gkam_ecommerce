<?php

class publish_model extends ceemain
{

    private $error = [];

    // Static connection variable for the class
    private static $conn;

    // Function to set the connection
    static function setConnection($conn) {
        self::$conn = $conn;
    }

	function ceem(){
		$this->view("admin/ext/header");
		$this->view("admin/category/index");
		$this->view("admin/ext/footer");
	}

    function create() {
        $this->view("admin/ext/header");
        $this->view("admin/category/create");
        $this->view("admin/ext/footer");
    }

    function list() {
        $this->view("admin/ext/header");
        $this->view("admin/category/index");
        $this->view("admin/ext/footer");
    }

    static function savePublish($name, $category, $address, $phone, $description, $conn) {
        $key = configurations::systemkey();
        $user = users_model::username();
        $date = date("YmdHis", time());
        $sql = "INSERT INTO publishes SET name = AES_ENCRYPT('" . $name . "','" . $key . "') , description = AES_ENCRYPT('" . $description . "','" . $key . "') , created_at = AES_ENCRYPT('" . $date . "','" . $key . "'), category = AES_ENCRYPT('" . $category . "','" . $key . "'), address = AES_ENCRYPT('" . $address . "','" . $key . "') , phone = AES_ENCRYPT('" . $phone . "','" . $key . "') , status = AES_ENCRYPT('1','" . $key . "') , publisher = AES_ENCRYPT('" . $user . "','" . $key . "')  ";
        $result = $conn->query($sql);
        if ($result === true) {
            return $conn->insert_id;
        } else {
            return $conn->error;
        }
    }

    static function saveFile($name, $publish_id, $conn) {
        $key = configurations::systemkey();
        $user = users_model::username();
        $date = date("YmdHis", time());
        $sql = "INSERT INTO files SET name = AES_ENCRYPT('" . $name . "','" . $key . "') , publish_id = AES_ENCRYPT('" . $publish_id . "','" . $key . "')";
        $result = $conn->query($sql);
        if ($result === true) {
            return 1;
        } else {
            return $conn->error;
        }
    }
    
    static function saveBusinessDays($day, $open_time, $close_time, $publish_id, $conn) {
        $key = configurations::systemkey();
        $user = users_model::username();
        $date = date("YmdHis", time());
        $sql = "INSERT INTO business_days SET day = AES_ENCRYPT('" . $day . "','" . $key . "') , publish_id = AES_ENCRYPT('" . $publish_id . "','" . $key . "') , open_time = AES_ENCRYPT('" . $open_time . "','" . $key . "') , close_time = AES_ENCRYPT('" . $close_time . "','" . $key . "')";
        $conn = self::$conn;
        $result = $conn->query($sql);
        if ($result === true) {
            return 1;
        } else {
            return $conn->error;
        }
    }

    static function getPublishList()
    {
        $key = configurations::systemkey();
        $sql = "SELECT id , AES_DECRYPT(name,'" . $key . "') as caption , AES_DECRYPT(description,'" . $key . "') as description,  AES_DECRYPT(created_at,'" . $key . "') as created_at,  AES_DECRYPT(status,'" . $key . "') as status,  AES_DECRYPT(category,'" . $key . "') as category,  AES_DECRYPT(publisher,'" . $key . "') as publisher FROM publishes";

        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        return $result;
    }

    static function getPublishesByCategory($categoryId)
    {
        $key = configurations::systemkey();
        $sql = "SELECT id , AES_DECRYPT(name,'" . $key . "') as caption , AES_DECRYPT(description,'" . $key . "') as description,  AES_DECRYPT(created_at,'" . $key . "') as created_at,  AES_DECRYPT(status,'" . $key . "') as status,  AES_DECRYPT(publisher,'" . $key . "') as publisher FROM publishes WHERE category = AES_ENCRYPT('" . $categoryId . "','" . $key . "') LIMIT 5";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        return $result;
    }
    
    static function getPublishImages($publish_id)
    {
        $key = configurations::systemkey();
        $sql = "SELECT id , AES_DECRYPT(name,'" . $key . "') as name , AES_DECRYPT(publish_id,'" . $key . "') as publish_id FROM files WHERE publish_id =  AES_ENCRYPT('".$publish_id."','".$key."')";

        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        return $result;
    }

    static function searchPublish($keyword, $category) {
        $key = configurations::systemkey();
        $sql = "SELECT id, AES_DECRYPT(name,'" . $key . "') as caption, AES_DECRYPT(description,'" . $key . "') as description, AES_DECRYPT(created_at,'" . $key . "') as created_at, AES_DECRYPT(status,'" . $key . "') as status, AES_DECRYPT(category,'" . $key . "') as category, AES_DECRYPT(publisher,'" . $key . "') as publisher FROM publishes WHERE AES_DECRYPT(name,'" . $key . "') LIKE '%". $keyword. "%' AND category = AES_ENCRYPT('". $category. "','". $key. "')";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn = $result1[1];
        return $result;
    }
    









}

