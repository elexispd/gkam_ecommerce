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
            <form action="<?= BASE_URL ?>category_param/store" class="row g-3" id="categoryForm"  novalidate="" method="post">
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
                    <label class="form-label" for="validationTooltip01">Values (searate with coma) </label>
                    <input class="form-control" placeholder="Used,New"  id="validationTooltip01" type="text" name="categ_values">
                </div>
                <div class="col-12">    
                <button class="btn btn-primary" type="submit">Submit</button>
                <input type="text" id="base_url" value="<?= BASE_URL ?>category_param/store" hidden>
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
        if(type == 'select' || type == 'multiselect') {
            $('#values_div').removeClass('d-none');
        } else {
            $('#values_div').addClass('d-none');
        }
    })

    

    $('#categoryForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission
        const BASE_URL = $('#base_url').val();
        var formData = new FormData(this); // Create FormData object

        $.ajax({
            url: BASE_URL, 
            type: 'POST',
            data: formData,
            dataType: 'json', 
            contentType: false, // Ensure this is false for FormData
            processData: false,
        })
        .done(function(data) {    
            console.log(data);     
        if(data.status === 'success') {
            cuteAlert({
                type: "success",
                title: "Added Successfully",
                message: data.message,
                buttonText: "Ok"
            }).then(() => {
                location.reload(); // Reload the page
            });
            console.log(data.message)
        } else {
            cuteAlert({
                type: "error",
                title: "Failed to category option",
                message: data.message,
                buttonText: "Ok"
            })
            console.log(data.message)
        }

        })
        .fail(function(data) {
            cuteAlert({
                type: "error",
                title: "Category Option Failed",
                message: data.responseText,
                buttonText: "Ok"
            })

            
        });
    })

</script>