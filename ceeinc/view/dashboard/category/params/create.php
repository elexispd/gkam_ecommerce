<div class="page-body">
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
    <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Add Category Options</h4>
            <p class="f-m-light mt-1">
              Here is where you create options for categories. These options help to display neceessary fields to users when uploading product
            </p>
               
          </div>
          <div class="card-body">
            <form class="row g-3 needs-validation custom-input" id="categoryForm"  novalidate="" method="post" action="<?= BASE_URL ?>category_para/store" >

              <div class="col-md-6 position-relative">
                <label class="form-label" for="validationTooltip011">Parent Category</label>
                <select name="parent_category" id="validationTooltip011"  class="form-control" >
                  <option value="">--Select Parent--</option>
                  <?php 
                  $parents = category_model::getParentCategory();
                  foreach($parents as $parent): ?>
                    <option value="<?php echo $parent['id'];?>">
                      <?php echo $parent['name'];?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
       
              <div class="col-md-6 position-relative">
                <label class="form-label" for="categ_option">Choose Option</label>
                <select name="categ_option" id="categ_option"  class="form-control" >
                  <option value="">--Select option--</option>
                  <?php 
                  $options = category_parameter_model::getCategOptions();
                  foreach($options as $option): 
                   $name = explode("-",$option)[0];
                  ?>
                    <option value="<?php echo $option;?>">
                      <?php echo $name;?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-6 position-relative d-none" id="values_div">
                <label class="form-label" for="validationTooltip01">Values (optional) </label>
                <input class="form-control" id="validationTooltip01" type="text" name="categ_values" required="">
              </div>

             
              <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>

<script>
    $("#categ_option").change(function(){
        var option = $(this).val();
        var type = option.split("-")[1];
        if(type == 'select') {
            $('#values_div').removeClass('d-none');
        } else {
            $('#values_div').addClass('d-none');
        }
    })
</script>