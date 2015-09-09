@extends('app')
@extends('partials.subheader')
@section('content')
<?php
	if(isset($brand)){
?>
<div class="productMain container-fluid" style="display:block;">
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
		<div id="productList" class="col-sm-9 col-lg-9" style="text-align:left">
		</div>
	</div>
</div>
<?
	}
?>
@endsection
@section('scripts')
    <script type="text/javascript">
    	$(document).ready(function(){
    		console.log($('.brandDiv>a>img').hasClass('brandLogoActive'));
    		console.log($('.productMain').children().children().children().attr("id"));
    		if(!$('.brandDiv>a>img').hasClass('brandLogoActive')){
    			getProduct($('.productMain').children().children().children().attr("id"));
    		}
    		else{
    			getProduct($('.brandLogoActive').parent().parent().attr('id'));
    		}

    		$(window).on('resize', function(){
    			//console.log($('#productList').height());
			    if ($(this).width() <= 768){
			    	$('.brandWrapper').css('height', 'auto'); //set max height
			    }else{
			    	$('.brandWrapper').css('height', $(window).height()-96); 
		    	}
		   	}).resize();
		   	$('#footer').fadeIn('slow');
		}); 

		function getProduct(brandId,groupId){

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
							$('#productList').html(result).fadeIn(800);
						}
			    	}
				});
			});
		}
    </script>
@endsection
@stop