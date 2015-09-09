@extends('app')

@section('content')
    <div class="adminContainer">
        <div class="col-md-4">
            <div class="container">
                @extends('partials.sideleftadmin')
            </div>
        </div>


    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <form class="form-horizontal" role="form" method="post" action="listmember">
                 {{ csrf_field() }}
                <div class="col-sm-2">
                    <label>ค้นหาสมาชิก:</label>
                </div>
                <div class="col-sm-2">
                    <label>ชื่อ-นามสกุล</label>
                </div>
                <div class="col-sm-2">
                    <input type="text" name="sch_name">
                </div>
                <div class="col-sm-2">
                    <label>เบอร์โทรศัพท์</label>
                </div>
                <div class="col-sm-2">
                    <input type="text" name="sch_tel">
                </div>
                <div class="col-sm-1">
                    <input type="submit" value="submit">
                </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
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
                        <td><a href="member/{{$member['ID']}}">EDIT</a></td>
                        {{-- */$i++;/* --}}
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

@endsection