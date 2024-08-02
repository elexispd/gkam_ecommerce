<?php



class checkout extends ceemain
{

	function ceem(){
		$this->view("ext/header");
		$this->view("checkouts/checkout");
		$this->view("ext/footer");
	}

}

