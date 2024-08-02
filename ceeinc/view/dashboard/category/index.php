
        <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
             
             
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border">
                    <h4>Categories</h4>
                  </div>
                  <div class="card-body">
                    <div class="dt-ext table-responsive theme-scrollbar">
                      <table class="display" id="export-button">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Thumbnail</th>
                            <th>Name</th>
                            <th>Parent</th>
                            <th>Date Created</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php 
                          $categories = category_model::getCategoryList();
                          $sn = 1;
                          foreach ($categories as $category) : 
                              $parent_category = empty($category["parent"]) ? '' : category_model::getCategoryById($category["parent"])['name']; 
                          ?>
                          <tr>
                            <td><?= $sn ?></td>
                            <td> 
                              <img class="img-fluid table-avtar" src="<?= $category["icon"] ?>" alt="profile">
                            </td>
                            <td><?= $category["name"] ?></td>
                            <td>
                               <?= $parent_category;   ?>
                            </td>
                            <td><?= Date::getDate($category["created_at"]); ?></td>
                            <td> 
                              <ul class="action"> 
                                <li class="edit"> <a href="#"><i class="icon-pencil-alt"></i></a></li>
                                <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                              </ul>
                            </td>
                          </tr>
                        <?php $sn++; endforeach; ?>
                        
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Assign To</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
    