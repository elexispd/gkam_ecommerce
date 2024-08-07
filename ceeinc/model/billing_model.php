<?php  

class billing_model {
    static function store($full_name, $email, $address, $country, $state, $city, $zip_code, $shipping_method, $note, $is_default) {
        $key = configurations::systemkey();; 
		$date = date("YmdHis",time());
        $sql = "INSERT INTO billing SET 
        full_name = AES_ENCRYPT('".$full_name."','".$key."') , 
        email = AES_ENCRYPT('".$email."','".$key."') , 
        address = AES_ENCRYPT('".$address."','".$key."') , 
        country = AES_ENCRYPT('".$country."','".$key."') , 
        state = AES_ENCRYPT('".$state."','".$key."') , 
        city = AES_ENCRYPT('".$city."','".$key."') ,
        zip_code = AES_ENCRYPT('".$zip_code."','".$key."') , 
        shipping_method = AES_ENCRYPT('".$shipping_method."','".$key."') , 
        note = AES_ENCRYPT('".$note."','".$key."') ,
        is_default = AES_ENCRYPT('".$is_default."','".$key."') ,
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

    static function getBillings() {
        $key = configurations::systemkey();;
        $sql = "SELECT id, 
               AES_DECRYPT(full_name, '".$key."') AS full_name,
               AES_DECRYPT(email , '".$key."') AS email,  
               AES_DECRYPT(country , '".$key."') AS country,
               AES_DECRYPT(address , '".$key."') AS address,
               AES_DECRYPT(state , '".$key."') AS state,
               AES_DECRYPT(city , '".$key."') AS city,
               AES_DECRYPT(zip_code , '".$key."') AS zip_code,
               AES_DECRYPT(shipping_method , '".$key."') AS shipping_method,
               AES_DECRYPT(note , '".$key."') AS note,
               AES_DECRYPT(is_default , '".$key."') AS is_default,
               AES_DECRYPT(created_at , '".$key."') AS created_at
              FROM billing";
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

    static function getBillingByUser($email) {
        $key = configurations::systemkey();;
        $sql = "SELECT id, 
               AES_DECRYPT(full_name, '".$key."') AS full_name,
               AES_DECRYPT(email , '".$key."') AS email,  
               AES_DECRYPT(country , '".$key."') AS country,
               AES_DECRYPT(address , '".$key."') AS address,
               AES_DECRYPT(state , '".$key."') AS state,
               AES_DECRYPT(city , '".$key."') AS city,
               AES_DECRYPT(zip_code , '".$key."') AS zip_code,
               AES_DECRYPT(shipping_method , '".$key."') AS shipping_method,
               AES_DECRYPT(note , '".$key."') AS note,
               AES_DECRYPT(is_default , '".$key."') AS is_default,
               AES_DECRYPT(created_at , '".$key."') AS created_at
                FROM billing WHERE email = AES_ENCRYPT('".$email."','".$key."')";
        $result1 = Cee_Model::query($sql);
        $result = $result1[0];
        $conn =  $result1[1];
        $result = $conn->query($sql);
        return $result->fetch_assoc();
    }

    static function isBillingExist($user) {
        $key = configurations::systemkey();
		$sql = "SELECT * FROM billing  WHERE email = AES_ENCRYPT('" . $user . "','" . $key . "')";
		$result1 = Cee_Model::query($sql);
		$result = $result1[0];
		$conn = $result1[1];

		if ($result->num_rows > 0) {
			return 1;
		} else {

			return 0;

		}
    }
   


}