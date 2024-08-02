<?php 

class category_param extends ceemain
{

    private $msg = [];

	function ceem(){
		$this->view("dashboard/ext/header");
		$this->view("dashboard/category/params/index");
		$this->view("dashboard/ext/footer");
	}
	function create(){
		$this->view("dashboard/ext/header");
		$this->view("dashboard/category/params/create");
		$this->view("dashboard/ext/footer");
	}



}