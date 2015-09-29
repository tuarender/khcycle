@extends('admin.admin')
@section('adminContent')
    @include('admin.partials.adminSubHeader')
    <div class="adminContainer">
        <div class="membercontainer">
            {{--{{$name}}--}}
            {{--<hr style='width:100%;margin:15px 0px;border-color:#E7E7E7'>--}}

            <div class="sessionContainer" style="width: 90%">
                Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }}<a href="logout">ออกจากระบบ</a>
            </div>

            <div class="container">
                <div class="row" style="text-align: right;padding-right: 15px">
                    <a type="button" href="admin/zone/edit" class="btn btn-primary">เพิ่ม ZONE</a>
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
                                    <a class="btn btn-warning" href="admin/zone/edit/{{$zone['ID']}}"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> EDIT</a>
                                    <a class="btn btn-danger" href="admin/zone/delete/{{$zone['ID']}}" onclick="return confirm('Are you sure you want to delete this item?');">
                                        <span class='glyphicon glyphicon-remove-sign' aria-hidden='true'></span> DELETE</a>
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