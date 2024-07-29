<?php

class publish extends ceemain
{

    private $msg = [];


	function ceem(){
		$this->view("admin/ext/header");
		$this->view("admin/publish/index");
		$this->view("admin/ext/footer");
	}

    function create() {
        $this->view("admin/ext/header");
        $this->view("admin/publish/create");
        $this->view("admin/ext/footer");
    }

    function list() {
        $this->view("admin/ext/header");
        $this->view("admin/publish/index");
        $this->view("admin/ext/footer");
    }

    // function publish_process() {
    //     if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && $_POST['category'] && $_POST['address'] && !empty($_POST['address']) && !empty($_POST['name']) && !empty($_POST['category'])) {
    //         $name = Input::post('name');
    //         $category = Input::post('category');
    //         $address = Input::post('address');
    //         $phone = Input::post('phone'); 
    //         $description = Input::post('description');
    //         $photos = $_FILES["photos"];

    //         $response = publish_model::savePublish($name, $category, $address, $phone, $description);
    //         if($response == 1) {
    //             $this->msg = ["status" => "success"];
    //             echo json_encode($this->msg);
    //         } else {
    //             $this->msg = ["status" => "error", "message" => "Failed to save category"];
    //             echo json_encode($this->msg);
    //         }
    //     } else {
    //         $this->msg = ["status"=> "error", "message" => "Invalid Request Or empty Request"];
    //         echo json_encode($this->msg);
    //     }
    // }


// Assuming this is your controller method
    function publish_process() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && $_POST['category'] && $_POST['address'] && !empty($_POST['address']) && !empty($_POST['name']) && !empty($_POST['category'])) {
            $name = Input::post('name');
            $category = Input::post('category');
            $address = Input::post('address');
            $phone = Input::post('phone');
            $description = Input::post('description');
            $photos = $_FILES["photos"];

            // Start a database transaction
            $conn = db::createion();
            $conn->autocommit(false); // Turn off auto-commit to start a transaction

            
            try {
                publish_model::setConnection($conn);
                $publish_id = publish_model::savePublish($name, $category, $address, $phone, $description, $conn);

                if (!empty($photos['name'][0])) {
                    $target_dir = $_SERVER['DOCUMENT_ROOT'].'/idirectory/assets/uploads/published/';
                    if (!is_dir($target_dir)) {
                        mkdir($target_dir, 0777, true);
                    }                 
                    foreach ($photos["name"] as $key => $value) {
                        $file_name = $photos["name"][$key];
                        $file_tmp = $photos["tmp_name"][$key];
                        // Move and rename file
                        $file_name = "prefix_" . uniqid() . '_' . basename($file_name);
                        $target_file = $target_dir . $file_name;

                        if (move_uploaded_file($file_tmp, $target_file)) {
                            // File moved successfully, save to database
                            $response_file = publish_model::saveFile($file_name, $publish_id, $conn);
                            if (!$response_file) {
                                throw new Exception("Failed to save file: " . $file_name);
                            }
                        } else {
                            throw new Exception("Failed to move file: " . $file_name);
                        }
                    }
                }

                $days = ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"];
                $at_least_one_day_set = false;
                foreach ($days as $day) {
                    if (!empty($_POST[$day.'_opening']) && !empty($_POST[$day.'_closing'])) {
                        $at_least_one_day_set = true;
                        break;
                    }
                }

                if ($at_least_one_day_set) {
                    foreach ($days as $day) {
                        if (!empty($_POST[$day.'_opening']) && !empty($_POST[$day.'_closing'])) {
                            $opening = $_POST[$day.'_opening'];
                            $closing = $_POST[$day.'_closing'];
                            $response_days = publish_model::saveBusinessDays($day, $opening, $closing, $publish_id, $conn);
                            if (!$response_days) {
                                throw new Exception("Failed to save business day: " . $day);
                            }
                        }
                    }
                }

                // Commit transaction if all steps succeed
                $conn->commit();
                
                // Response on success
                $this->msg = ["status" => "success"];
                echo json_encode($this->msg);
            } catch (Exception $e) {
                // Rollback transaction on failure
                $conn->rollback();
                // Response on failure
                $this->msg = ["status" => "error", "message" => $e->getMessage()];
                echo json_encode($this->msg);
            } finally {
                // Always close connection after use
                $conn->close();
            }
        } else {
            // Invalid or empty request
            $this->msg = ["status"=> "error", "message" => "Invalid Request Or Empty Request"];
            echo json_encode($this->msg);
        }
    }

    function publish_search() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['keyword']) && isset($_POST['category']) && !empty($_POST['category'])) {
            $keyword = Input::post('keyword');
            $category_id = Input::post('category');
            $search_result = publish_model::searchPublish($keyword, $category_id);
            
            if($search_result->num_rows > 0 ) {
                $data = [];
                while($row = $search_result->fetch_assoc()) {
                    // Get image for the publish
                    $image_result = publish_model::getPublishImages($row['id']);
                    $images = [];
                    while($image_row = $image_result->fetch_assoc()) {
                        $images[] = BASE_URL."assets/uploads/published/".$image_row['name'];
                    }
                    $row['images'] = $images; // Add images to the publish data
                    $data[] = $row;
                }
                $category = category_model::getCategoryById($category_id);
                $this->msg = ["status" => 'success', "message" => ["publishes" => $data, "category" => $category]];
                echo json_encode($this->msg);
            } else {
                $this->msg = ["status" => 'success', "message" => ["publishes" => [], "category" => category_model::getCategoryById($category_id)]];
                echo json_encode($this->msg);
            }
        } else {
            // Invalid or empty request
            $this->msg = ["status"=> "error", "message" => "Invalid Request Or Empty Request"];
            echo json_encode($this->msg);
        }
    }
    
    









}

