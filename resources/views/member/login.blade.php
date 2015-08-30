@extends('app')
@extends('partials.subheader')
@section('content')
    <div class="contactcontainer">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('partials.flashmessage')
                <div class="panel panel-default">
                    <div class="panel-heading">เข้าสู่ระบบสมาชิก</div>
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
                                <label class="col-md-4 control-label">Username</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="kh_username" value="{{ old('kh_username') }}">
                                    @if($errors->has('kh_username')) <p class="help-block">{{$errors->first('kh_username')}}</p>@endif
                                </div>

                            </div>

                            <div class="form-group @if ($errors->has('kh_password')) has-error @endif">
                                <label class="col-md-4 control-label">Password</label>
                                <div class="col-md-5">
                                    <input type="password" class="form-control" name="kh_password">
                                    @if($errors->has('kh_password')) <p class="help-block">{{$errors->first('kh_password')}}</p>@endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-9 control-label"><a href="forgetpassword">ลืมรหัสผ่าน</a></div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-5 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        เช้าสู่ระบบ
                                    </button>
                                   <a href="register" class="btn btn-primary">สมัครสมาชิก</a>
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