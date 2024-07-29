<?php



class bank extends ceemain
{

    private $msg;
	function ceem(){
		$this->view("dashboard/ext/header");
		$this->view("dashboard/index");
		$this->view("dashboard/ext/footer");
	}

    function setup(){
        $this->view("dashboard/ext/header");
		$this->view("dashboard/bank/setup-bank");
		$this->view("dashboard/ext/footer");
    }

    function store() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {
			if(isset($_POST['cee_csfr_security']) && isset($_POST['cee_csfr_controller']) && isset($_POST['bank_name']) && isset($_POST['account_name']) && isset($_POST['account_number'])  ){
				Session::confir_csfr();	
				$bank_name  = Input::post("bank_name");
				$account_name  = Input::post("account_name");
				$account_number = Input::post("account_number");
				$branch_name = Input::post("branch_name");
				$account_type = Input::post("account_type");
				$currency = Input::post("currency");
				$swift = Input::post("swift_code");
				$country =Input::post("country");
				if(empty($bank_name) || empty($account_name) || empty($account_number)  ) {
					echo "All fields are required";
				} else {					
					if(bank_model::accountExist()){
                        $this->msg = ["status" => "error", "message" => "Bank details are exist"];
                        echo json_encode($this->msg);		
					}else{	
						if(bank_model::store($bank_name, $account_name, $account_number, $branch_name, $account_type, $country, $swift, $currency) == 1) {
							$this->msg = ["status" => "success", "message" => "Bank details have been uploaded successfully"];
                            echo json_encode($this->msg);
						} else {
							$this->msg = ["status" => "error", "message" => "Unable to upload. Try again later"];
                            echo json_encode($this->msg);
						}
								
					}
					
				}
				
			}else{			   		   
				$this->msg = ["status" => "error", "message" => "All parameters are required"];
                echo json_encode($this->msg);
			}
		} else {
			$this->msg = ["status" => "error", "message" => "Invalid request method"];
            echo json_encode($this->msg);
		}
    }






}

