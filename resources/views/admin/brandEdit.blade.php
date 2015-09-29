@extends('admin.admin')
@section('adminContent')
@include('admin.partials.adminSubHeader')
<div class="sessionContainer" style="width: 100%">
    Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a>
</div>
<?php
	$formAction = "admin/product/brand";
	$brandName = "";
	$requireImage = "<font color='red'>*</font>";
	if(isset($data)){
		$requireImage = "";
		$formAction.="/".$data[0]["BRAND_ID"];
		$brandName=$data[0]["BRAND_NAME"];
	}

?>
<div class="container-fluid">
	@include('partials.flashmessage')
	<form id="bannerForm" class="form-horizontal" role="form" method="post" action="<?=$formAction?>"  enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group @if ($errors->has('brandName')) has-error @endif">
			<label for="brandName" class="col-sm-3 control-label"><font color="red">*</font>ระบุชื่อแบรนด์</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" name="brandName" value="{{old('brandName',$brandName)}}" >
			</div>
		</div>

<?php
	if(isset($data)){
		echo "<div class='form-group'>";
		echo " <label class='col-sm-3 control-label'>ตัวอย่างแบรนด์</label>";
		echo " <div class='col-sm-3'>";
		echo "  <img class='img-responsive' src='images/brand/".$data[0]['BRAND_LOGO_NAME'].".".$data[0]['BRAND_LOGO_EXT']."'>";
		echo " </div>";
		echo "</div>";
	}
?>
		<div class="form-group @if ($errors->has('brandImage')) has-error @endif">
			<label for="brandImage" class="col-sm-3 control-label"><?=$requireImage?>แนบภาพหน้าปก</label>
			<div class="col-sm-5">
				<input type="file" name="brandImage" id="brandImage">
				<p class="help-block">.jpg and .png, Limit size &lt; 1MB</p>
				@if($errors->has('bannerImage')) 
                <p class="help-block">{{$errors->first('bannerImage')}}</p>@endif
			</div>
		</div>
		<div class="form-group">
            <label for="url" class="col-sm-3 control-label">หมวดหมู่</label>
            <div id="groupDiv" class="col-sm-5" style="padding-top:10px">
            	<ul class="adminGroupList">
            		<li>All</li>
<?
	if(isset($dataGroup)){
		foreach ($dataGroup as $group) {

			echo "<li>".$group['GROUP_NAME']."&nbsp;&nbsp;<a href='admin/product/deleteGroup/".$group['GROUP_ID']."'><span class='glyphicon glyphicon-remove' ></span>ลบ</a></li>";
		}
	}
?>
					
				</ul>
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