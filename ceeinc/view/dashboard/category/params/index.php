
<div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">         
                <div class="col-6 align-center">
                    <select name="categ_option" id="categ_option"  class="form-control" >
                        <option value="">--Select Category--</option>
                        <?php 
                            $parents = category_model::getParentCategory();
                            foreach($parents as $parent): ?>
                            <option value="<?php echo $parent['id'];?>">
                            <?php echo $parent['name'];?>
                           </option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h4>Category Options</h4>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive theme-scrollbar">
                        <table class="display" id="export-button">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Option Name</th>
                                <th>Option</th>
                                <th>Values</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        </div>
                    </div>
                    </div>
              </div>
                </div>
          </div>
          <div class="col-sm-12 content">

          </div>
    <!-- Container-fluid Ends-->
</div>


<script>
    $(document).ready(function() {
    $('#categ_option').change(function() {
        var selectedOption = $(this).val();
        var categ_id = selectedOption; // Adjust according to your option value format
        var url_link = 'http://localhost/gkam/category_param/getOptionListHtml';

        $.ajax({
            url: url_link,
            type: 'GET',
            data: { categ_id: categ_id }, // Pass the category ID to the server
            dataType: 'html',
            success: function(response) {
                $('tbody').html(response);
            },
            error: function(xhr, status, error) {
                Toastify({
                    text: "Error: " + error,
                    duration: 5000,
                    close: true,
                    style: {
                        background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                    },
                    offset: {
                        x: 50,
                        y: 10,
                    },
                }).showToast();
            }
        });
    });
});

</script>