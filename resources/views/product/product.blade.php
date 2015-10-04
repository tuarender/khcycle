@extends('app')
@section('content')
<?php
	$searchKeyword = "";
	if(isset($keyword)){
		$searchKeyword = $keyword;
		echo "<input type='hidden' id='keyword' value='".htmlentities($keyword)."'/>";
	}
	if(isset($brand)){
?>
<div class="productMain container-fluid" style="display:none;">
	<div class="row">
		<div class="col-sm-3 col-lg-3">
			<div class="adminMenuSubheader">
				<span>Product</span>
				<hr style='max-width:100%;margin:10px 0px;border-color:#D7D7D7'>
			</div>
<?php
	foreach($brand as $eachBrand){
		echo "<div id='".$eachBrand["BRAND_ID"]."' class='brandDiv' style='text-align:right'>";
		echo "<a href='javascript:getProduct(".$eachBrand["BRAND_ID"].",0,false)'>";
		echo "<img onerror='this.src=\"images/brand/default.png\"' id='logoBrand".$eachBrand["BRAND_ID"]."' src='images/brand/".$eachBrand["BRAND_LOGO_NAME"].".".$eachBrand["BRAND_LOGO_EXT"]."'";
		echo " class='brandLogo img-responsive"; 
    	if(isset($brandId)&&!is_null($brandId)&&$brandId==$eachBrand["BRAND_ID"]&&$searchKeyword==""){
    		echo " brandLogoActive";
    	}
    	echo "'>";
    	echo "</a>";
    	echo "</div>";
	}		
?>
		</div>
		<div id="productList" class="col-sm-9 col-lg-9 productListContainer" style="text-align:left">
		</div>
	</div>
</div>
<?php
	}
?>
@endsection
@section('scripts')
    <script type="text/javascript">
    	$(document).ready(function(){
    		if($('#keyword').length==0){
	    		if(!$('.brandDiv>a>img').hasClass('brandLogoActive')){
	    			getProduct($('.productMain').children().children().children().next().attr("id"),false,true);
	    		}
	    		else{
	    			getProduct($('.brandLogoActive').parent().parent().attr('id'),false,true);
	    		}
    		}
    		else{
    			searchProduct($('#keyword').val());
    		}

		   	$('.productMain').fadeIn('2000',function(){
		   		$('#footer').fadeIn('slow');
		   	})
		});

		function searchProduct(keyword){
			var urlSearch = "search/"+keyword;
			$('#productList').fadeOut(300,function(){
				$.ajax({
					url: urlSearch, 
					success: function(result){
						if(result){
							$('#productList').html(result).fadeIn(800,function(){
								if ($(window).width() <= 768){
									$('html, body').animate({
								        scrollTop: $("#productList").offset().top-50
								    }, 2000);
								}
							});
						}
			    	}
				});
			});
		}

		function getProduct(brandId,groupId,isFirstTime){
			var url = "product/"+brandId;
			if(groupId){
				url += "/"+groupId;
			}
			else{
				$('.brandLogoActive').removeClass("brandLogoActive");
				$('#logoBrand'+brandId).addClass("brandLogoActive");
			}
			$('#productList').fadeOut(300,function(){
				$.ajax({
					url: url, 
					success: function(result){
						if(result){
							$('#productList').html(result).fadeIn(800,function(){
								if ($(window).width() <= 768&&!isFirstTime){
									$('html, body').animate({
								        scrollTop: $("#productList").offset().top-50
								    }, 2000);
								}
							});
						}
			    	}
				});
			});
		}
    </script>
@endsection
@stop