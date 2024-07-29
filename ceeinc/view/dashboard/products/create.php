<div class="page-body">
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Add Product</h4>
            <p class="f-m-light mt-1">Upload Your Product</p>
          </div>
          <div class="card-body">
            <form class="row g-3 needs-validation custom-input" id="productForm" enctype="multipart/form-data" novalidate method="post" action="<?= BASE_URL ?>product/store">
              <div class="col-md-6 position-relative">
                <label class="form-label" for="validationTooltip01">Product Title</label>
                <input class="form-control" id="validationTooltip01" type="text" name="title" required>
              </div>
              <div class="col-md-6 position-relative">
                <label class="form-label" for="validationTooltip011">Category</label>
                <select name="category" id="validationTooltip011" class="form-control" required>
                  <option value="">--Select Category--</option>
                  <?php 
                  $categories = category_model::getCategoryList();
                  foreach($categories as $category): ?>
                    <option value="<?php echo $category['id'];?>">
                      <?php echo $category['name'];?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-6 position-relative">
                <label class="form-label" for="validationTooltip02">Price</label>
                <input class="form-control" id="validationTooltip02" type="number" step="0.01" name="price" required>
              </div>
              <div class="col-md-6 position-relative">
                <label class="form-label" for="validationTooltip03">Stock Quantity</label>
                <input class="form-control" id="validationTooltip03" type="number" name="stock" required>
              </div>
              <div class="col-12">
                <label class="form-label" for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3" required></textarea>
              </div>
              <div class="col-12">
                <label class="form-label" for="formFile1">Product Image</label>
                <input class="form-control" id="formFile1" type="file" name="photos[]" multiple required>
                <div class="invalid-feedback">Invalid file selected</div>
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

    const allowedTypes = ['image/jpeg', 'image/png', 'image/svg+xml'];

    for (const file of this.files) {
      if (allowedTypes.includes(file.type)) {
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
          title: "Invalid file type",
          message: "Only SVG, PNG, and JPG files are allowed.",
          buttonText: "Ok"
        });
        break;
      }
    }
  });

  $('#productForm').submit(function(e) {
    e.preventDefault(); // Prevent form submission
    const formData = new FormData(this); // Create FormData object
    
    $.ajax({
      url: '<?= BASE_URL ?>product/store',
      type: 'POST',
      data: formData,
      dataType: 'json', 
      contentType: false, // Ensure this is false for FormData
      processData: false,
    })
    .done(function(data) {         
      if (data.status === 'success') {
        cuteAlert({
          type: "success",
          title: "Product Added Successfully",
          message: data.message,
          buttonText: "Ok"
        }).then(() => {
          location.reload(); // Reload the page
        });
      } else {
        cuteAlert({
          type: "error",
          title: "Failed to add product",
          message: data.message,
          buttonText: "Ok"
        });
      }
    })
    .fail(function(data) {
      cuteAlert({
        type: "error",
        title: "Product upload failed",
        message: data.responseText,
        buttonText: "Ok"
      });
    });
  });
});

</script>
