@extends('app')
@section('content')
@include('partials.subheader')
    <div class="contactcontainer">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-primary loginPanel">
                    <div class="loginPanel loginPanelHeader panel-heading">แก้ไขข้อมูล</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> เกิดข้อผิดพลาด กรุณาตรวจสอบ.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        {{--<li>{{ $error }}</li>--}}
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @include('partials.flashmessage')

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
                                    <input type="text"  class="form-control" onkeypress="validate(event)" name="member_weight" maxlength="5" value="{{ $members['KH_INFORMATION_HEIGHT']  }}"  >
                                    @if($errors->has('member_weight')) <p class="help-block">{{$errors->first('member_weight')}}</p>@endif
                                </div>
                                <label class="col-sm-1 control-label">KG</label>
                            </div>

                            <div class="form-group @if ($errors->has('member_height')) has-error @endif">
                                <label class="col-sm-4 control-label"><font color="red">*</font>ส่วนสูง</label>
                                <div class="col-sm-4">
                                    <input type="text"  class="form-control" onkeypress="validate(event)" name="member_height" maxlength="5" value="{{ $members['KH_INFORMATION_WEIGHT']   }}" >
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
                       @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function validate(evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode( key );
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }


    </script>
@endsection
@stop