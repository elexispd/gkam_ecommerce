
<div class="page-body">
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
     
     
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0 card-no-border">
            <h4>View Products</h4>
          </div>
          <div class="card-body">
            <div class="dt-ext table-responsive theme-scrollbar">
              <table class="display" id="export-button">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Thumbnail</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Date Created</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                <?php 
                  $products = Product_model::getMyProducts();
                  $sn = 1;
                  foreach ($products as $product) : 
                      $thumbnail = product_model::getProductThumbnail($product['id']);
                      $product_image = $thumbnail ? $thumbnail["product_image"] : BASE_URL.'assets/img/no_image.jpg';
                  ?>
                  <tr>
                    <td><?= $sn ?></td>
                    <td> 
                      <img class="img-fluid table-avtar" src="<?= BASE_URL. $thumbnail["product_image"] ?>" alt="profile">
                    </td>
                    <td><?= $product["title"] ?></td>
                    <td>
                    <?= $product["description"] ?>
                    </td>
                    <td>
                    <?= Date::getDate($product["created_at"]);  ?>
                    </td>
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
                    <th>S/N</th>
                    <th>Thumbnail</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Date Created</th>
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
