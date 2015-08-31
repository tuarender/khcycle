@extends('app')
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
			    	echo "<img src='images/brand/product/sample".$brand[$i]["BRAND_ID"].".jpg' class='brandLogo'>";
			    	echo "</div>";
			    	echo "</a>";
			    	echo "</li>";
			    }
			    echo "</ul>";
			  }
			?>
		</div>
	</div>
	<div id="productList">
		Product Detail
	</div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">

    	$(document).ready(function(){
    		getProduct($('#brandList li').first().attr("id"));

    		$(window).on('resize', function(){
			    if ($(this).width() <= 768){
			    	//alert("kkkkk");
			    	$('.brandWrapper').css('height', 'auto'); //set max height
			    }else{
			    	$('.brandWrapper').css('height', $(window).height()-96); 
		    	}
		   	}).resize();
		}); 

		function getProduct(brandId,groupId){
			var url = "product/"+brandId;
			if(groupId){
				url += "/"+groupId;
			}
			$.ajax({
				url: url, 
				success: function(result){
					if(result){
						$('#productList').html(result);
					}
		    	}
			});
		}
    </script>
@endsection
@stop