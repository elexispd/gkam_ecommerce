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

    function show() {
        $this->view("ext/header");
        $this->view("products/show");
        $this->view("ext/footer");
    }
    function all_products() {
        $this->view("dashboard/ext/header");
        $this->view("dashboard/products/all_products");
        $this->view("dashboard/ext/footer");
    }

    // function store() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["title"]) && !empty($_POST["title"]) && isset($_POST["price"]) && !empty($_POST["price"]) && isset($_POST["category"]) && !empty($_POST["category"]) && isset($_POST["stock"]) && !empty($_POST["stock"])  && isset($_POST["min_quantity"]) && !empty($_POST["min_quantity"])  && isset($_POST["shipping"]) && !empty($_POST["shipping"]) ) {
    //         $title = Input::post("title");
    //         $price = Input::post("price");
    //         $old_price = Input::post("old_price");
    //         $shipping = Input::post("shipping");
    //         $sub_shipping = empty(Input::post("sub_shipping")) ? 0 : Input::post("sub_shipping");
    //         $old_price = empty(Input::post("old_price")) ? $price : Input::post("old_price");
    //         $stock = Input::post("stock");
    //         $min_quantity = Input::post("min_quantity");
    //         $category = Input::post("category");
    //         $description = Input::post("description");
    //         $photos = $_FILES["photos"];

    //         // Save product image files
    //         $photo_paths = $this->saveProductImages($photos);
    
    //         if ($photo_paths) {
    //             $response = product_model::store($title, $price, $old_price, $shipping, $sub_shipping, $description, $stock, $min_quantity, $photo_paths, $category);
    //             if ($response == 1) {
    //                 $this->msg = ["status" => "success", "message" => "Product was successfully created."];
    //                 echo json_encode($this->msg);
    //             } else {
    //                 $this->msg = ["status" => "error", "message" =>  $response];
    //                 echo json_encode($this->msg);
    //             }
    //         } else {
    //             $this->msg = ["status" => "error", "message" => "Failed to save product images."];
    //             echo json_encode($this->msg);
    //         }
    //     } else {
    //         $this->msg = ["status" => 'error', "message" => "Invalid or missing data"];
    //         echo json_encode($this->msg);
    //     }
    // }
    
    function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["title"]) && !empty($_POST["title"]) && isset($_POST["price"]) && !empty($_POST["price"]) && isset($_POST["category"]) && !empty($_POST["category"]) && isset($_POST["stock"]) && !empty($_POST["stock"]) && isset($_POST["min_quantity"]) && !empty($_POST["min_quantity"]) && isset($_POST["shipping"]) && !empty($_POST["shipping"])) {
            $title = Input::post("title");
            $price = Input::post("price");
            $old_price = Input::post("old_price");
            $shipping = Input::post("shipping");
            $sub_shipping = empty(Input::post("sub_shipping")) ? 0 : Input::post("sub_shipping");
            $old_price = empty(Input::post("old_price")) ? $price : Input::post("old_price");
            $stock = Input::post("stock");
            $min_quantity = Input::post("min_quantity");
            $category = Input::post("category");
            $description = Input::post("description");
            $photos = $_FILES["photos"];
            $array_parameters = isset($_POST['parameters']) ? $_POST['parameters'] : [];
    
            // Save product image files
            $photo_paths = $this->saveProductImages($photos);
    
            if ($photo_paths) {
                $result = product_model::store($title, $price, $old_price, $shipping, $sub_shipping, $description, $stock, $min_quantity, $photo_paths, $category, $array_parameters);
    
                if (is_numeric($result)) { // Check if result is product ID
                    $this->msg = ["status" => "success", "message" => "Product was successfully created."];
                    echo json_encode($this->msg);
                } else {
                    $this->msg = ["status" => "error", "message" =>  $result];
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
        
        $dir = "assets/img/products/";
    
        $photo_paths = [];
        foreach ($photos['name'] as $index => $file_name) {
            $file_tmp = $photos['tmp_name'][$index];
            $file_name = uniqid() . '_' . basename($file_name);
            $target_file = $dir . $file_name;
    
            if (move_uploaded_file($file_tmp, $target_file)) {
                $photo_paths[] = $target_file;
            } else {
                return false;
            }
        }
    
        return $photo_paths;
    }
    

    function addToCart() {
        header('Content-Type: application/json'); // Ensure JSON response header
        ob_start(); // Start output buffering
    
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["product_id"]) && !empty($_POST["product_id"]) && isset($_POST["quantity"]) && !empty($_POST["quantity"])) {
                $product_id = Input::post("product_id");
                $single_price = product_model::getProductPrice($product_id);
                $quantity = Input::post("quantity");
                $price = $single_price * $quantity;
                $session_id = '';
                $user_id = '';
                if (empty(users_model::currentUser())) {
                    $session_id = session_id();
                } else {
                    $user_id = users_model::currentUser()['id'];
                }
                
                // Check if product already exists in cart
                $is_in_cart =  cart_model::itemExistInCart($user_id, $session_id, $product_id);
                if($is_in_cart == false) {
                    $is_saved = cart_model::addToCart($user_id, $session_id, $product_id, $quantity, $price);
                    if ($is_saved === 1) {
                        $response = ["status" => "success", "message" => "Item added to cart with quantity ". $quantity];
                    } else {
                        $response = ["status" => "error", "message" => "Failed to add product to cart."];
                    }
                } else {
                    $is_updated = cart_model::updateCart($user_id, $session_id, $quantity, $product_id, $price);
                    if ($is_updated === true) {
                        $response = ["status" => "success", "message" => "Product quantity updated successfully."];
                    } else {
                        $response = ["status" => "error", "message" => "Failed to update product quantity in cart."];
                    }
                }
                
            } else {
                $response = ["status" => "error", "message" => "Invalid Request Or Parameters"];
            }
        } catch (Exception $e) {
            $response = ["status" => "error", "message" => "An unexpected error occurred."];
        }
    
        // Clear any previous output
        ob_end_clean();
    
        // Send JSON response
        echo json_encode($response);
    }


    function getCategoryParameters() {
        if (isset($_GET['categ_id']) && !empty($_GET['categ_id'])) {
            $categ_id = intval($_GET['categ_id']);
            $parameters = category_parameter_model::param_options($categ_id);
            $html = '';
            foreach ($parameters as $parameter) {
                $html .= '<div class="col-md-6 position-relative mb-2">';
                $html .= '<label class="form-label" for="param_' . $parameter['id'] . '">' . htmlspecialchars($parameter['param_name']) . '</label>';
                
                switch ($parameter['param_type']) {
                    case 'textbox':
                        $html .= '<input class="form-control" id="param_' . $parameter['id'] . '" type="text" name="parameters[' . $parameter['id'] . ']" />';
                        break;
                    case 'select':
                        $html .= '<select class="form-control" id="param_' . $parameter['id'] . '" name="parameters[' . $parameter['id'] . ']">';
                        $options = explode(',', $parameter['param_values']);
                        $html .= '<option> --Select --</option>';
                        foreach ($options as $option) {
                            $html .= '<option value="' . htmlspecialchars($option) . '">' . htmlspecialchars($option) . '</option>';
                        }
                        $html .= '</select>';
                        break;
                    case 'multiselect':
                        $html .= '<select class="form-control" id="param_' . $parameter['id'] . '" name="parameters[' . $parameter['id'] . '][]" multiple>';
                        $html .= '<option> --Select --</option>';
                        $options = explode(',', $parameter['param_values']);
                        foreach ($options as $option) {
                            $html .= '<option value="' . htmlspecialchars($option) . '">' . htmlspecialchars($option) . '</option>';
                        }
                        $html .= '</select>';
                        break;
                }
                
                $html .= '</div>';
            }
            
            echo $html;
        } else {
            echo 'Invalid category ID.';
        }
    }
    
    
    

    function test() {
        // $this->msg = [
        //     ["name" => "Puma", "quantity" => 5],
        //     ["name" => "FireFly", "quantity" => 3]
        // ];

        $parameters = category_parameter_model::param_options(4);
            print_r($parameters);
        // echo json_encode($this->msg);
    }








}

