@extends('admin.admin')
@section('adminContent')
    <div class="adminContainer">
        <div class="membercontainer">
            {{$name}}
            <hr style='width:100%;margin:15px 0px;border-color:#E7E7E7'>

            <div class="sessionContainer" style="width: 90%">
                Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }}<a href="logout">ออกจากระบบ</a>
            </div>

            <div class="container">
                @include('partials.flashmessage')
                <div class="row" style="text-align: right;padding-right: 15px">
                    <a type="button" href="admin/branch/edit" class="btn btn-primary">เพิ่ม SHOP</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr bgcolor="#6495ed">
                            <th width="20%">ZONE NAME</th>
                            <th width="20%">BRANCH SHOP</th>
                            <th width="40%">BRANCH ADDR</th>
                            <th width="20%"></th>
                        </tr>
                        @foreach($data as $branch)
                        <tr>
                            <td>{{$branch['ZONE_NAME']}}</td>
                            <td>{{$branch['BRANCH_SHOP']}}</td>
                            <td>{{$branch['BRANCH_ADDR']}}</td>
                            <td>
                                <div class='btn-group' role='group'>
                                    <a class="btn btn-warning" href="admin/branch/edit/{{$branch['BRANCH_ID']}}"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> EDIT</a>
                                    <a class="btn btn-danger" href="admin/branch/delete/{{$branch['BRANCH_ID']}}" onclick="return confirm('Are you sure you want to delete this item?');">
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