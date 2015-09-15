@extends('app')
@section('content')
<?php
	if(isset($page)){
		echo "<input id='page' type='hidden' value='".$page."'/>";
	}
?>
<div class="adminMain container-fluid" style="display:none;">
	<div class="row">
		<div class="col-sm-3 col-lg-3">
			<div  class='adminMenuDiv'>
				<button id="home" onclick="getSetting(this.id)" type="button" class="btn-block btn-default btn-lg">Home Setting</button>
			</div>
			<div  class='adminMenuDiv' style='text-align:right'>
				<button id="product" onclick="getSetting(this.id)" type="button" class="btn-block btn-default btn-lg">Product Setting</button>
			</div>
			<div  class='adminMenuDiv' style='text-align:right'>
				<button id="news" onclick="getSetting(this.id)" type="button" class="btn-block btn-default btn-lg">News/Articles Setting</button>
			</div>
			<div  class='adminMenuDiv' style='text-align:right'>
				<button id="contact" onclick="getSetting(this.id)" type="button" class="btn-block btn-default btn-lg">Contact Setting</button>
			</div>
			<div  class='adminMenuDiv' style='text-align:right'>
				<button id="member" onclick="getSetting(this.id)" type="button" class="btn-block btn-default btn-lg">Member Setting</button>
			</div>
			<div  class='adminMenuDiv' style='text-align:right'>
				<button id="catalogue" onclick="getSetting(this.id)" type="button" class="btn-block btn-default btn-lg">Catalogue Setting</button>
			</div>
		</div>
		<div id="adminDetail" class="col-sm-9 col-lg-9 adminDetailContainer" style="text-align:left">
		</div>
	</div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
    	$(document).ready(function(){
    		if($('#page').length!=0){
    			getSetting($('#page').val());
    		}
    		$('.adminMain').fadeIn('2000',function(){
    			$('#footer').fadeIn('slow');
    		});
		}); 

		function getSetting(page ,isMainPage){

			isMainPage = typeof isMainPage !== 'undefined'? isMainPage:false;
			var url = "admin/setting/"+page;

			if(!isMainPage){
				if($('#'+page).length!=0){
					$('.btn-block').removeClass("active");
					$('#'+page).addClass("active");
				}
			}
			$('#adminDetail').fadeOut(300,function(){
				$.ajax({
					url: url, 
					success: function(result){
						if(result){
							$('#adminDetail').html(result).fadeIn(800);
						}
			    	}
				});
			});
		}



    </script>
@endsection
@stop