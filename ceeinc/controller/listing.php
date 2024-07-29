<?php



class listing extends ceemain
{


	function ceem(){
		$this->view("ext/header");
		$this->view("all-listing-filterccol");
		$this->view("ext/footer");
	}

	function detail(){
		// $this->view("ext/header");
		$this->view("detail");
		// $this->view("ext/footer");
	}
	function restaurant_detail(){
		$this->view("ext/header");
		$this->view("detail-restaurant");
		$this->view("ext/footer");
	}
	function shop_detail(){
		$this->view("ext/header");
		$this->view("detail-shop");
		$this->view("ext/footer");
	}
	function hotel_detail(){
		$this->view("ext/header");
		$this->view("detail-hotel");
		$this->view("ext/footer");
	}
	function isotope(){
		$this->view("ext/header");
		$this->view("listings-isotope");
		$this->view("ext/footer");
	}






}

