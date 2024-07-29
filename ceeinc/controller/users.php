<?php



class users extends ceemain
{


	function ceem(){
		$this->view("dashboard/ext/header");
		$this->view("dashboard/users/users");
		$this->view("dashboard/ext/footer");
	}






}

