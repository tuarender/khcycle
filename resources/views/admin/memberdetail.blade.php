@extends('admin.admin')
@section('adminContent')
    @include('admin.partials.adminSubHeader')
    <div class="adminContainer">
        <div class="col-md-8">
            <div class="sessionContainer" style="width: 90%">
                Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a>
            </div>
            @foreach($data as $members)
                <form class="form-horizontal" role="form" method="post" action="updatemember/{{$members['ID']}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group @if ($errors->has('member_username')) has-error @endif" >
                        <label class="col-sm-4 control-label"><font color="red">*</font>Username</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="member_username" value="{{ $members['KH_MEMBER_LOGIN_USERNAME'] }}" readonly>
                            @if($errors->has('member_username')) <p class="help-block">{{$errors->first('member_username')}}</p>@endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('member_email')) has-error @endif">
                        <label class="col-sm-4 control-label"><font color="red">*</font>E-Mail Address</label>
                        <div class="col-sm-5">
                            <input type="email" class="form-control" name="member_email" value="{{ $members['KH_CONTACT_EMAIL'] }}" readonly>
                            @if($errors->has('member_email')) <p class="help-block">{{$errors->first('member_email')}}</p>@endif
                        </div>
                    </div>


                    <div class="form-group @if ($errors->has('member_name')) has-error @endif">
                        <label class="col-sm-4 control-label"><font color="red">*</font>ชื่อ-นามสกุล</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="member_name" value="{{ $members['KH_CONTACT_NAME'] }}" >
                            @if($errors->has('member_name')) <p class="help-block">{{$errors->first('member_name')}}</p>@endif
                        </div>
                    </div>


                    <div class="form-group @if ($errors->has('member_tel')) has-error @endif">
                        <label class="col-sm-4 control-label"><font color="red">*</font>เบอร์โทรศัพท์</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="member_tel" value="{{ $members['KH_CONTACT_TEL']  }}" >
                            @if($errors->has('member_tel')) <p class="help-block">{{$errors->first('member_tel')}}</p>@endif
                        </div>
                    </div>


                    <div class="form-group @if ($errors->has('member_address')) has-error @endif">
                        <label class="col-sm-4 control-label"><font color="red">*</font>ที่อยู่</label>
                        <div class="col-sm-5">
                            <textarea rows="5"  class="form-control" name="member_address" id="">{{ $members['KH_CONTACT_ADDR'] }}</textarea>
                            @if($errors->has('member_address')) <p class="help-block">{{$errors->first('member_address')}}</p>@endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('member_weight')) has-error @endif">
                        <label class="col-sm-4 control-label"><font color="red">*</font>น้ำหนัก</label>
                        <div class="col-sm-4">
                            <input type="text"  class="form-control" onkeypress="validate(event)" name="member_weight" maxlength="5" value="{{ $members['KH_INFORMATION_WEIGHT']  }}"  >
                            @if($errors->has('member_weight')) <p class="help-block">{{$errors->first('member_weight')}}</p>@endif
                        </div>
                        <label class="col-sm-1 control-label">KG</label>
                    </div>

                    <div class="form-group @if ($errors->has('member_height')) has-error @endif">
                        <label class="col-sm-4 control-label"><font color="red">*</font>ส่วนสูง</label>
                        <div class="col-sm-4">
                            <input type="text"  class="form-control" onkeypress="validate(event)" name="member_height" maxlength="5" value="{{ $members['KH_INFORMATION_HEIGHT']   }}" >
                            @if($errors->has('member_height')) <p class="help-block">{{$errors->first('member_height')}}</p>@endif
                        </div>
                        <label class="col-sm-1 control-label">CM</label>
                    </div>

                    <div class="form-group @if ($errors->has('member_shoe')) has-error @endif">
                        <label class="col-sm-4 control-label"><font color="red">*</font>เบอร์รองเท้า</label>
                        <div class="col-sm-4">
                            <input type="text"  class="form-control" onkeypress="validate(event)" name="member_shoe" maxlength="4" value="{{ $members['KH_INFORMATION_SHOE']  }}" >
                            @if($errors->has('member_shoe')) <p class="help-block">{{$errors->first('member_shoe')}}</p>@endif
                        </div>
                        <label class="col-sm-1 control-label">EU</label>
                    </div>

                    <div class="form-group @if ($errors->has('member_line')) has-error @endif">
                        <label class="col-sm-4 control-label"><font color="red"></font>LINE ID</label>
                        <div class="col-sm-5">
                            <input type="text"  class="form-control"  name="member_line" maxlength="20" value="{{ $members['KH_INFORMATION_LINE']  }}" >
                            @if($errors->has('member_line')) <p class="help-block">{{$errors->first('member_line')}}</p>@endif
                        </div>
                    </div>

                    <div class="form-group @if ($errors->has('member_bike')) has-error @endif">
                        <label class="col-sm-4 control-label"><font color="red"></font>จักรยานที่ใช้อยู่</label>
                        <div class="col-sm-5">
                            <input type="text"  class="form-control"  name="member_bike" maxlength="30" value="{{ $members['KH_INFORMATION_BIKE']  }}" >
                            @if($errors->has('member_bike')) <p class="help-block">{{$errors->first('member_bike')}}</p>@endif
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-4">
                            <button type="submit" class="btn btn-primary btnKhcycle">
                                ยืนยันและบันทึก
                            </button>
                            <a href="admin/member" class="btn btn-primary btnKhcycle">ยกเลิก</a>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
@endsection