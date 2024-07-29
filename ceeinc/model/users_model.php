<?php

class users_model extends Cee_Model
{


	static function username()
	{
		if (Session::ceedata("cip_username") == "username") {
			return Session::ceedata("cip_username");
		} else {
			return Session::ceedata("cip_username");
		}

	}

	static function update_status($username, $status)
	{
		$key = configurations::systemkey();
		$date = date("YmdHis", time());
		$sql = "UPDATE users SET status = AES_ENCRYPT('" . $status . "','" . $key . "') WHERE email = AES_ENCRYPT('" . $username . "','" . $key . "')  ";
		$conn = db::createion();
		$result = $conn->query($sql);
		if ($result === true) {
			return 1;
		} else {
			return $conn->error;
		}
	}

	static function store($firstname, $lastname, $email, $password)
	{
		$key = configurations::systemkey();
		$date = date("YmdHis", time());
		$sql = "INSERT INTO users SET password = AES_ENCRYPT('" . $password . "','" . $key . "') , email = AES_ENCRYPT('" . $email . "','" . $key . "') , last_name = AES_ENCRYPT('" . $lastname . "','" . $key . "') , first_name = AES_ENCRYPT('" . $firstname . "','" . $key . "'), status = AES_ENCRYPT('1','" . $key . "') , created_at = AES_ENCRYPT('" . $date . "','" . $key . "') ";
		$conn = db::createion();
		$result = $conn->query($sql);
		if ($result === true) {
			return 1;
		} else {
			return $conn->error;
		}
	}

	static function user_exists($username)
	{


		$key = configurations::systemkey();
		$sql = " SELECT * FROM users  WHERE email = AES_ENCRYPT('" . $username . "','" . $key . "') ORDER BY id DESC ";
		$result1 = Cee_Model::query($sql);
		$result = $result1[0];
		$conn = $result1[1];

		if ($result->num_rows > 0) {
			return 1;
		} else {

			return 0;

		}

	}

	static function auth($username,$password){
    	$key = configurations::systemkey(); 
    	$sql = "SELECT * FROM users  WHERE email = AES_ENCRYPT('".$username."','".$key."') && password = AES_ENCRYPT('".$password."','".$key."') ORDER BY id DESC ";
    	$result1 = Cee_Model::query($sql);
    	$result = $result1[0];
    	$conn =  $result1[1];  	
    	if($result->num_rows > 0 ){
    		return 1;
    		}else{
    		return 0;	
    	}
    }


	static function currentUser()
	{
		$username = users_model::username();
		$time = date("YmdHis");
		$key = configurations::systemkey();
		$sql = "SELECT id , AES_DECRYPT(password,'" . $key . "') as password, AES_DECRYPT(email,'" . $key . "') as username , AES_DECRYPT(first_name,'" . $key . "') as first_name , AES_DECRYPT(last_name,'" . $key . "') as last_name FROM users WHERE email = AES_ENCRYPT('" . $username . "','" . $key . "') ORDER BY id DESC ";
		$result1 = Cee_Model::query($sql);
		$result = $result1[0];
		$conn = $result1[1];
		return $result->fetch_assoc();

	}



	static function single_user()
	{
		$username = users_model::username();
		$time = date("YmdHis");
		$key = configurations::systemkey();
		$sql = " SELECT id , AES_DECRYPT(password,'" . $key . "') as password , AES_DECRYPT(level,'" . $key . "') as level ,AES_DECRYPT(username,'" . $key . "') as username , AES_DECRYPT(firstname,'" . $key . "') as firstname , AES_DECRYPT(lastname,'" . $key . "') as lastname FROM users WHERE username = AES_ENCRYPT('" . $username . "','" . $key . "') ORDER BY id DESC ";

		$result1 = Cee_Model::query($sql);
		$result = $result1[0];
		$conn = $result1[1];
		return $result->fetch_assoc();

	}

	static function getUserByEmail($email)
	{
		$time = date("YmdHis");
		$key = configurations::systemkey();
		//$username = users_model::username();
		$sql = " SELECT id , AES_DECRYPT(status,'" . $key . "') as status ,  AES_DECRYPT(email,'" . $key . "') as email , AES_DECRYPT(first_name,'" . $key . "') as first_name , AES_DECRYPT(last_name,'" . $key . "') as last_name FROM users WHERE email = AES_ENCRYPT('" . $email . "','" . $key . "') ORDER BY id DESC ";
		$result1 = Cee_Model::query($sql);
		$result = $result1[0];
		$conn = $result1[1];
		return $result;

	}


	







}

