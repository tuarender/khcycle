@extends('app')

@section('content')
    <div class="adminContainer">
                @extends('partials.sideleftadmin')

            <div class="membercontainer">
                {{$name}}
                <hr style='width:100%;margin:15px 0px;border-color:#E7E7E7'>
            </div>
            <div class="sessionContainer" style="width: 90%">
                Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }}<a href="logout">ออกจากระบบ</a>
            </div>
    </div>
@endsection