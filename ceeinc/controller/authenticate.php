<?php



class authenticate extends ceemain
{


	function login(){
		$this->view("ext/header");
		$this->view("login");
		$this->view("ext/footer");
	}

	function register(){
		$this->view("ext/header");
		$this->view("register");
		$this->view("ext/footer");
	}

	function store() {
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			if(isset($_POST['cee_csfr_security']) && isset($_POST['cee_csfr_controller']) && isset($_POST['password']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) ){
				Session::confir_csfr();	
				$first_name  = Input::post("first_name");
				$last_name  = Input::post("last_name");
				$email = strtolower(Input::post("email"));
				$password =Input::post("password");
				if(empty($first_name) || empty($last_name) || empty($email) || empty($password) ) {
					Session::set_ceedata("cip_auth","<div class='cee_error'> All fields are required </div>"); 
                    cee_matchapp::redirect("authenticate/register");
				} else {					
					if(users_model::user_exists($email)){
						Session::set_ceedata("cip_auth","<div class='cee_error'> Email already exist </div>"); 
                    	cee_matchapp::redirect("authenticate/register");			
					}else{	
						if(users_model::store($first_name, $last_name, $email, $password) == 1) {
							Session::set_ceedata("cip_auth","<div class='cee_success'> Registration successful Login to continue </div>"); 
                    		cee_matchapp::redirect("authenticate/login");
						} else {
							Session::set_ceedata("cip_auth","<div class='cee_error'> Unable to register. Please try again </div>"); 
                    		cee_matchapp::redirect("authenticate/register");
						}
								
					}
					
				}
				
			}else{			   		   
				Session::set_ceedata("cip_auth","<div class='cee_error'> All parameters are required </div>"); 
                cee_matchapp::redirect("authenticate/register");	  
			}
		} else {
			Session::set_ceedata("cip_auth","<div class='cee_error'> Invalid request method </div>"); 
            cee_matchapp::redirect("authenticate/register"); 
		}
	}

	function login_process() {
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			if(isset($_POST['cee_csfr_security']) && isset($_POST['cee_csfr_controller']) && isset($_POST['password']) && isset($_POST['username']) ){
				Session::confir_csfr();	
				$username  = Input::post("username");
				$password =Input::post("password");
				if(empty($username) || empty($password) ) {
					Session::set_ceedata("cip_auth","<div class='cee_error'> All fields are required </div>"); 
                    cee_matchapp::redirect("authenticate/login");
				} else {					
					if(users_model::auth($username,$password) == 1){
						$user = users_model::getUserByEmail($username)->fetch_assoc();
						Session::set_ceedata("cip_username",$username);	
						Session::set_ceedata("cip_password",$password);	
						cee_matchapp::redirect("dashboard");
					}else{	
						Session::set_ceedata("cip_auth","<div class='cee_error'> Invalid login details</div>"); 
                    	cee_matchapp::redirect("authenticate/login");									
					}
					
				}
				
			}else{			   		   
				Session::set_ceedata("cip_auth","<div class='cee_error'> All parameters are required </div>"); 
                cee_matchapp::redirect("authenticate/login");	  
			}
		} else {
			Session::set_ceedata("cip_auth","<div class='cee_error'> Invalid request method </div>"); 
            cee_matchapp::redirect("authenticate/login"); 
		}
	}

	function logout() {
		Session::unset_ceedata("cip_username");	
		Session::unset_ceedata("cip_password");
		Session::set_ceedata("cip_auth","<div class='cee_success'>Logged Out Successfully</div>");
		cee_matchapp::redirect("authenticate/login");
    }






}

