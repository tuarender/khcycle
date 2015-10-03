@extends('admin.admin')
@section('adminContent')
@include('admin.partials.adminSubHeader')
<div class="sessionContainer" style="width: 100%">
    Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a>
</div>
<?php
	$formAction = "admin/product/group";
	$groupName  = "";
	if(isset($data)){
		$formAction.="/".$data[0]["GROUP_ID"];
		$groupName =$data[0]["GROUP_NAME"];
	}

?>
<div class="container-fluid">
	@include('partials.flashmessage')
	<form id="bannerForm" class="form-horizontal" role="form" method="post" action="<?=$formAction?>" >
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="form-group @if ($errors->has('groupName')) has-error @endif">
			<label for="groupName" class="col-md-2 control-label"><font color="red">*</font>ระบุชื่อกลุ่ม</label>
			<div class="col-md-5">
				<input type="text" class="form-control" name="groupName" value="{{old('groupName',$groupName)}}" >
			</div>
		</div>
        <div class="form-group">
            <div class="col-md-5 col-md-offset-2">
                <button type="submit" class="btn btn-primary btnKhcycle">
                    บันทึก
                </button>
            </div>
        </div>
	</form>
	<div class="row">
		<div class="col-md-5 col-md-offset-2">
<?php
	echo "<ul class='list-group' style='text-align:left'>";
	foreach ($dataGroup as $group){
		echo "<li class='list-group-item'>".$group['GROUP_NAME']."&nbsp;&nbsp;<a href='admin/product/group/".$group['GROUP_ID']."'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> แก้ไข</a>";
		echo "&nbsp;&nbsp;<a href='#' style='color:#c9302c'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> ลบ</a></li>";
	}
	echo "</ul>";
?>
		</div>
	</div>
</div>
@endsection