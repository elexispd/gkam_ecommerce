<?php

class order extends ceemain
{
    function ceem(){
		$this->view("ext/header");
		$this->view("checkouts/index");
		$this->view("ext/footer");
	}

}