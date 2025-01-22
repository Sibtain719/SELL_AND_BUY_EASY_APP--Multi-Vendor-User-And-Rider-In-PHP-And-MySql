<?php
	session_start();
	if(isset($_GET['item']))
	{
	  $arr = preg_split('/\,/',$_GET['item']);
	  $item_list = $_SESSION['cart'];
	    $listItem = array();
	    foreach($item_list as $i)
	    {
	        $ses_dta = explode(',',$i);
	        if($ses_dta[0] == $arr[0])
	        {
	        }
	        else
	        {
	            array_push($listItem,$i);
	        }
	    }
	    $_SESSION['cart'] = $listItem;
	
	}
	
?>