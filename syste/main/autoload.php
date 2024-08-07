<?php


//autoload files


//autoload models
$dbmodel = ['auth','configurations','users_model','publish_model','category_model', 'bank_model', 'product_model', 'cart_model', 'category_parameter_model', 'billing_model', 'order_model' ];

 


Cee_Model::loadModel($dbmodel);

$thirsparty = array("stripe/vendor/autoload");
Cee_Model::apploading($thirsparty);


