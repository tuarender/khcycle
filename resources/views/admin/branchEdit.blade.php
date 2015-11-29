@extends('admin.admin')
@section('adminContent')
    @include('admin.partials.adminSubHeader')
    <div class="sessionContainer" style="width: 100%">
        Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a>
    </div>
    <?php
    $formAction = "admin/branch/edit";
    if(isset($data)){
        $formAction.="/".$data[0]["BRANCH_ID"];
    }
    ?>

    <div class="container-fluid">
        @include('partials.flashmessage')
        <form id="bannerForm" class="form-horizontal" role="form" method="post" action="<?=$formAction?>">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group @if ($errors->has('BRANCH_ZONE')) has-error @endif">
                <label for="url" class="col-sm-3 control-label"><font color="red">*</font>Zone :</label>
                <div class="col-sm-5">

                    <select class="form-control" name="BRANCH_ZONE">
                        <option selected disabled value="0">--ZONE SEARCH--</option>
                        @foreach($zone as $sz)
                            <option @if($sz['ID']==$data[0]['ID'])selected="selected" @endif value="{{old('BRANCH_ZONE',$sz['ID'])}}">{{$sz['ZONE_NAME']}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('BRANCH_ZONE'))
                        <p class="help-block">{{$errors->first('BRANCH_ZONE')}}</p>@endif
                </div>
            </div>

            <div class="form-group @if ($errors->has('BRANCH_SHOP')) has-error @endif">
                <label for="url" class="col-sm-3 control-label"><font color="red">*</font>ชื่อ SHOP :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="BRANCH_SHOP" value="{{old('BRANCH_SHOP', $data[0]['BRANCH_SHOP'] )}}" >
                    @if($errors->has('BRANCH_SHOP'))
                        <p class="help-block">{{$errors->first('BRANCH_SHOP')}}</p>@endif
                </div>
            </div>

            <div class="form-group @if ($errors->has('BRANCH_BRAND_01')) has-error @endif">
                <label for="url" class="col-sm-3 control-label">แบรนด์ 1:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="BRANCH_BRAND_01" maxlength="20" value="{{old('BRANCH_BRAND_01', $data[0]['BRANCH_BRAND_01'] )}}" >
                    @if($errors->has('BRANCH_BRAND_01'))
                        <p class="help-block">{{$errors->first('BRANCH_BRAND_01')}}</p>@endif
                </div>
            </div>

            <div class="form-group @if ($errors->has('BRANCH_BRAND_02')) has-error @endif">
                <label for="url" class="col-sm-3 control-label">แบรนด์ 2:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="BRANCH_BRAND_02" maxlength="20" value="{{old('BRANCH_BRAND_02', $data[0]['BRANCH_BRAND_02'] )}}" >
                    @if($errors->has('BRANCH_BRAND_02'))
                        <p class="help-block">{{$errors->first('BRANCH_BRAND_02')}}</p>@endif
                </div>
            </div>

            <div class="form-group @if ($errors->has('BRANCH_BRAND_03')) has-error @endif">
                <label for="url" class="col-sm-3 control-label">แบรนด์ 3:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="BRANCH_BRAND_03" maxlength="20" value="{{old('BRANCH_BRAND_03', $data[0]['BRANCH_BRAND_03'] )}}" >
                    @if($errors->has('BRANCH_BRAND_03'))
                        <p class="help-block">{{$errors->first('BRANCH_BRAND_03')}}</p>@endif
                </div>
            </div>

            <div class="form-group @if ($errors->has('BRANCH_BRAND_04')) has-error @endif">
                <label for="url" class="col-sm-3 control-label">แบรนด์ 4:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="BRANCH_BRAND_04" maxlength="20" value="{{old('BRANCH_BRAND_04', $data[0]['BRANCH_BRAND_04'] )}}" >
                    @if($errors->has('BRANCH_BRAND_04'))
                        <p class="help-block">{{$errors->first('BRANCH_BRAND_04')}}</p>@endif
                </div>
            </div>

            <div class="form-group @if ($errors->has('BRANCH_BRAND_05')) has-error @endif">
                <label for="url" class="col-sm-3 control-label">แบรนด์ 5:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="BRANCH_BRAND_05" maxlength="20" value="{{old('BRANCH_BRAND_05', $data[0]['BRANCH_BRAND_05'] )}}" >
                    @if($errors->has('BRANCH_BRAND_05'))
                        <p class="help-block">{{$errors->first('BRANCH_BRAND_05')}}</p>@endif
                </div>
            </div>

            <div class="form-group @if ($errors->has('BRANCH_BRAND_06')) has-error @endif">
                <label for="url" class="col-sm-3 control-label">แบรนด์ 6:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="BRANCH_BRAND_06" maxlength="20" value="{{old('BRANCH_BRAND_06', $data[0]['BRANCH_BRAND_06'] )}}" >
                    @if($errors->has('BRANCH_BRAND_06'))
                        <p class="help-block">{{$errors->first('BRANCH_BRAND_06')}}</p>@endif
                </div>
            </div>


            <div class="form-group @if ($errors->has('BRANCH_BRAND_07')) has-error @endif">
                <label for="url" class="col-sm-3 control-label">แบรนด์ 7:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="BRANCH_BRAND_07" maxlength="20" value="{{old('BRANCH_BRAND_07', $data[0]['BRANCH_BRAND_07'] )}}" >
                    @if($errors->has('BRANCH_BRAND_07'))
                        <p class="help-block">{{$errors->first('BRANCH_BRAND_07')}}</p>@endif
                </div>
            </div>

            <div class="form-group @if ($errors->has('BRANCH_BRAND_08')) has-error @endif">
                <label for="url" class="col-sm-3 control-label">แบรนด์ 8:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="BRANCH_BRAND_08" maxlength="20" value="{{old('BRANCH_BRAND_08', $data[0]['BRANCH_BRAND_08'] )}}" >
                    @if($errors->has('BRANCH_BRAND_08'))
                        <p class="help-block">{{$errors->first('BRANCH_BRAND_08')}}</p>@endif
                </div>
            </div>

            <div class="form-group @if ($errors->has('BRANCH_BRAND_09')) has-error @endif">
                <label for="url" class="col-sm-3 control-label">แบรนด์ 9:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="BRANCH_BRAND_09" maxlength="20" value="{{old('BRANCH_BRAND_09', $data[0]['BRANCH_BRAND_09'] )}}" >
                    @if($errors->has('BRANCH_BRAND_09'))
                        <p class="help-block">{{$errors->first('BRANCH_BRAND_09')}}</p>@endif
                </div>
            </div>

            <div class="form-group @if ($errors->has('BRANCH_BRAND_10')) has-error @endif">
                <label for="url" class="col-sm-3 control-label">แบรนด์ 10:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="BRANCH_BRAND_10" maxlength="20" value="{{old('BRANCH_BRAND_10', $data[0]['BRANCH_BRAND_10'] )}}" >
                    @if($errors->has('BRANCH_BRAND_10'))
                        <p class="help-block">{{$errors->first('BRANCH_BRAND_10')}}</p>@endif
                </div>
            </div>


            <div class="form-group @if ($errors->has('BRANCH_ADDR')) has-error @endif">
                <label for="url" class="col-sm-3 control-label"><font color="red">*</font>ที่อยู่ :</label>
                <div class="col-sm-5">
                    <textarea class="form-control" name="BRANCH_ADDR" rows="5" cols="50">{{old('BRANCH_ADDR', $data[0]['BRANCH_ADDR'] )}}</textarea>
                    @if($errors->has('BRANCH_ADDR'))
                        <p class="help-block">{{$errors->first('BRANCH_ADDR')}}</p>@endif
                </div>

            </div>

            <div class="form-group @if ($errors->has('BRANCH_TEL')) has-error @endif">
                <label for="url" class="col-sm-3 control-label">เบอร์โทร Shop Dealer :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="BRANCH_TEL" value="{{old('BRANCH_TEL', $data[0]['BRANCH_TEL'] )}}" >
                    @if($errors->has('BRANCH_TEL'))
                        <p class="help-block">{{$errors->first('BRANCH_TEL')}}</p>@endif
                </div>

            </div>

            <div class="form-group @if ($errors->has('BRANCH_FAX')) has-error @endif">
                <label for="url" class="col-sm-3 control-label">เบอร์ Fax Shop Dealer :</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="BRANCH_FAX" value="{{old('BRANCH_FAX', $data[0]['BRANCH_FAX'] )}}" >
                    @if($errors->has('BRANCH_FAX'))
                        <p class="help-block">{{$errors->first('BRANCH_FAX')}}</p>@endif
                </div>

            </div>
            <div class="form-group @if ($errors->has('BRANCH_EMAIL')) has-error @endif">
                <label for="url" class="col-sm-3 control-label"><font color="red">*</font>EMAIL :</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control" name="BRANCH_EMAIL" value="{{old('BRANCH_ADDR', $data[0]['BRANCH_EMAIL'] )}}" >
                    @if($errors->has('BRANCH_EMAIL'))
                        <p class="help-block">{{$errors->first('BRANCH_EMAIL')}}</p>@endif
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-4">
                    <button type="submit" class="btn btn-primary btnKhcycle">
                        ยืนยันและบันทึก
                    </button>
                    <a href="admin/branch" class="btn btn-primary btnKhcycle">
                        ยกเลิก
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection