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
				<div class="col-xs-12">
					<span>Product</span>
				</div>
				<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 subheaderProduct">
		            <label>สนใจสินค้าติดต่อ 0-2510-1906</label>
		        </div>
		        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 subheaderProduct">
		            <label>Social Network:</label>
		            <a href="https://www.facebook.com/KhcycleThailand" target="_blank" class="btn btn-social-icon btn-facebook">
		                <i class="fa fa-facebook"></i>
		            </a>
		            <a class="btn btn-social-icon btn-instagram">
		                <i class="fa fa-instagram"></i>
		            </a>
		        </div>
				<div class="col-xs-12">
					<hr style='max-width:100%;margin:10px 0px;border-color:#D7D7D7'>
				</div>
			</div>
			<div id="brandHome" data-loop="true" data-width="100%" data-ratio="208/58" data-autoplay="3000" data-stopautoplayontouch="false" class='row'>
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
    	var isBrandSlider = false;

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
		   	});

		   	brandSlider();
		   	$(window).on('resize', function(){
	          brandSlider();
	        });
		});

		function brandSlider(){
	      if ($(this).width() <=749) {
	        if(!isBrandSlider){
	            $('#brandHome').fotorama();
	            isBrandSlider = true;
	        }
	      }
	      else{
	        if(isBrandSlider){
	          $('#brandHome').data('fotorama').destroy();
	          $('#brandHome').removeClass('fotorama');
	          isBrandSlider = false;
	        }
	      }
	    }

		function searchProduct(keyword){
			var urlSearch = "search/"+keyword;
			$('#productList').fadeOut(300,function(){
				$.ajax({
					url: urlSearch, 
					success: function(result){
						if(result){
							$('#productList').html(result).fadeIn(800);
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
							$('#productList').html(result).fadeIn(800);
						}
			    	}
				});
			});
		}
    </script>
@endsection
@stop