@extends('admin.admin')
@section('adminContent')
    <div class="adminContainer">
        <div class="membercontainer">
            {{$name}}
            <hr style='width:100%;margin:15px 0px;border-color:#E7E7E7'>

            <div class="sessionContainer" style="width: 90%">
                Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }}<a href="logout">ออกจากระบบ</a>
            </div>

            <?php
            $formAction = "admin/zone/edit";
            if(isset($data)){
                $formAction.="/".$data[0]["ID"];
            }
            ?>
            @include('partials.flashmessage')
            <div class="container-fluid">
                <form class="form-horizontal" role="form" method="post" action="<?=$formAction?>">
                    {{ csrf_field() }}
                    <div class="form-group @if ($errors->has('zone_name')) has-error @endif">
                        <label for="url" class="col-sm-3 control-label"><font color="red">*</font>ชื่อ ZONE :</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="zone_name" value="{{old('zone_name', $data[0]['ZONE_NAME'] )}}" >
                            @if($errors->has('zone_name'))
                                <p class="help-block">{{$errors->first('zone_name')}}</p>@endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary btnKhcycle">
                                บันทึก
                            </button>
                            <a class="btn btn-primary btnKhcycle" href="admin/zone">
                                ย้อนกลับ
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection