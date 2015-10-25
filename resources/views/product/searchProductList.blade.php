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
<?php
	echo "<div class='row productList'>";
	if(isset($products)&&!empty($products)){
		$maxPerPage = 16;
		$maxPage = ceil(count($products)/$maxPerPage);
		$currentPage = $page;
		if($currentPage>$maxPage){
			$currentPage = $maxPage;
		}
		$start = ($page-1)*$maxPerPage;
		$end = ($page*$maxPerPage)-1;
		for($i=$start;$i<=$end&&$i<count($products);$i++){
			echo "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3 productImgDiv'>";
			echo "<a href='#product".$products[$i]['PRODUCT_ID']."' data-target='#product".$products[$i]['PRODUCT_ID']."' data-toggle='modal'>";
			echo "<img class='img-responsive' onerror='this.src=\"images/product/default.png\"' src='images/product/".$products[$i]['PRODUCT_MIN_FILE_NAME'].".".$products[$i]['PRODUCT_MIN_EXT']."'>";
			echo "</a>";
			echo "<a href='#product".$products[$i]['PRODUCT_ID']."' data-target='#product".$products[$i]['PRODUCT_ID']."' data-toggle='modal'>";
			echo "<label class='productName'>".$products[$i]['PRODUCT_NAME']."</label>";
			echo "</a>";
			echo "</div>";
			echo "<div  id='product".$products[$i]['PRODUCT_ID']."' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
			echo "	<div class='modal-dialog modal-lg'>";
			echo "		<div class='modal-content'>";
			echo "			<div class='modal-body'>";
			echo "				<img src='images/product/".$products[$i]['PRODUCT_FULL_FILE_NAME'].".".$products[$i]['PRODUCT_FULL_EXT']."' class='img-responsive' onerror='this.src=\"images/product/default-lg.png\"'>";
			echo "			</div>";
			echo "		</div>";
			echo "	</div>";
			echo "</div>";
		}
		echo "</div>";
		echo "<div class='col-xs-12 center-block paginationBlock'>";
		echo "<a class='pagination ";
		if($page==1){
			echo "disabled";
		}
		echo "' href='javascript:searchProduct($(\"#keyword\").val(),".($currentPage-1).")'><< Previous</a>";
		echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
		echo "<a class='pagination ";
		if($page==$maxPage){
			echo "disabled";
		}
		echo "' href='javascript:searchProduct($(\"#keyword\").val(),".($currentPage+1).")'>Next >></a>";
		echo "</div>";
	}
	else{
		echo "<div class='col-xs-12 notFoundProduct'>Not found any products</div>";
		echo "</div>";
	}
?>