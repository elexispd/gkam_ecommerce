<?php


//autoload files


//autoload models
$dbmodel = ['auth','configurations','users_model','publish_model','category_model', 'bank_model', 'product_model', 'cart_model', 'category_parameter_model' ];

 


Cee_Model::loadModel($dbmodel);


