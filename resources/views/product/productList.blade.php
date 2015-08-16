<?php
	
	if(isset($product)&&!empty($product)){
		for($i=0;$i<count($product);$i++){
			echo "<div class='product' style='background-image: url(images/product/".$product[$i]['PRODUCT_FILE_NAME'].".png);'>";
			echo "</div>";
		}
	}
	else{
		echo "Not found any product";
	}
?>