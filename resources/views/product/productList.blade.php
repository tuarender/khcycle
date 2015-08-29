<?php
	echo "<div class='groupListContainer'>";
	if(isset($groups)&&!empty($groups)){
		echo "<ul class='groupList'>";
		foreach($groups as $group){
			echo "<li><a href='javascript:getProduct(".$brandId.",".$group['GROUP_ID'].")'>".$group['GROUP_NAME']."</a></li>";
		}
		echo "</ul>";
	}
	echo "</div>";
	echo "<div id='productListContainer'>";
	if(isset($products)&&!empty($products)){
		foreach($products as $product){
			echo "<a href='images/product/".$product['PRODUCT_FULL_FILE_NAME'].".".$product['PRODUCT_FULL_EXT']."' data-toggle='lightbox'>";
			echo "<div class='product' style='background-image: url(images/product/".$product['PRODUCT_MIN_FILE_NAME'].".".$product['PRODUCT_MIN_EXT'].");'>";
			echo "</div>";
			echo "</a>";
		}
	}
	else{
		echo "Not found any product";
	}
	echo "</div>";
?>