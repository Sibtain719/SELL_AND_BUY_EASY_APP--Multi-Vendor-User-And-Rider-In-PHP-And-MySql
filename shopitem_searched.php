<?php
        include("dashboard/db_connection.php");
        $q = $_GET['q'];
        $query = "select tbl_users.uid, tbl_users.name, tbl_users.logo from tbl_users where name='$q' and status='active' and role_id = 3";
        $rows  = mysqli_query($con,$query);
        $count = mysqli_num_rows($rows);
        if($count > 0)
        {
            if($count == 1)
            {
                while($cell = mysqli_fetch_array($rows))
                {
                    $shop = $cell[0].','.$cell[1].','.$cell[2].','.$cell[3];	
                    echo'
                          <div class="col-6 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                	        <div class="product-card">
                        	  <figure class="product-media">
                 				 <a class="product-image" href="product-single.php?shop='.$shop.'">
                				 <img src="shop_logo/'.$cell[2].'" alt="product"/></a>
                          	  </figure>
                      		  <h5 class="product-name">
                               <a href="product-single.php?shop='.$shop.'">Shop Name <br>'.$cell[1].'</a>
                              </h5>
                            </div>
                           </div>';
                }
                
            }
            else
            {
                while($cell = mysqli_fetch_array($rows))
                {
                    $shop = $cell[0].','.$cell[1].','.$cell[2].','.$cell[3];	
                    echo'
                          <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                	        <div class="product-card">
                        	  <figure class="product-media">
                 				 <a class="product-image" href="product-single.php?shop='.$shop.'">
                				 <img src="shop_logo/'.$cell[2].'" alt="product"/></a>
                          	  </figure>
                      		  <h5 class="product-name">
                               <a href="product-single.php?shop='.$shop.'">Shop Name <br>'.$cell[1].'</a>
                              </h5>
                            </div>
                           </div>';
                }
            }
        }
        else
        {
            /*$q = "select tbl_users.uid, tbl_users.name, tbl_users.logo from tbl_users where status='active' and role_id = 3";
            $obj  = mysqli_query($con,$q);
            while($cell = mysqli_fetch_array($obj))
            {
                $shop = $cell[0].','.$cell[1].','.$cell[2].','.$cell[3];	
                echo'
                      <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
            	        <div class="product-card">
                    	  <figure class="product-media">
             				 <a class="product-image" href="product-single.php?shop='.$shop.'">
            				 <img src="shop_logo/'.$cell[2].'" alt="product"/></a>
                      	  </figure>
                  		  <h5 class="product-name">
                           <a href="product-single.php?shop='.$shop.'">Shop Name <br>'.$cell[1].'</a>
                          </h5>
                        </div>
                       </div>';
            }*/
            echo 'Shop does not exist';
        }
?>
            