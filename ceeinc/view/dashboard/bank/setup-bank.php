
        <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Add Bank Details</h4>
                    <p class="f-m-light mt-1">
                        Please make sure your information is correct to be the best of your knowledge. You can update your information later.
                    </p>
                  </div>
                  <div class="card-body">
                    <form class="row g-3 needs-validation custom-input" action="<?= BASE_URL ?>bank/store" method="POST" id="bankForm" novalidate="">
                    <?php Session::form_csfr(); ?>
                      <div class="col-md-4 position-relative">
                        <label class="form-label" for="validationTooltip01"><span class="text-danger">*</span>Bank name</label>
                        <input class="form-control" id="validationTooltip01" name="bank_name" type="text"required="">
                        
                      </div>
                      <div class="col-md-4 position-relative">
                        <label class="form-label" for="validationTooltip02"><span class="text-danger">*</span>Account name</label>
                        <input class="form-control" id="validationTooltip02" type="text" name="account_name" required="">
                        <input class="form-control" type="hidden" id="base_url" required="" value="<?= BASE_URL ?>bank/store">
                        
                      </div>

                      <div class="col-md-4 position-relative">
                        <label class="form-label" for="validationTooltip022"><span class="text-danger">*</span>Account number</label>
                        <input class="form-control" id="validationTooltip022" type="text" name="account_number" required="">                   
                      </div>
                      
                      <div class="col-md-4 position-relative">
                        <label class="form-label" for="validationTooltip02222"><span class="text-danger">*</span>Account Type</label>
                        <select class="form-select" id="validationTooltip02222" required="">
                          <option selected="" disabled="" value="">Choose...</option>
                          <option value="savings"> Savings </option>
                          <option value="current"> Current </option>
                        </select>           
                      </div>
                      
                      <div class="col-md-3 position-relative">
                        <label class="form-label" for="validationTooltip04"><span class="text-danger">*</span>Country</label>
                        <select class="form-select" id="validationTooltip04" required="">
                          <option selected="" disabled="" value="">Choose...</option>
                          <option value="nigeria"> Nigeria </option>
                          <option value="ghana"> Ghana</option>
                          <option value="south africa"> South Africa </option>
                          <option value="senegal"> Senegal </option>
                        </select>
                        <div class="invalid-tooltip">Please select a valid state.</div>
                      </div>
                      
                      <div class="col-md-3 position-relative">
                        <label class="form-label" for="validationTooltip04">City</label>
                        <select class="form-select" id="validationTooltip04">
                          <option selected="" disabled="" value="">Choose...</option>
                          <option value="lagos"> Lagos </option>
                          <option value="kumasi"> Kumasi</option>
                          <option value="cape town"> Cape Town </option>
                          <option value="dakar"> Dakar </option>
                        </select>
                        <div class="invalid-tooltip">Please select a valid city.</div>
                      </div>

                      <div class="col-md-3 position-relative">
                        <label class="form-label" for="validationTooltip05">Branch name</label>
                        <input class="form-control" id="validationTooltip05" name="branch_name" type="text" >
                      </div>

                      <div class="col-md-3 position-relative">
                        <label class="form-label" for="validationTooltip055">Currency</label>
                        <input class="form-control" id="validationTooltip055" name="currency" type="text" >
                      </div>

                      <div class="col-md-3 position-relative">
                        <label class="form-label" for="validationTooltip0555">Swift Code</label>
                        <input class="form-control" id="validationTooltip0555" name="swift_code" type="text" >
                      </div>



                      <div class="col-12">
                        <button class="btn btn-primary" type="submit">Upload</button>
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
                $('#bankForm').submit(function(e) {
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
                            title: "Bank Details Added Successfully",
                            message: data.message,
                            buttonText: "Ok"
                        }).then(() => {
                            location.reload(); // Reload the page
                        });
                    } else {
                        cuteAlert({
                            type: "error",
                            title: "Failed to Add Bank Details",
                            message: data.message,
                            buttonText: "Ok"
                        })
                    }

                })
                .fail(function(data) {
                    cuteAlert({
                        type: "error",
                        title: "Search Failed",
                        message: data.responseText,
                        buttonText: "Ok"
                    })
                });
                })
            })
        </script>