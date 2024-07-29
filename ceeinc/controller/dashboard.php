<?php



class dashboard extends ceemain
{


	function ceem(){
		$this->view("dashboard/ext/header");
		$this->view("dashboard/index");
		$this->view("dashboard/ext/footer");
	}






}

