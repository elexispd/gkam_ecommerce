<?php  

class category_parameter_model extends category_model {
    static function store($category_id, $name, $type, $param_option) {
        $key = configurations::systemkey();; 
		$date = date("YmdHis",time());
        $sql = "INSERT INTO category_parameters SET 
        category_id = AES_ENCRYPT('".$category_id."','".$key."') , 
        param_name = AES_ENCRYPT('".$name."','".$key."') , 
        param_type = AES_ENCRYPT('".$type."','".$key."') , 
        param_values = AES_ENCRYPT('".$param_option."','".$key."') , 
        created_at = AES_ENCRYPT('".$date."','".$key."')";
        try {     
            $conn = db::createion();	
	        $result = $conn->query($sql);	 
            if ($result == true & mysqli_affected_rows($conn) > 0) {
                return true;
            } else {
                return false;
            }	
        } catch (\Throwable $e) {
            return "Database Error: " . $e->getMessage();
        }  
    }


    static function update($id, $category_id, $option, $param_option) {
        $status = 1;
	    $key = configurations::systemkey();;
        $date = date("YmdHis",time());
		$sql = "UPDATE category_parameters SET = category_id = AES_ENCRYPT('".$category_id."','".$key."') , 
        param_option = AES_ENCRYPT('".$option."','".$key."') , 
        param_values = AES_ENCRYPT('".$param_option."','".$key."') , 
        updated_at = AES_ENCRYPT('".$date."','".$key."')";
        
        try {
            $conn = db::createion();
            
            $result = $conn->query($sql);
            
            if ($result === true) {
                if (mysqli_affected_rows($conn) > 0) {
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return $conn->error;
            }
        } catch (\Throwable $e) {
            return "Database Error: " . $e->getMessage();
        }
        

	}

    static function param_options($categ_id) {
        $key = configurations::systemkey();;
        $sql = "SELECT id, 
               AES_DECRYPT(category_id, '".$key."') AS categ_id,
               AES_DECRYPT(param_name , '".$key."') AS param_name,  
               AES_DECRYPT(param_values , '".$key."') AS param_values,
               AES_DECRYPT(param_type , '".$key."') AS param_type,
               AES_DECRYPT(created_at , '".$key."') AS created_at
              FROM category_parameters WHERE category_id = AES_ENCRYPT('".$categ_id."','".$key."')";
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
    static function paramOptionsById($id) {
        $key = configurations::systemkey();;
        $sql = "SELECT id, 
               AES_DECRYPT(category_id, '".$key."') AS categ_id,
               AES_DECRYPT(param_name , '".$key."') AS param_name,  
               AES_DECRYPT(param_values , '".$key."') AS param_values,
               AES_DECRYPT(param_type , '".$key."') AS param_type,
               AES_DECRYPT(created_at , '".$key."') AS created_at
              FROM category_parameters WHERE id = $id";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn =  $result1[1];
        $result = $conn->query($sql);
    	$data =$result->fetch_assoc();
        return $data;
    }

    static function getCategOptions() {
		
		$options = [
			"Type-select-type",
			"Condition-select-condition",
			"Gender-select-gender", 
			"Age-textbox-age",
			"Brand-select-brand", 
			"Materials-multiselect-materials",
			"Weight-textbox-weight",
			"Length-textbox-length",
			"Width-textbox-width",
			"Height-textbox-height",
			"Quantity-textbox-quantity",
			"Colour-textbox-colour",
			"Breed-select-breed",
			"Breed Type-multiselect-breed_type",
			"Size-textbox-size",
			"Upper Material-multiselect-upper_material",
			"Outsole Material-multiselect-outsole_material",
			"Fastening-multiselect-fastening",
			"Closure-textbox-closure",
			"Capacity-select-capacity",
			"Exchange-select-exchange",
			"Movement-select-movement",
			"Display-select-display",
			"Case Material-select-case_material",
			"Band Material-select-band_material",
			"Features-multiselect-features",
			"Style-select-style",
			"Company Name-textbox-company_name",
			"Job Type-select-job_type",
			"Career Level-textbox-career-level",
			"Minimum Experience-textbox-min_experience",
			"Application Deadline-textbox-app_deadline",
			"Address-textbox-address",
			"Furnishing-select-furnishing",
			"Property Type-select-property_type",
			"Parking Space-textbox-parking_space",
			"Secured Parking-select-secured_parking",
			"Square Meter-select-square_meter",
			"Minimum Rent Time-textbox-min_rent_time",
			"Age Level-textbox-age_level",
			"Make-textbox-make",
			"Model-textbox-model",
			"Year of Manufacture-textbox-manufacture_year",
			"Trim-textbox-trim",
			"Second Condition-textbox-second_condition",
			"Transmission-select-transmission",
			"Mileage-textbox-mileage",
			"Vin Number-textbox-vin_number",
			"Registered-select-registered",
			"Body-select-body",
			"Fuel-select-fuel",
			"Number of Cylinders-select-number_of_cylinders",
			"Engine Size-textbox-engine_size",
			"Horse Power-textbox-horse_power"
		];
		
	
		return $options;
	}























}