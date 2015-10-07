@extends('admin.admin')
@section('adminContent')
@include('admin.partials.adminSubHeader')
<div class="sessionContainer" style="width: 100%">
    Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a>
</div>
<?php
	$formAction = "admin/news/news";
	$isYoutube = "";
	$youTubeUrl = "";
	$requireImage = "<font id='newsImageRequired' color='red'>*</font>";
	$newsTitle = "";
	$newsSample = "";
	$newsContent = "";
	if(isset($data)){
		$requireImage="";
		$formAction.="/".$data[0]["NEWS_ID"];
		$isYoutube = $data[0]['NEWS_IS_YOUTUBE']==1?"selected":"";
		$youTubeUrl = $data[0]['NEWS_IS_YOUTUBE']==1?$data[0]['NEWS_YOUTUBE_URI']:"";
		$newsTitle = $data[0]['NEWS_TITLE'];
		$newsSample = $data[0]['NEWS_SAMPLE'];
		$newsContent = $data[0]['NEWS_CONTENT'];
	}
	$isYoutubeOld = Input::old("newsType");
	if($isYoutubeOld!=null&&$isYoutubeOld!=""){
		$isYoutube = $isYoutubeOld==1?"selected":"";
	}

?>
<div class="container-fluid">
	@include('partials.flashmessage')
	<form id="newsForm" class="form-horizontal" role="form" method="post" action="<?=$formAction?>"  enctype="multipart/form-data">
		<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
		<div class="form-group @if ($errors->has('newsTitle')) has-error @endif">
            <label for="newsTitle" class="col-sm-3 control-label"><font color="red">*</font>ชื่อ News/Articles</label>
            <div class="col-sm-5">
                <input id="newsTitle" type="text" class="form-control" name="newsTitle" value="{{old('newsTitle',$newsTitle)}}">
                @if($errors->has('newsTitle')) 
                <p class="help-block">{{$errors->first('newsTitle')}}</p>@endif
            </div>
        </div>
		<div class="form-group">
			<label for="newsType" class="col-sm-3 control-label"><font color="red">*</font>ระบุชนิดภาพหลัก</label>
			<div class="col-sm-3">
				<select name="newsType" id="newsType" class="form-control">
				  	<option value="0">ภาพ</option>
				  	<option value="1" <?=$isYoutube?>>วีดีโอ</option>
				</select>
			</div>
		</div>

<?php
	if(isset($data)){
		echo "<div class='form-group'>";
		echo " <label class='col-sm-3 control-label'>ตัวอย่างภาพหน้าปก</label>";
		echo " <div class='col-sm-3'>";
		if($data[0]['NEWS_IS_YOUTUBE']==0){
			echo "<img class='img-responsive' src='images/news/".$data[0]['NEWS_IMAGE_TITLE_NAME'].".".$data[0]['NEWS_IMAGE_TITLE_EXT']."'>";
		}
		else{
			echo "<div class='videoWrapper'><iframe src='".$data[0]['NEWS_YOUTUBE_URI']."' frameborder='0' allowfullscreen></iframe></div>";
		}
		echo " </div>";
		echo "</div>";
	}
?>
		<div class="form-group @if ($errors->has('newsImage')) has-error @endif">
			<label for="newsImage" class="col-sm-3 control-label"><?=$requireImage?>แนบภาพหลัก</label>
			<div class="col-sm-5">
				<input id="newsImage" type="file" name="newsImage" id="newsImage" disabled>
				<p class="help-block">.jpg and .png, Limit size &lt; 1MB</p>
				@if($errors->has('newsImage')) 
                <p class="help-block">{{$errors->first('newsImage')}}</p>@endif
			</div>
		</div>
		<div class="form-group @if ($errors->has('youTubeUrl')) has-error @endif">
            <label for="youTubeUrl" class="col-sm-3 control-label"><font  id='youTubeUrlRequired' color="red">*</font>ระบุลิงค์ Youtube</label>
            <div class="col-sm-5">
                <input id="youTubeUrl" type="text" class="form-control" name="youTubeUrl" value="{{old('youTubeUrl',$youTubeUrl)}}" disabled>
                @if($errors->has('youTubeUrl')) 
                <p class="help-block">{{$errors->first('youTubeUrl')}}</p>@endif
            </div>
        </div>
        <div class="form-group @if ($errors->has('sample')) has-error @endif">
        	<label for="sample" class="col-sm-3 control-label"><font color="red">*</font>รายละเอียดโดยย่อ</label>
            <div class="col-sm-5">
            	<textarea name="sample" class="sampleTextArea">{{old('sample',$newsSample)}}</textarea>
                @if($errors->has('sample')) 
                <p class="help-block">{{$errors->first('sample')}}</p>@endif
            </div>
        </div>
        <div class="form-group @if ($errors->has('content')) has-error @endif">
        	<label for="content" class="col-sm-3 control-label"><font color="red">*</font>รายละเอียด</label>
            <div class="col-sm-8">
                <textarea name="content" class="summernoteContent">{{old('content',$newsContent)}}</textarea>
                @if($errors->has('content')) 
                <p class="help-block">{{$errors->first('content')}}</p>@endif
                <div>
	                <button id="previewNews" type="submit" class="btn btn-info">
	                	Preview
	                </button>
            	</div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-4">
                <button type="submit" class="btn btn-primary btnKhcycle">
                    ยืนยันและบันทึก
                </button>
                <button type="reset" class="btn btn-primary btnKhcycle">
                    ยกเลิก
                </button>
            </div>
        </div>
	</form>
</div>
@endsection
@section('scripts')
<script src="js/summernote.js"></script>
<script>
	$(document).ready(function() {
		toggleNewsType();

		$('#newsType').change(function(){
			toggleNewsType();
		});

		$('.summernoteContent').summernote({
  			height: 220,                
  			minHeight: null,             
  			maxHeight: null,
  			onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0]);
            }              
		});

		$("#previewNews").on("click", function(e){
		    e.preventDefault();
		    $('#contactsForm').attr('action', "admin/news/preview").submit();
		});
	});

	function sendFile(file, editor, welEditable) {
		//alert("SEND FILE");
        data = new FormData();
        data.append("fileImage", file);
        data.append("_token",$('#_token').val());
        $.ajax({
            data: data,
            type: "POST",
            url: "admin/news/uploadImage",
            cache: false,
            contentType: false,
            processData: false,
            success: function(url) {
            	$('.summernoteContent').summernote('editor.insertImage', url);
            }
        });
    }

	function toggleNewsType(){
		if($('#newsType').val()==1){
			$('#youTubeUrl').prop('disabled',false);
			$('#newsImage').prop('disabled',true);
			$('#youTubeUrlRequired').show();
			$('#newsImageRequired').hide();
		}
		else{
			$('#newsImage').prop('disabled',false);
			$('#youTubeUrl').prop('disabled',true);
			$('#newsImageRequired').show();
			$('#youTubeUrlRequired').hide();
		}
	}

</script>
@endsection