
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Completed Orders</h4>
                  </div>
                  <div class="card-body">
                    <div class="row g-sm-4 g-3">
                    <?php 
                        $user_id = users_model::currentUser()["id"];
                        $status = 'completed';
                        $completed_orders = order_model::getUserOrdersByStatus($user_id, $status);
                        // echo "<pre>"; print_r($pending_orders); echo  "</pre>";
                        if(!empty($completed_orders)) {
                            foreach($completed_orders as $order) { 
                                $thumbnail = product_model::getProductThumbnail($order['product_id']);
                                $product = product_model::getProductById($order['product_id']);
                            ?>
                                <div class="col-xxl-4 col-md-6">
                                    <div class="prooduct-details-box">                                 
                                    <div class="d-flex"><img class="align-self-center img-fluid img-60" src="<?= BASE_URL. $thumbnail["product_image"] ?>" alt="#">
                                        <div class="flex-grow-1 ms-3">
                                        <div class="product-name">
                                            <h6><a href="#"><?= $product["title"] ?></a></h6>
                                        </div>
                                        <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                        <div class="price d-flex p-0 border-0"> 
                                            <div class="text-muted me-2">Price</div>: $<?= number_format($order["amount"], 2) ?>
                                        </div>
                                        <div class="avaiabilty">
                                            <div class="text-success">Quantity: <?=  $order["quantity"] ?></div>
                                            <div class="text-secondary">Shipping: $<?=  number_format($order["shipping"],2) ?></div>
                                        </div>
                                        <a class="btn btn-success btn-xs" href="#">Shipped</a><i class="close" data-feather="x"></i>
                                        </div>
                                    </div>
                                    </div>
                                </div>
            
                        <?php }
                        } else { ?>
                            <div class="text-center">
                                <h4>You Have No Completed Orders</h4>
                            </div>
                        <?php }
                        ?>
                      
                     
                    </div>
                  </div>
                </div>

              </div>
              
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
   