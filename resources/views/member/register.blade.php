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
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="post" action="register">
                            <input type="text" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font>Username</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="member_username" value="{{ old('member_username') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font>Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="member_password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font>Confirm Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="member_password_confirmation">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font>E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="member_email" value="{{ old('member_email') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font>Confirm Email</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="member_email_confirmation" value="{{ old('member_email_confirmation') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font>ชื่อ-นามสกุล</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="member_name" value="{{ old('member_name') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font>เบอร์โทรศัพท์</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="member_tel" value="{{ old('member_tel') }}">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font>ที่อยู่</label>
                                <div class="col-md-6">
                                    <textarea rows="5"  class="form-control" name="member_address" id="{{ old('member_address') }}">
                                        </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font>น้ำหนัก</label>
                                <div class="col-md-5">
                                    <input type="text"  class="form-control" name="member_weight" value="{{ old('member_weight') }}">
                                </div>
                                <label class="col-md-1 control-label">KG</label>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font>ส่วนสูง</label>
                                <div class="col-md-5">
                                    <input type="text"  class="form-control" name="member_height" value="{{ old('member_height') }}">
                                </div>
                                <label class="col-md-1 control-label">CM</label>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"><font color="red">*</font>เบอร์รองเท้า</label>
                                <div class="col-md-5">
                                    <input type="text"  class="form-control" name="member_shoe" value="{{ old('member_shoe') }}">
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
@stop