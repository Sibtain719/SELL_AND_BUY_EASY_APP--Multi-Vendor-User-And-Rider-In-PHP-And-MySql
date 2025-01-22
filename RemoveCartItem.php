<?php
	session_start();
	if(isset($_GET['item']))
	{
	  $arr = preg_split('/\,/',$_GET['item']);
	  //print_r ($arr);
	  if(isset($_SESSION['cart']))
	  {
		$item_list = $_SESSION['cart'];
		if(in_array($_GET['item'],$item_list))
		{
			$index = array_search($_GET['item'],$item_list);
			$data = $item_list[$index];
			$arr = explode(',',$data);
			$arr[4]-=1;
			$item_str = implode(",", $arr);
			$item_list[$index] = $item_str;
			$_SESSION['cart'] = $item_list;
		}
		else
		{
			// checking with item id now
			$obj_item  = explode(',',$_GET['item']);
			//print_r($item_list);
			$flag = false;
			for($i=0; $i<count($item_list); $i++)
			{
				$ob = explode(',',$item_list[$i]);
				if($ob[0] == $obj_item[0])
				{
					$ob[4]-=1;
					$item_str = implode(",", $ob);
					$item_list[$i] = $item_str;
					$_SESSION['cart'] = $item_list;
					$flag = true;
					break;
				}
			}
			if($flag!=true)
			{
				array_push($item_list,$_GET['item']);
			}
		}
			$total_amount = 0;
			$_SESSION['cart'] = $item_list;
			echo '<div class="check-header">
			          		<button class="check-close"><i class="icofont-close"></i></button>
        			  	<div class="cart-total">
            				<i class="icofont-basket"></i>
            				<h5><span>total item</span><span>('.count($item_list).')</span></h5>
          				</div>
        			      </div>
        				<ul class="cart-list">';
			foreach($item_list as $obj)
			{
				$data = explode(',',$obj);
			        //0 productId 1-cat_id 2-itename 3-price 4-quantity 5-picture 6-createdby
			         $Remove_item_id = $data[0].','.$data[1].','.$data[2].','.$data[3].',1,'.$data[5].','.$data[6];
				$total_amount-= ($data[3]*$data[4]);
				echo '<li class="cart-item alert fade show">
			          
        			    <div class="cart-image">
              				<a href="#"><img src="dashboard/item/'.$data[5].'" alt="product"/></a>
            			    </div>
 			            <div class="cart-info">
        			      <h5><a href="product-single.html">'.$data[2].'</a></h5>
              				<span>PKR - '.$data[3]. ' X 1<small>/ '.$data[3].' </small></span>
              				<h6>'.$data[3].'</h6>
              				<div class="product-action">
                				<button class="action-minus" title='.$Remove_item_id.' onclick="RemoveItem(this.title)">
                				  <i class="icofont-minus"></i></button>
		  				  <input class="action-input" id="qty_min" title="Quantity Number" type="text" name="quantity" value="'.$data[4].'"/>
						  <button class="action-plus" title='.$Remove_item_id.' onclick="AddCart(this.title)">
                  				  <i class="icofont-plus"></i>
                				  </button>
              				</div>
            			    </div>
			            <button class="cart-delete" data-dismiss="alert"><i class="icofont-bin"></i></button>
			           </li>';
			}
				echo '</ul> 
					<div class="check-footer">
					<a href="checkout.php" class="check-btn"
						><span class="check-title">checkout</span
						><span class="check-price">PKR-'.$total_amount.'</span></a
					>
					</div>
				</div>';
				$_SESSION['total'] = $total_amount;
	  }	
	  else
	  {
		$item_list = array($_GET['item']);
		$_SESSION['cart'] = $item_list;
		$data = explode(',',$_GET['item']);
		//0 productId 1-cat_id 2-itename 3-price 4-quantity 5-picture 6-createdby
		 $Remove_item_id = $data[0].','.$data[1].','.$data[2].','.$data[3].',1,'.$data[5].','.$data[6];
			echo '<div class="check-header">
				<button class="check-close"><i class="icofont-close"></i></button>
				<div class="cart-total">
					<i class="icofont-basket"></i>
					<h5><span>total item</span><span>(1)</span></h5>
				</div>
				</div>
				<ul class="cart-list">
				<li class="cart-item alert fade show">
					<div class="cart-image">
					<a href="#">
				<img src="dashboard/item/'.$data[5].'" alt="product"/>
				</a>
					</div>
					<div class="cart-info">
					<h5><a href="product-single.html">'.$data[2].'</a></h5>
					<span>PKR - '.$data[3]. ' X 1<small>/ '.$data[3].' </small></span>
					<h6>'.$data[3].'</h6>
					<div class="product-action">
						<button class="action-minus" title='.$Remove_item_id.' onclick="RemoveItem(this.title)">
						<i class="icofont-minus"></i></button>
				<input
						class="action-input"
						title="Quantity Number"
						type="text"
						name="quantity"
						value="1"
						/><button class="action-plus" title='.$Remove_item_id.' onclick="AddCart(this.title)">
						<i class="icofont-plus"></i>
						</button>
					</div>
					</div>
					<button class="cart-delete" data-dismiss="alert">
					<i class="icofont-bin"></i>
					</button>
				</li>
			<div class="check-footer">
				
				<a href="checkout.php" class="check-btn"
					><span class="check-title">checkout</span
					><span class="check-price">PRK-'.$data[3].'</span></a
				>
				</div>
					</div>
				';
          }
	}
?>