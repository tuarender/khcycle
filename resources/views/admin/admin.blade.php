@extends('app')
@section('content')
<?php
	if(isset($page)){
		echo "<input id='page' type='hidden' value='".$page."'/>";
	}
?>
<div class="adminMain container-fluid" style="">
	<div class="row">
		<div class="col-sm-3 col-lg-3 col-lg-2">
			<div class="adminMenuSubheader">
				<span>Setting</span>
				<hr style='width:100%;margin:10px 0px;border-color:#D7D7D7'>
			</div>
			<div  class='adminMenuDiv' style='text-align:right'>
				<a href="admin/home" class="btn-block btn-default btn-lg">Home Setting</a>
			</div>
			<div  class='adminMenuDiv' style='text-align:right'>
				<a href="admin/product" class="btn-block btn-default btn-lg">Product Setting</a>
			</div>
			<div  class='adminMenuDiv' style='text-align:right'>
				<a href="admin/news" class="btn-block btn-default btn-lg">News/Articles Setting</a>
			</div>
			<div  class='adminMenuDiv' style='text-align:right'>
				<a href="admin/contact" class="btn-block btn-default btn-lg">Contact Setting</a>
			</div>
			<div  class='adminMenuDiv' style='text-align:right'>
				<a href="admin/member" class="btn-block btn-default btn-lg">Member Setting</a>
			</div>
			<div  class='adminMenuDiv' style='text-align:right'>
				<a href="admin/catalogue" class="btn-block btn-default btn-lg">Catalogue Setting</a>
			</div>
		</div>
		<div id="adminDetail" class="col-sm-9 col-md-9 col-lg-10 adminDetailContainer" style="text-align:left">
		@yield('adminContent')
		</div>
	</div>
</div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4>ยืนยันการลบข้อมูล</h4>
            </div>
            <div class="modal-body" style="text-align:right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
    	$(document).ready(function(){
    		$('#confirm-delete').on('show.bs.modal', function(e) {
            	$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        	});
/*    		if($('#page').length!=0){
    			getSetting($('#page').val());
    		}
    		$('.adminMain').fadeIn('2000',function(){
    			$('#footer').fadeIn('slow');
    		});*/
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
			$('#page').val(page);
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

		function callSubmit(formId){
		    $('#adminDetail').fadeOut(300,function(){
		    	console.log($('#'+formId).serialize());
			    $.ajax({
			        type: "POST",
			        url: $('#'+formId).attr('action'),
			        data: $('#'+formId).serialize()+"&page=" + $('#page').val(),
			        enctype: 'multipart/form-data',
			        success: function( result ) {
			        	if(result){
							$('#adminDetail').html(result).fadeIn(800);
						}
			        }
			    });
		    });
		}

		function callDelete(url){

		}

    </script>
@endsection
@stop