<div class="page-body">
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
    <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Add Category</h4>
            <p class="f-m-light mt-1">
              Here is where you create categories for products
            </p>
               
          </div>
          <div class="card-body">
            <form class="row g-3 needs-validation custom-input" id="categoryForm" enctype="multipart/form-data" novalidate="" method="post" action="<?= BASE_URL ?>category/store" >
              <div class="col-md-6 position-relative">
                <label class="form-label" for="validationTooltip01">Name</label>
                <input class="form-control" id="validationTooltip01" type="text" name="name" required="">
              </div>
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
              <div class="col-12"> 
                <label class="form-label" for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
              </div>
              <div class="col-12"> 
                <label class="form-label" for="formFile1">Choose Icon</label>
                <input class="form-control" id="formFile1" type="file" aria-label="file example" name="photo" required="">
                <div class="invalid-feedback">Invalid form file selected</div>
                <input class="form-control" type="hidden" id="base_url" required="" value="<?= BASE_URL ?>category/store">
                <div class="preview-container"></div>
              </div>
              <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit form</button>
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
  $(document).ready(function() {

    $('#formFile1').on('change', function() {
        const previewContainer = $('.preview-container');
        previewContainer.empty(); // Clear any previous previews

        const file = this.files[0];
        const allowedTypes = ['image/jpeg', 'image/png', 'image/svg+xml'];

        if (file && allowedTypes.includes(file.type)) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = $('<img>', {
                    src: e.target.result,
                    css: {
                        maxWidth: '150px',
                        margin: '10px'
                    }
                });
                previewContainer.append(img);
            };

            reader.readAsDataURL(file);
        } else {
          cuteAlert({
              type: "error",
              title: "Search Failed",
              message: "Invalid file type. Only SVG, PNG, and JPG files are allowed.",
              buttonText: "Ok"
          })
            
        }
    });

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
        if(data.status === 'success') {
            cuteAlert({
                type: "success",
                title: "Category Added Successfully",
                message: data.message,
                buttonText: "Ok"
            }).then(() => {
                location.reload(); // Reload the page
            });
        } else {
            cuteAlert({
                type: "error",
                title: "Failed to create category",
                message: data.message,
                buttonText: "Ok"
            })
        }

        })
        .fail(function(data) {
            cuteAlert({
                type: "error",
                title: "Category Failed",
                message: data.responseText,
                buttonText: "Ok"
            })
        });
      })





});

</script>