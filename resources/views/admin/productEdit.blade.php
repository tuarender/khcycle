@extends('admin.admin')
@section('adminContent')
@include('admin.partials.adminSubHeader')
<div class="sessionContainer" style="width: 100%">
    Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a>
</div>
<?php
	$formAction = "admin/product/product";
	$requireImage = "<font color='red'>*</font>";
	$productName = "";
	$selectedGroup = "";
	if(isset($data)){
		$selectedGroup = $data[0]['PRODUCT_GROUP_ID'];
		$requireImage = "";
		$formAction.="/".$data[0]["PRODUCT_ID"];
		$productName = $data[0]["PRODUCT_NAME"];
	}

?>
<div class="container-fluid">
	@include('partials.flashmessage')
	<form id="productForm" class="form-horizontal" role="form" method="post" action="<?=$formAction?>"  enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group">
			<label for="brand" class="col-sm-3 control-label">แบรนด์สินค้า</label>
			<div class="col-sm-3">
				<input type="hidden" name="brandId" value="{{$dataBrand[0]['BRAND_ID']}}"/>
				<input class="form-control" id="brandName" type="text" value="{{$dataBrand[0]['BRAND_NAME']}}" readonly>
			</div>
		</div>
		<div class="form-group @if ($errors->has('productGroup')) has-error @endif">
			<label for="productGroup" class="col-sm-3 control-label"><font color="red">*</font>ระบุกลุ่ม</label>
			<div class="col-sm-3">
				<select name="productGroup" class="form-control">
				  	<option value="">กรุณาเลือกกลุ่ม</option>
<?php
	if(isset($dataGroup)){
		foreach ($dataGroup as $group) {
			echo "<option value='".$group['GROUP_ID']."'";
			if($selectedGroup==$group['GROUP_ID']){
				echo " selected";
			}
			echo">".$group['GROUP_NAME']."</option>";
		}
	}
?>
				</select>
			</div>
		</div>

<?php
	if(isset($data)){
		echo "<div class='form-group'>";
		echo " <label class='col-sm-3 control-label'>ตัวอย่างภาพสินค้า</label>";
		echo " <div class='col-sm-3'>";
		echo "  <img class='img-responsive' src='images/product/".$data[0]['PRODUCT_MIN_FILE_NAME'].".".$data[0]['PRODUCT_MIN_EXT']."' onerror='this.src=\"images/product/default.png\"'>";
		echo " </div>";
		echo "</div>";
	}
?>
		<div class="form-group @if ($errors->has('productImage')) has-error @endif">
			<label for="productImage" class="col-sm-3 control-label"><?=$requireImage?>แนบภาพสินค้า</label>
			<div class="col-sm-5">
				<input type="file" name="productImage" id="productImage">
				<p class="help-block">.jpg and .png, Limit size &lt; 1MB</p>
				@if($errors->has('productImage')) 
                <p class="help-block">{{$errors->first('productImage')}}</p>@endif
			</div>
		</div>
		<div class="form-group @if ($errors->has('productName')) has-error @endif">
            <label for="productName" class="col-sm-3 control-label"><font color="red">*</font>ข้อมูลสินค้า</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="productName" value="{{old('productName',$productName)}}" >
                @if($errors->has('productName')) 
                <p class="help-block">{{$errors->first('productName')}}</p>@endif
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