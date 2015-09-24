@extends('admin.admin')
@section('adminContent')
    @include('admin.partials.adminSubHeader')
    <div class="sessionContainer" style="width: 100%">
        Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a>
    </div>
    <?php
    $formAction = "admin/catalogue/edit";
    if(isset($data)){
        $formAction.="/".$data[0]["CATALOGUE_ID"];
    }
    ?>

    <div class="container-fluid">
        @include('partials.flashmessage')
        <form id="bannerForm" class="form-horizontal" role="form" method="post" action="<?=$formAction?>"  enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group @if ($errors->has('CATALOGUE_NAME')) has-error @endif">
                <label for="url" class="col-sm-3 control-label"><font color="red">*</font>ชื่อ CATALOGUE :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="CATALOGUE_NAME" value="{{old('CATALOGUE_NAME', $data[0]['CATALOGUE_NAME'] )}}" >
                    @if($errors->has('CATALOGUE_NAME'))
                        <p class="help-block">{{$errors->first('CATALOGUE_NAME')}}</p>@endif
                </div>
            </div>

            <?php
            if(isset($data)){
                echo "<div class='form-group'>";
                echo " <label class='col-sm-3 control-label'>ตัวอย่างภาพหน้าปก</label>";
                echo " <div class='col-sm-3'>";
                echo "  <img class='img-responsive' src='cover/".$data[0]['CATALOGUE_COVER_PIC']."'>";
                echo " </div>";
                echo "</div>";
            }
            ?>

            <div class="form-group @if ($errors->has('filecover')) has-error @endif">
                <label for="url" class="col-sm-3 control-label"><font color="red">*</font>รูปหน้าปก CATALOGUE :</label>
                <div class="col-sm-5">
                    <input type="file" name="filecover"  >
                    <p class="help-block">.jpg, Limit size &lt; 2MB</p>
                    @if($errors->has('filecover'))
                        <p class="help-block">{{$errors->first('filecover')}}</p>@endif
                </div>
            </div>
            <div class="form-group @if ($errors->has('filepdf')) has-error @endif">
                <label for="url" class="col-sm-3 control-label"><font color="red">*</font>ไฟล์ CATALOGUE :</label>
                <div class="col-sm-5">
                    <input type="file"  name="filepdf" >
                    @if($errors->has('filepdf'))
                        <p class="help-block">{{$errors->first('filepdf')}}</p>@endif
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-4">
                    <button type="submit" class="btn btn-primary btnKhcycle">
                        ยืนยันและบันทึก
                    </button>
                    <a href="admin/catalogue" class="btn btn-primary btnKhcycle">
                        ยกเลิก
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection