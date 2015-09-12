@extends('app')
@section('content')
    <div class="adminContainer">
        <div class="col-md-4">
            <div class="container">
                @extends('partials.sideleftadmin')
            </div>
        </div>
        <div class="col-md-8">
            <div class="container">
                {{$name}}
                <hr style='width:100%;margin:15px 0px;border-color:#E7E7E7'>
            </div>
            <div class="sessionContainer" style="width: 90%">
                Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }}<a href="logout">ออกจากระบบ</a>
            </div>
            @include('partials.flashmessage')

        </div>
    </div>
@endsection