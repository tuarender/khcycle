@extends('app')
@extends('partials.subheader')
@section('content')
    <div class="contactcontainer">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
                @include('partials.flashmessage')
                <div class="panel panel-primary loginPanel">
                    <div class="loginPanel loginPanelHeader panel-heading">เข้าสู่ระบบสมาชิก</div>
                    <div class="panel-body">
                        {{--@if (count($errors) > 0)--}}
                            {{--<div class="alert alert-danger">--}}
                                {{--<strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
                                {{--<ul>--}}
                                    {{--@foreach ($errors->all() as $error)--}}
                                        {{--<li>{{ $error }}</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--@endif--}}
                        <form class="form-horizontal" role="form" method="post" action="login">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group @if ($errors->has('kh_username')) has-error @endif">
                                <label class="col-sm-4 control-label">Username</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="kh_username" value="{{ old('kh_username') }}">
                                    @if($errors->has('kh_username')) <p class="help-block">{{$errors->first('kh_username')}}</p>@endif
                                </div>

                            </div>

                            <div class="form-group @if ($errors->has('kh_password')) has-error @endif">
                                <label class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="kh_password">
                                    @if($errors->has('kh_password')) <p class="help-block">{{$errors->first('kh_password')}}</p>@endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-9 control-label"><a href="forgetpassword">ลืมรหัสผ่าน</a></div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-5 col-sm-offset-4">
                                    <button type="submit" class="btn btn-primary btnKhcycle">
                                        เข้าสู่ระบบ
                                    </button>
                                   <a href="register" class="btn btn-primary btnKhcycle">สมัครสมาชิก</a>
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