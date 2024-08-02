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
	function list(){
		$this->view("dashboard/ext/header");
		$this->view("dashboard/category/params/index");
		$this->view("dashboard/ext/footer");
	}

    function store() {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["categ_option"]) && !empty($_POST["categ_option"])  && isset($_POST["parent_category"]) && !empty($_POST["parent_category"]) ) {
            $option = explode('-', Input::post("categ_option"));
            $categ_id = Input::post("parent_category");
            $categ_values = (!Input::post("categ_values")  ? Input::post("categ_values") : '');

            $option_name = $option[0];
            $option_type = $option[1];
            $option_values = (!empty(Input::post("categ_values")) ? Input::post("categ_values") : '');

            $response = category_parameter_model::store($categ_id, $option_name, $option_type, $option_values);
            if($response == 1) {
                $this->msg = ["status" => "success",  "message" => "Category option added successfully."];
            } else {
                $this->msg = ["status" => "error", "message" => "Failed to save category"];
            }              
        } else {
            $this->msg = ["status" => 'error', "message" => "Invalid or missing data"];        
        }
        echo json_encode($this->msg);
    }

    function getOptionListHtml() {    
        $categ_id = isset($_GET['categ_id']) ? intval($_GET['categ_id']) : 0; // Sanitize input
    
        // Fetch category parameters based on categ_id
        $category_parameters = category_parameter_model::param_options($categ_id);
           


                $sn = 1;
                foreach ($category_parameters as $parameter) :                         
                ?>
                <tr>
                    <td><?= $sn ?> </td>
                    <td><?= htmlspecialchars($parameter["param_name"]); ?></td>
                    <td><?= htmlspecialchars($parameter["param_type"]); ?></td>
                    <td><?= htmlspecialchars($parameter["param_values"]); ?></td>
                    <td><?= Date::getDate($parameter["created_at"]); ?></td>
                    <td> 
                        <ul class="action"> 
                            <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                            <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                        </ul>
                    </td>
                </tr>
                <?php $sn++; endforeach; ?>
                           
        <?php 
    }

    
    



}