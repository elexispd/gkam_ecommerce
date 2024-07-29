<?php

class product extends ceemain
{

    private $msg = [];

	function ceem(){
		$this->view("dashboard/ext/header");
		$this->view("dashboard/product/my_product");
		$this->view("dashboard/ext/footer");
	}

    function create() {
        $this->view("dashboard/ext/header");
        $this->view("dashboard/products/create");
        $this->view("dashboard/ext/footer");
    }

    function all_products() {
        $this->view("dashboard/ext/header");
        $this->view("dashboard/products/all_products");
        $this->view("dashboard/ext/footer");
    }

    function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["title"]) && !empty($_POST["title"]) && isset($_POST["price"]) && !empty($_POST["price"]) && isset($_POST["category"]) && !empty($_POST["category"]) && isset($_POST["stock"]) && !empty($_POST["stock"])) {
            $title = Input::post("title");
            $price = Input::post("price");
            $stock = Input::post("stock");
            $category = Input::post("category");
            $description = Input::post("description");
            $photos = $_FILES["photos"];
            
            // Save product image files
            $photo_paths = $this->saveProductImages($photos);
    
            if ($photo_paths) {
                $response = product_model::store($title, $price, $description, $stock, $photo_paths, $category);
                if ($response == 1) {
                    $this->msg = ["status" => "success", "message" => "Product was successfully created."];
                    echo json_encode($this->msg);
                } else {
                    $this->msg = ["status" => "error", "message" =>  $response];
                    echo json_encode($this->msg);
                }
            } else {
                $this->msg = ["status" => "error", "message" => "Failed to save product images."];
                echo json_encode($this->msg);
            }
        } else {
            $this->msg = ["status" => 'error', "message" => "Invalid or missing data"];
            echo json_encode($this->msg);
        }
    }
    
    function saveProductImages($photos) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'].'/ecommerce/assets/img/products/';
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
    
        $photo_paths = [];
        foreach ($photos['name'] as $index => $file_name) {
            $file_tmp = $photos['tmp_name'][$index];
            $file_name = uniqid() . '_' . basename($file_name);
            $target_file = $target_dir . $file_name;
    
            if (move_uploaded_file($file_tmp, $target_file)) {
                $photo_paths[] = $target_file;
            } else {
                return false;
            }
        }
    
        return $photo_paths;
    }
    

    function getCategories() {
        $categories = category_model::getCategoryList();
        if($categories->num_rows > 0 ) {
            $data = [];
            while($row = $categories->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo json_encode($this->msg);
        }
        
    }

    function test() {
        $this->msg = [
            ["name" => "Puma", "quantity" => 5],
            ["name" => "FireFly", "quantity" => 3]
        ];

        echo json_encode($this->msg);
    }








}

