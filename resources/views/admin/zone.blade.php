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
                <div class="row" style="text-align: right;padding-right: 15px">
                    <button type="button" onclick="getSetting('zone/create',true)" class="btn btn-primary">เพิ่ม ZONE</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr bgcolor="#6495ed">
                            <th>ZONE ID</th>
                            <th>ZONE NAME</th>
                            <th></th>
                        </tr>
                        @foreach($data as $zone)
                            <tr>
                                <td >{{$zone['ID']}}</td>
                                <td>{{$zone['ZONE_NAME']}}</td>

                                <td align="center">
                                    <div class='btn-group' role='group'>
                                    <button class="btn btn-warning"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> EDIT</button>
                                    <button class="btn btn-danger"><span class='glyphicon glyphicon-remove-sign' aria-hidden='true'></span> DELETE</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection