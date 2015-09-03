@extends('app')
@extends('partials.subheader')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <form class="form-horizontal" role="form" method="post" action="srch">
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
                    <input type="button" value="submit">
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
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <table border="1">
                    <tr>
                    <th>ลำดับ</th>
                    <th>UserName</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>Email</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>น้ำหนัก</th>
                    <th>ส่วนสูง</th>
                    <th>เบอร์รองเท้า</th>
                    <th>ที่อยู่</th>
                    <th>จัดการ</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection