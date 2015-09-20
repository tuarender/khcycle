@extends('app')

@section('content')
    <div class="adminContainer">
        <div class="membercontainer">
            {{$name}}
            <hr style='width:100%;margin:15px 0px;border-color:#E7E7E7'>

            <div class="sessionContainer" style="width: 90%">
                Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }}<a href="logout">ออกจากระบบ</a>
            </div>

            <div class="container">
                <form class="form-horizontal" role="form" method="post" action="zone/create">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-md-3">
                            ZONE
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="zone_name" value=""/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary btnKhcycle">
                                บันทึก
                            </button>
                            <button type="reset" class="btn btn-primary btnKhcycle" onclick="getSetting('zone/index',true)">
                                ย้อนกลับ
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection