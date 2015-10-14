<div class="container-fluid">
    <div class="row adminSubheader">
        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 adminMenuSubheader">
            <span>Keyword:{{$keyword}}</span>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 subheaderContact">
            <label>สนใจสินค้าติดต่อ 0-2510-1906</label>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5" style="text-align:right">
            <label>Social Network:</label>
            <a href="https://www.facebook.com/KhcycleThailand" target="_blank" class="btn btn-social-icon btn-facebook">
                <i class="fa fa-facebook"></i>
            </a>
            <a href="https://instagram.com/khcycle_thailand/" target="_blank">
                <img src="images/instragram.png" class="img-responsive" style="max-width:32px;display:inline">
            </a>
            <a href="#lineLogo" data-targer="#lineLogo" data-toggle='modal' style="border:0px;outline:none">
                <img src="images/line.png" class="img-responsive" style="max-width:32px;display:inline;border : 0;">
            </a>
        </div>
        <hr style='width:100%;margin:5px 0px;border-color:#D7D7D7'>
    </div>
</div>
<div  id='lineLogo' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
          <div class='modal-body'>
              <img src='images/lineQR_code.jpg' class='img-responsive' onerror='this.src="images/product/default-lg.png"'>
          </div>
      </div>
  </div>
</div>
<?php
	echo "<div class='row productList'>";
	if(isset($products)&&!empty($products)){
		foreach($products as $product){
			echo "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3 productImgDiv'>";
			echo "<a href='#product".$product['PRODUCT_ID']."' data-target='#product".$product['PRODUCT_ID']."' data-toggle='modal'>";
			echo "<img class='img-responsive' onerror='this.src=\"images/product/default.png\"' src='images/product/".$product['PRODUCT_MIN_FILE_NAME'].".".$product['PRODUCT_MIN_EXT']."'>";
			echo "</a>";
			echo "<a href='#product".$product['PRODUCT_ID']."' data-target='#product".$product['PRODUCT_ID']."' data-toggle='modal'>";
			echo "<label class='productName'>".$product['PRODUCT_NAME']."</label>";
			echo "</a>";
			echo "</div>";
			echo "<div  id='product".$product['PRODUCT_ID']."' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
			echo "	<div class='modal-dialog modal-lg'>";
			echo "		<div class='modal-content'>";
			echo "			<div class='modal-body'>";
			echo "				<img src='images/product/".$product['PRODUCT_FULL_FILE_NAME'].".".$product['PRODUCT_FULL_EXT']."' class='img-responsive' onerror='this.src=\"images/product/default-lg.png\"'>";
			echo "			</div>";
			echo "		</div>";
			echo "	</div>";
			echo "</div>";
		}
	}
	else{
		echo "<div class='col-xs-12 notFoundProduct'>Not found any products</div>";
	}
	echo "</div>";
?>