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
            <a class="btn btn-info" style="width: 120px" href="excel">Export Excel</a>

            <div class="row" style="width: 100%">
                    <form class="form-group" role="form" method="post" action="admin/member">
                        {{ csrf_field() }}
                        <div class="col-xs-2">
                            <label>ค้นหาสมาชิก:</label>
                        </div>
                        <div class="col-xs-2">
                            <label>ชื่อ-นามสกุล</label>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" name="sch_name">
                        </div>
                        <div class="col-xs-2">
                            <label>เบอร์โทรศัพท์</label>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" class="form-control" name="sch_tel">
                        </div>
                        <div class="col-xs-2">
                            <input type="submit" value="submit">
                        </div>
                    </form>
            </div>
            <div class="row">
                <div class="col-sm-8 col-lg-9">
                    <div class="col-sm-2">
                        <label>ข้อมูลสมาชิก</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr bgcolor="#6495ed">
                        <th class="text-center">ลำดับ</th>
                        <th class="text-center">UserName</th>
                        <th class="text-center">ชื่อ-นามสกุล</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">เบอร์โทรศัพท์</th>
                        <th class="text-center">น้ำหนัก</th>
                        <th class="text-center">ส่วนสูง</th>
                        <th class="text-center">เบอร์รองเท้า</th>
                        <th class="text-center">ที่อยู่</th>
                        <th class="text-center">จัดการ</th>
                    </tr>
                    {{-- */$i=1;/* --}}
                    @foreach($data as $member)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{$member['KH_MEMBER_LOGIN_USERNAME']}}</td>
                            <td>{{$member['KH_CONTACT_NAME']}}</td>
                            <td>{{$member['KH_CONTACT_EMAIL']}}</td>
                            <td>{{$member['KH_CONTACT_TEL']}}</td>
                            <td>{{$member['KH_INFORMATION_HEIGHT']}}</td>
                            <td>{{$member['KH_INFORMATION_WEIGHT']}}</td>
                            <td>{{$member['KH_INFORMATION_SHOE']}}</td>
                            <td>{{$member['KH_CONTACT_ADDR']}}</td>
                            <td><button onclick="getSetting('member/edit/{{ $member['ID'] }}',true)" class="btn btn-warning">EDIT</button></td>
                            {{--<td><a href="member/{{$member['ID']}}">EDIT</a></td>--}}
                            {{-- */$i++;/* --}}
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection