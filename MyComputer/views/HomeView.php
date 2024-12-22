<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");

	//load LayoutTrangChu.php
	$this->layoutPath = "LayoutTrangChu.php";
 ?>
				<!-- hang1 -->
				<div class="container">
          <div>
              <h2 style="color: red;">DANH SÁCH SẢN PHẨM </h2>
              <hr style="background: red;">
              <div style="height: 20px"></div>
              <div class="row">

                <?php 
                    $conn = Connection::getInstance();
                    // $products1 = $this->getTopProducts();
                    $item_per_page = !empty($_GET['per_page']) ?$_GET['per_page']:8;
                    $curren_page=!empty($_GET['page']) ?$_GET['page']:1;
                    $offset = ($curren_page-1) * $item_per_page;
                     $totalProducts = $conn->query( "select * from products");
                     $totalProducts = $totalProducts->rowCount();
                  $products1 = $conn->query("select * from products where display=0 order by id desc limit ".$item_per_page." offset ".$offset);
  
                    $totalPage = ceil($totalProducts / $item_per_page);  
                    $conn = null;
                  ?>

                  <?php foreach($products1 as $rows): ?>
                  <div>
                        <div class="col-sm-6" style="position: relative; width: 23%; margin: 11px;">
                        <div style="position: absolute; width: 40px; line-height: 40px; border-radius: 40px; background: black; color:white; text-align: center;z-index: 100;margin-top: 10px;"><?php echo $rows->discount; ?>%</div>
                        <div class="product-grid">
                          <div class="product-image">
                            
                            <a href="#">
                              <img class="pic-1" src="assets/upload/products/<?php echo $rows->photo; ?>" title="<?php echo $rows->name; ?>" alt="<?php echo $rows->name; ?>">
                              <img class="pic-2" src="assets/upload/products/<?php echo $rows->photo; ?>" title="<?php echo $rows->name; ?>" alt="<?php echo $rows->name; ?>">
                            </a>
                            <!-- <span class="product-trend-label"><header><h5>TRENDING</h5></header></span> -->
                            <ul class="social">
                              <li><a href="index.php?controller=cart&action=create&id=<?php echo $rows->id; ?>" data-tip="Add to cart"><i class="fa fa-shopping-cart"></i></a></li>



                              <li><a href="index.php?controller=wishlist&action=create&id=<?php echo $rows->id; ?>" data-tip="Wishlist"><i class="fa fa-heart"></i></a></li>


                              <li><a href="" data-tip="Compare"><i class="fa fa-random"></i></a></li>

                              <li><a href="index.php?controller=products&action=detail&id=<?php echo $rows->id; ?>" data-tip="Quick View"><i class="fa fa-search" title="tìm kiếm"></i></a></li>
                            </ul>
                          </div>
                          

                        </div>
                        <div class="product-content">
                            <h4 class="title"><a href="index.php?controller=products&action=detail&id=<?php echo $rows->id; ?>"><?php echo $rows->name; ?></a></h4>
                            <div class="item-content">
                                      <div class="ratings">
                                        <div class="rating-box"><a href="#">
                                          <div style="width:60%" class="rating"></div></a>
                                        </div>
                                      </div>
                                  </div>

                            <div class="price"><?php echo number_format($rows->price); ?></div>
                            <div style="height:20px;"></div>
                            <div class="muangay">
                              <a href="index.php?controller=cart&action=create&id=<?php echo $rows->id; ?>" id="muangay1" >Mua Ngay</a>
                            </div>

                          </div>

                      </div>
                  </div>
                 <?php endforeach; ?>
               
              </div>
               <div style="width: 100%; display: flex; justify-content: center;margin: 50px 0;">
                  <?php 
                    for($num =1; $num<=$totalPage; $num++) { ?>
                        <?php if ($num != $curren_page) {?>
                          <a class="page_note" style="border: 1px solid #ccc;
                                                      padding: 0 7px;
                                                      font-size: 18px;
                                                      " href="?per_page=8&page=<?=$num?>"><?=$num?></a>
                          <?php } else {?>
                            <strong style="border: 1px solid #ccc;padding: 0 7px;font-size: 18px;" > <?= $num?></strong>
                          <?php } ?>
                        
                   <?php } ?>
                </div>
              <div style="margin-top: 100px">
              <h2 style="color: red;">SẢN PHẨM NỔI BẬT</h2>
              <hr style="background: red;">
              <div style="height: 20px"></div>
              <div class="row">
                <?php 
                  $products1 = $this->modelHotProducts();
                  // $products1=count($products1);
                  
                ?>
                <?php foreach($products1 as $rows_nb): ?>
                    <div class="col-sm-6" style="position: relative; width: 23%; margin: 11px;">
                      <div style="position: absolute; width: 40px; line-height: 40px; border-radius: 40px; background: black; color:white; text-align: center;z-index: 100;margin-top: 10px;"><?php echo $rows_nb->discount; ?>%</div>
                      <div class="product-grid">
                        <div class="product-image">
                          
                          <a href="#">
                            <img class="pic-1" src="assets/upload/products/<?php echo $rows_nb->photo; ?>" title="<?php echo $rows_nb->name; ?>" alt="<?php echo $rows_nb->name; ?>">
                            <img class="pic-2" src="assets/upload/products/<?php echo $rows_nb->photo; ?>" title="<?php echo $rows_nb->name; ?>" alt="<?php echo $rows_nb->name; ?>">
                          </a>
                          <!-- <span class="product-trend-label"><header><h5>TRENDING</h5></header></span> -->
                          <ul class="social">
                            <li><a href="index.php?controller=cart&action=create&id=<?php echo $rows_nb->id; ?>" data-tip="Add to cart"><i class="fa fa-shopping-cart"></i></a></li>



                            <li><a href="index.php?controller=wishlist&action=create&id=<?php echo $rows_nb->id; ?>" data-tip="Wishlist"><i class="fa fa-heart"></i></a></li>


                            <li><a href="" data-tip="Compare"><i class="fa fa-random"></i></a></li>

                            <li><a href="index.php?controller=products&action=detail&id=<?php echo $rows_nb->id; ?>" data-tip="Quick View"><i class="fa fa-search" title="tìm kiếm"></i></a></li>
                          </ul>
                        </div>
                        

                      </div>
                      <div class="product-content">
                          <h4 class="title"><a href="index.php?controller=products&action=detail&id=<?php echo $rows_nb->id; ?>"><?php echo $rows_nb->name; ?></a></h4>
                          <div class="item-content">
                                    <div class="ratings">
                                      <div class="rating-box"><a href="#">
                                        <div style="width:60%" class="rating"></div></a>
                                      </div>
                                    </div>
                                </div>

                          <div class="price"><?php echo number_format($rows_nb->price); ?></div>
                          <div style="height:20px;"></div>
                          <div class="muangay">
                            <a href="index.php?controller=cart&action=create&id=<?php echo $rows_nb->id; ?>" id="muangay1" >Mua Ngay</a>
                          </div>

                        </div>

                    </div>
                <?php endforeach; ?>
              </div>
          </div>
          </div>
				</div> 
    </div>
    
  </div>
</div>
</div>
        <?php 
          $categories = $this->modelGetCategories();
         ?>
         <?php foreach($categories as $rowsCategories): ?>
<div class="chitiet">

        <!-- hang1 -->

      
        <div class="container">
          <div class="row">
          	 <?php 
                  $products = $this->modelGetProducts($rowsCategories->id);
                 ?>
                 <?php foreach($products as $rows): ?>
             

            <div class="col-md-3 col-sm-6">
 
              <div class="product-grid">

                <div class="product-image">
                  
                  <a href="#">
                    <img class="pic-1" src="assets/upload/products/<?php echo $rows->photo; ?>" title="<?php echo $rows->name; ?>" alt="<?php echo $rows->name; ?>">
                    <img class="pic-2" src="assets/upload/products/<?php echo $rows->photo; ?>" title="<?php echo $rows->name; ?>" alt="<?php echo $rows->name; ?>">
                  </a>
                  <!-- <span class="product-trend-label"><header><h5>TRENDING</h5></header></span> -->
                  <ul class="social">
                    <li><a href="" data-tip="Add to cart"><i class="fa fa-shopping-cart"></i></a></li>



                    <li><a href="" data-tip="Wishlist"><i class="fa fa-heart"></i></a></li>


                    <li><a href="" data-tip="Compare"><i class="fa fa-random"></i></a></li>

                    <li><a href="" data-tip="Quick View"><i class="fa fa-search" title="tim"></i></a></li>
                  </ul>
                </div>
                

              </div>
              <div class="product-content">
                  <h3 class="title"><a href="index.php?controller=products&action=detail&id=<?php echo $rows->id; ?>"><?php echo $rows->name; ?></a></h3>
                  <div class="item-content">
                            <div class="ratings">
                              <div class="rating-box"><a href="#">
                                <div style="width:60%" class="rating"></div></a>
                              </div>
                            </div>
                        </div>

                  <div class="price"><?php echo number_format($rows->price); ?></div>
                  <div class="muangay">
                    <a href="index.php?controller=cart&action=create&id=<?php echo $rows->id; ?>" id="muangay1" >Mua Ngay</a>
                  </div>

                </div>
                  <div class="chatbox">
                  
                  </div>
            </div>
            <?php endforeach; ?>


        </div>
    </div>
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="DATN_HOANG"
  agent-id="0123df46-f46a-48f4-9240-aad0d45cebce"
  language-code="vi"
></df-messenger>

  </div>
    <?php endforeach; ?>
  </div>
