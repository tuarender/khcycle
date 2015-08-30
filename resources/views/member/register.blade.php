@extends('app')
@extends('partials.subheader')
@section('content')
    <div class="contactcontainer">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
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

                        <form class="form-horizontal" role="form" method="post" action="register">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group @if ($errors->has('member_username')) has-error @endif" >
                                <label class="col-md-4 control-label"><font color="red">*</font>Username</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="member_username" value="{{ old('member_username') }}" >
                                    @if($errors->has('member_username')) <p class="help-block">{{$errors->first('member_username')}}</p>@endif
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('member_password')) has-error @endif">
                                <label class="col-md-4 control-label"><font color="red">*</font>Password</label>
                                <div class="col-md-5">
                                    <input type="password" class="form-control" name="member_password" >
                                    @if($errors->has('member_password')) <p class="help-block">{{$errors->first('member_password')}}</p>@endif
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('member_password_confirmation')) has-error @endif">
                                <label class="col-md-4 control-label"><font color="red">*</font>Confirm Password</label>
                                <div class="col-md-5">
                                    <input type="password" class="form-control" name="member_password_confirmation" >
                                    @if($errors->has('member_password_confirmation')) <p class="help-block">{{$errors->first('member_password_confirmation')}}</p>@endif
                                </div>
                            </div>


                            <div class="form-group @if ($errors->has('member_email')) has-error @endif">
                                <label class="col-md-4 control-label"><font color="red">*</font>E-Mail Address</label>
                                <div class="col-md-5">
                                    <input type="email" class="form-control" name="member_email" value="{{ old('member_email') }}" >
                                    @if($errors->has('member_email')) <p class="help-block">{{$errors->first('member_email')}}</p>@endif
                                </div>
                            </div>


                            <div class="form-group @if ($errors->has('member_email_confirmation')) has-error @endif">
                                <label class="col-md-4 control-label"><font color="red">*</font>Confirm Email</label>
                                <div class="col-md-5">
                                    <input type="email" class="form-control" name="member_email_confirmation" value="{{ old('member_email_confirmation') }}" >
                                    @if($errors->has('member_email_confirmation')) <p class="help-block">{{$errors->first('member_email_confirmation')}}</p>@endif
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('member_name')) has-error @endif">
                                <label class="col-md-4 control-label"><font color="red">*</font>ชื่อ-นามสกุล</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="member_name" value="{{ old('member_name') }}" >
                                    @if($errors->has('member_name')) <p class="help-block">{{$errors->first('member_name')}}</p>@endif
                                </div>
                            </div>


                            <div class="form-group @if ($errors->has('member_tel')) has-error @endif">
                                <label class="col-md-4 control-label"><font color="red">*</font>เบอร์โทรศัพท์</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="member_tel" value="{{ old('member_tel') }}" >
                                    @if($errors->has('member_tel')) <p class="help-block">{{$errors->first('member_tel')}}</p>@endif
                                </div>
                            </div>


                            <div class="form-group @if ($errors->has('member_address')) has-error @endif">
                                <label class="col-md-4 control-label"><font color="red">*</font>ที่อยู่</label>
                                <div class="col-md-5">
                                    <textarea rows="5"  class="form-control" name="member_address" id="{{ old('member_address') }}"></textarea>
                                    @if($errors->has('member_address')) <p class="help-block">{{$errors->first('member_address')}}</p>@endif
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('member_weight')) has-error @endif">
                                <label class="col-md-4 control-label"><font color="red">*</font>น้ำหนัก</label>
                                <div class="col-md-4">
                                    <input type="text"  class="form-control" onkeypress="validate(event)" name="member_weight" maxlength="5" value="{{ old('member_weight') }}"  >
                                    @if($errors->has('member_weight')) <p class="help-block">{{$errors->first('member_weight')}}</p>@endif
                                </div>
                                <label class="col-md-1 control-label">KG</label>
                            </div>

                            <div class="form-group @if ($errors->has('member_height')) has-error @endif">
                                <label class="col-md-4 control-label"><font color="red">*</font>ส่วนสูง</label>
                                <div class="col-md-4">
                                    <input type="text"  class="form-control" onkeypress="validate(event)" name="member_height" maxlength="5" value="{{ old('member_height') }}" >
                                    @if($errors->has('member_height')) <p class="help-block">{{$errors->first('member_height')}}</p>@endif
                                </div>
                                <label class="col-md-1 control-label">CM</label>
                            </div>

                            <div class="form-group @if ($errors->has('member_shoe')) has-error @endif">
                                <label class="col-md-4 control-label"><font color="red">*</font>เบอร์รองเท้า</label>
                                <div class="col-md-4">
                                    <input type="text"  class="form-control" onkeypress="validate(event)" name="member_shoe" maxlength="4" value="{{ old('member_shoe') }}" >
                                    @if($errors->has('member_shoe')) <p class="help-block">{{$errors->first('member_shoe')}}</p>@endif
                                </div>
                                <label class="col-md-1 control-label">EU</label>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        ยืนยัน
                                    </button>
                                    <button type="reset" class="btn btn-primary">
                                        ยกเลิก
                                    </button>
                                </div>
                            </div>
                        </form>
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