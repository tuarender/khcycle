@extends('app')
@extends('partials.subheader')
@section('content')
<?php
	if(isset($brand)){
?>
<div class="productMain container-fluid" style="display:none;">
	<div class="row">
		<div class="col-sm-3 col-lg-3">
<?php
	foreach($brand as $eachBrand){
		echo "<div id='".$eachBrand["BRAND_ID"]."' class='brandDiv' style='text-align:right'>";
		echo "<a href='javascript:getProduct(".$eachBrand["BRAND_ID"].",0)'>";
		echo "<img onerror='this.src=\"images/brand/product/default.png\"' id='logoBrand".$eachBrand["BRAND_ID"]."' src='images/brand/product/sample".$eachBrand["BRAND_ID"].".jpg'";
		echo " class='brandLogo img-responsive"; 
    	if(isset($brandId)&&!is_null($brandId)&&$brandId==$eachBrand["BRAND_ID"]){
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
    		if(!$('.brandDiv>a>img').hasClass('brandLogoActive')){
    			getProduct($('.productMain').children().children().children().attr("id"),false,true);
    		}
    		else{
    			getProduct($('.brandLogoActive').parent().parent().attr('id'),false,true);
    		}

		   	$('.productMain').fadeIn('2000',function(){
		   		$('#footer').fadeIn('slow');
		   	})
		}); 

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