@extends('admin.admin')
@section('adminContent')
<div class="adminContainer">
    <div class="col-md-10 col-lg-10">
        <div class="container">
            {{$name}}
            <hr style='width:100%;margin:15px 0px;border-color:#E7E7E7'>
        </div>
        <div class="sessionContainer" style="width: 90%">
            Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a>
        </div>
        @include('partials.flashmessage')
        <div class="container">
            <div class="row" style="text-align: right;padding-right: 15px">
                <button type="button" onclick="getSetting('catalogue/add',true)" class="btn btn-primary">เพิ่ม CATALOGUE</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr bgcolor="#6495ed">
                        <th class="text-center" width="15%">จัดการลำดับ</th>
                        <th class="text-center" width="10%">ลำดับ</th>
                        <th class="text-center" width="55%">ชื่อ CATALOGUE</th>
                        <th class="text-center" width="20%">จัดการ CATALOGUE</th>
                    </tr>
                    {{-- */$i=1;/* --}}
                    @foreach($data as $catalogue)
                    <tr>
                        <td></td>
                        <td>{{ $i }}</td>
                        <td>{{$catalogue['CATALOGUE_NAME']}}</td>
                        <td><button onclick="getSetting('catalogue/edit/{{ $catalogue['CATALOGUE_ID'] }}',true)" class="btn btn-warning">แก้ไข</button> &nbsp;&nbsp;
                            <button id="catalogue/delete/{{ $catalogue['CATALOGUE_ID'] }}" onclick="getSetting(this.id)" class="btn btn-danger">
                                <span class='glyphicon glyphicon-remove-sign' aria-hidden='true'></span>ลบ</button></td>
                        {{-- */$i++;/* --}}
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endSection
