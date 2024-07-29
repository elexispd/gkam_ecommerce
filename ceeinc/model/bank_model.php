<?php

class bank_model extends Cee_Model
{


	static function update_bank($username, $status)
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

	static function store($bank_name, $account_name, $account_number, $branch_name, $account_type, $country, $swift_code, $currency)
	{
		$key = configurations::systemkey();
        $user_id = users_model::currentUser()['id'];
		$date = date("YmdHis", time());
		$sql = "INSERT INTO bank_details SET user_id = AES_ENCRYPT('" . $user_id . "','" . $key . "'), bank_name = AES_ENCRYPT('" . $bank_name . "','" . $key . "') , account_name = AES_ENCRYPT('" . $account_name . "','" . $key . "') , account_number = AES_ENCRYPT('" . $account_number . "','" . $key . "') , branch_name = AES_ENCRYPT('" . $branch_name . "','" . $key . "'), country = AES_ENCRYPT('" . $country . "','" . $key . "'), swift_code = AES_ENCRYPT('" . $swift_code . "','" . $key . "'), currency = AES_ENCRYPT('" . $currency . "','" . $key . "'), status = AES_ENCRYPT('0','" . $key . "') , created_at = AES_ENCRYPT('" . $date . "','" . $key . "') ";
		$conn = db::createion();
		$result = $conn->query($sql);
		if ($result === true) {
			return 1;
		} else {
			return $conn->error;
		}
	}

	static function accountExist()
	{
        $user_id = users_model::currentUser()['id'];
		$key = configurations::systemkey();
		$sql = " SELECT * FROM bank_details  WHERE user_id = AES_ENCRYPT('" . $user_id . "','" . $key . "') ";
		$result1 = Cee_Model::query($sql);
		$result = $result1[0];
		$conn = $result1[1];
		if ($result->num_rows > 0) {
			return 1;
		} else {
			return 0;
		}

	}

	


	static function getBankDetails()
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

	static function getBankDetailById($user_id)
	{
		$time = date("YmdHis");
		$key = configurations::systemkey();
		$username = users_model::currentUser()['id'];
		$sql = " SELECT id , AES_DECRYPT(status,'" . $key . "') as status ,  AES_DECRYPT(email,'" . $key . "') as email , AES_DECRYPT(first_name,'" . $key . "') as first_name , AES_DECRYPT(last_name,'" . $key . "') as last_name FROM users WHERE email = AES_ENCRYPT('" . $user_id . "','" . $key . "') ORDER BY id DESC ";
		$result1 = Cee_Model::query($sql);
		$result = $result1[0];
		$conn = $result1[1];
		return $result;

	}


	







}

