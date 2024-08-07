<?php

class order extends ceemain
{
    function ceem(){
		$this->view("dashboard/ext/header");
        $this->view("dashboard/orders/index");
        $this->view("dashboard/ext/footer");
	}

	function pending() {
		$this->view("dashboard/ext/header");
        $this->view("dashboard/orders/pending");
        $this->view("dashboard/ext/footer");
	}
	function completed() {
		$this->view("dashboard/ext/header");
        $this->view("dashboard/orders/complete");
        $this->view("dashboard/ext/footer");
	}
	function history() {
		$this->view("dashboard/ext/header");
        $this->view("dashboard/orders/index");
        $this->view("dashboard/ext/footer");
	}

	
	function my_pending() {
		$this->view("dashboard/ext/header");
        $this->view("dashboard/orders/myorders/pending");
        $this->view("dashboard/ext/footer");
	}
	function my_completed() {
		$this->view("dashboard/ext/header");
        $this->view("dashboard/orders/myorders/complete");
        $this->view("dashboard/ext/footer");
	}
	function my_history() {
		$this->view("dashboard/ext/header");
        $this->view("dashboard/orders/myorders/index");
        $this->view("dashboard/ext/footer");
	}

	

}