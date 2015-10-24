@extends('app')
@section('content')
@include('partials.subheader')
    <div class="contactcontainer">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">ตั้งค่ารหัสผ่าน</div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                เกิดข้อผิดพลาด กรุณาตรวจสอบ<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @include('partials.flashmessage')

                        <form class="form-horizontal" role="form" method="POST" action="resetPassword">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="resetToken" value="{{ $token }}">
                            <div class="form-group @if ($errors->has('member_password')) has-error @endif">
                                <label class="col-sm-4 control-label"><font color="red">*</font>New Password</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="member_password" maxlength="20">
                                    @if($errors->has('member_password')) <p class="help-block">{{$errors->first('member_password')}}</p>@endif
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('member_password_confirmation')) has-error @endif">
                                <label class="col-sm-4 control-label"><font color="red">*</font>Confirm New Password</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="member_password_confirmation" maxlength="20">
                                    @if($errors->has('member_password_confirmation')) <p class="help-block">{{$errors->first('member_password_confirmation')}}</p>@endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                       Submit
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
@stop