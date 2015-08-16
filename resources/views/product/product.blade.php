@extends('app')
@section('content')

<div class="productContainer">
	<div class="brandWrapper">
		<div class="brandContainer">
			<?php
			  if(isset($brand)){
			    //print_r($brand[0]);
			    echo "<ul class='brandList'>";
			    for($i=0;$i<count($brand);$i++){
			    	echo "<li>";
			    	echo "<a href='#'>";
			    	echo "<div class='brandDiv'><img src='images/brand/product/sample".$brand[$i]["BRAND_ID"].".jpg'>";
			    	echo "</div>";
			    	echo "</a>";
			    	echo "</li>";
			    }
			    echo "</ul>";
			  }
			?>
		</div>
	</div>
	<div>
		Product Detail
	</div>
</div>

@endsection
@stop