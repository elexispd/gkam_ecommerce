<?php

class category extends ceemain
{

    private $msg = [];

	function ceem(){
		$this->view("dashboard/ext/header");
		$this->view("dashboard/category/index");
		$this->view("dashboard/ext/footer");
	}

    function create() {
        $this->view("dashboard/ext/header");
        $this->view("dashboard/category/create");
        $this->view("dashboard/ext/footer");
    }

    function list() {
        $this->view("dashboard/ext/header");
        $this->view("dashboard/category/index");
        $this->view("dashboard/ext/footer");
    }

    function store() {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["name"]) && !empty($_POST["name"]) ) {
            $name = Input::post("name");
            $description = Input::post("description");
            $parent = Input::post("parent_category");
            $icon = $_FILES["photo"];
            
            $target_dir = $_SERVER['DOCUMENT_ROOT'].'/ecommerce/assets/img/category_icons/';
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $file_name = $icon["name"];
            $file_tmp = $icon["tmp_name"];
            // Move and rename file
            $file_name = $name . uniqid() . '_' . basename($file_name);
            $target_file = $target_dir . $file_name;

            if (move_uploaded_file($file_tmp, $target_file)) {
                $response = category_model::store($name, $description, $parent, $target_file);
                if($response == 1) {
                    $this->msg = ["status" => "success",  "message" => "Category was successfully created."];
                    echo json_encode($this->msg);
                } else {
                    $this->msg = ["status" => "error", "message" => "Failed to save category"];
                    echo json_encode($this->msg);
                }
            } else {
                throw new Exception("Failed to move file: " . $file_name);
            }

           
        } else {
            $this->msg = ["status" => 'error', "message" => "Invalid or missing data"];        
            echo json_encode($this->msg);
        }
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

