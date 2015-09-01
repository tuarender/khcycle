<?php
	echo "<div class='groupListContainer'>";
	if(isset($groups)&&!empty($groups)){
		echo "<ul class='groupList'>";
		echo "<li><a ";
		if(!isset($groupId)){
			echo "class='groupListActive' ";
		}
		echo "href='javascript:getProduct(".$brandId.")'>All</a></li>";
		foreach($groups as $group){
			echo "<li><a ";
			if(isset($groupId)&&$groupId==$group['GROUP_ID']){
				echo "class='groupListActive' ";
			}
			echo "href='javascript:getProduct(".$brandId.",".$group['GROUP_ID'].")'>".$group['GROUP_NAME']."</a></li>";
		}
		echo "</ul>";
	}
	echo "</div>";
	echo "<div id='productListContainer'>";
	if(isset($products)&&!empty($products)){
		foreach($products as $product){
			echo "<div class='product' style='margin:5px'>";
			echo "<a href='#product".$product['PRODUCT_ID']."' data-target='#product".$product['PRODUCT_ID']."' data-toggle='modal'>";
			echo "<img class='img-responsive' src='images/product/".$product['PRODUCT_MIN_FILE_NAME'].".".$product['PRODUCT_MIN_EXT']."'>";
			echo "</a>";
			echo "<a href='#product".$product['PRODUCT_ID']."' data-target='#product".$product['PRODUCT_ID']."' data-toggle='modal'>";
			echo "<h4>".$product['PRODUCT_NAME']."</h4>";
			echo "</a>";
			echo "</div>";
			echo "<div  id='product".$product['PRODUCT_ID']."' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
			echo "	<div class='modal-dialog modal-lg'>";
			echo "		<div class='modal-content'>";
			echo "			<div class='modal-body'>";
			echo "				<img src='images/product/".$product['PRODUCT_FULL_FILE_NAME'].".".$product['PRODUCT_FULL_EXT']."' class='img-responsive'>";
			echo "			</div>";
			echo "		</div>";
			echo "	</div>";
			echo "</div>";
		}
	}
	else{
		echo "Not found any product";
	}
	echo "</div>";
?>