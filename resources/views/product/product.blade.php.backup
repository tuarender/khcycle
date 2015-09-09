@extends('app')
@extends('partials.subheader')
@section('content')
<div class="productContainer">
	<div class="brandWrapper">
		<div class="brandContainer">
			<?php
			  if(isset($brand)){
			    echo "<ul id='brandList' class='brandList'>";
			    for($i=0;$i<count($brand);$i++){
			    	echo "<li id='".$brand[$i]["BRAND_ID"]."'>";
			    	echo "<a href='javascript:getProduct(".$brand[$i]["BRAND_ID"].",0)'>";
			    	echo "<div class='brandDiv'>";
			    	echo "<img onerror='this.src=\"images/brand/product/default.png\"' id='logoBrand".$brand[$i]["BRAND_ID"]."' src='images/brand/product/sample".$brand[$i]["BRAND_ID"].".jpg'";
			    	echo " class='brandLogo"; 
			    	if(isset($brandId)&&!is_null($brandId)&&$brandId==$brand[$i]["BRAND_ID"]){
			    		echo " brandLogoActive";
			    	}
			    	echo "'>";
			    	echo "</div>";
			    	echo "</a>";
			    	echo "</li>";
			    }
			    echo "</ul>";
			  }
			?>
		</div>
	</div>
	<div id="productList" style="display:none">
		Product Detail
	</div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
    	$(document).ready(function(){
    		//console.log($('.brandDiv img').hasClass('brandLogoActive'));
    		if(!$('.brandDiv img').hasClass('brandLogoActive')){
    			getProduct($('#brandList li').first().attr("id"));
    		}
    		else{
    			getProduct($('.brandLogoActive').parent().parent().parent().attr('id'));
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