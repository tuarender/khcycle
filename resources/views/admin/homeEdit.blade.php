@extends('admin.admin')
@section('adminContent')
@include('admin.partials.adminSubHeader')
<div class="sessionContainer" style="width: 100%">
    Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a>
</div>
<?php
	$formAction = "admin/home/banner";
	$isYoutube = "";
	$bannerUrl ="";
	$requireImage = "<font color='red'>*</font>";
	if(isset($data)){
		$requireImage = "";
		$formAction.="/".$data[0]["BANNER_ID"];
		$isYoutube = $data[0]['BANNER_IS_YOUTUBE']==1?"selected":"";
		$bannerUrl = $data[0]['BANNER_IS_YOUTUBE']==1?$data[0]['BANNER_YOUTUBE_URI']:$data[0]['BANNER_URL'];
		$isYoutubeOld = Input::old("bannerType");
		if($isYoutubeOld!=null&&$isYoutubeOld!=""){
			$isYoutube = $isYoutubeOld==1?"selected":"";
		}
	}

?>
<div class="container-fluid">
	@include('partials.flashmessage')
	<form id="bannerForm" class="form-horizontal" role="form" method="post" action="<?=$formAction?>"  enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="bannerType" class="col-sm-3 control-label"><font color="red">*</font>ระบุชนิดแบนเนอร์</label>
			<div class="col-sm-3">
				<select name="bannerType" class="form-control">
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
		echo "  <img class='img-responsive' src='images/banner/".$data[0]['BANNER_IMAGE'].".".$data[0]['BANNER_IMAGE_EXT']."'>";
		echo " </div>";
		echo "</div>";
	}
?>
		<div class="form-group @if ($errors->has('bannerImage')) has-error @endif">
			<label for="bannerImage" class="col-sm-3 control-label"><?=$requireImage?>แนบภาพหน้าปก</label>
			<div class="col-sm-5">
				<input type="file" name="bannerImage" id="bannerImage">
				<p class="help-block">.jpg and .png, Limit size &lt; 1MB</p>
				@if($errors->has('bannerImage')) 
                <p class="help-block">{{$errors->first('bannerImage')}}</p>@endif
			</div>
		</div>
		<div class="form-group @if ($errors->has('url')) has-error @endif">
            <label for="url" class="col-sm-3 control-label"><font color="red">*</font>ระบุลิงค์</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="url" value="{{old('url',$bannerUrl)}}" >
                @if($errors->has('url')) 
                <p class="help-block">{{$errors->first('url')}}</p>@endif
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