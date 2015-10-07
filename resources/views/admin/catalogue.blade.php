@extends('admin.admin')
@section('adminContent')

    @include('admin.partials.adminSubHeader')
<div class="adminContainer">
    <div class="col-md-10 col-lg-10">
        <div class="container">
            {{--{{$name}}--}}
            {{--<hr style='width:100%;margin:15px 0px;border-color:#E7E7E7'>--}}
        </div>
        <div class="sessionContainer" style="width: 90%">
            Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a>
        </div>
        @include('partials.flashmessage')
        <div class="container">
            <div class="row" style="text-align: right">
                <div class="col-xs-12">
                    <a href="admin/catalogue/edit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>เพิ่ม CATALOGUE</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-hover tableAdmin">
                    <thead>
                        <tr class="tableHeader">
                            <th class="text-center" width="15%">จัดการลำดับ</th>
                            <th class="text-center" width="10%">ลำดับ</th>
                            <th class="text-center" width="55%">ชื่อ CATALOGUE</th>
                            <th class="text-center" width="20%">จัดการ CATALOGUE</th>
                        </tr>
                    </thead>
                    {{-- */$i=1;/* --}}
                    {{-- */$count=count($data);/* --}}
                    <tbody>
                    @foreach($data as $catalogue)
                    <tr>
                        <td class="tdCenter tdGryph">
                        @if($i!=1)
                            <a href='admin/catalogue/moveCatalogue/order/{{$catalogue['CATALOGUE_ID']."/".($catalogue['CATALOGUE_ORDER']+1)}}'><div>
                                    <span class='glyphicon glyphicon-chevron-up' aria-hidden='true'></span></div></a>
                            @endif
                            @if($i!=count($data))
                                <a href='admin/catalogue/moveCatalogue/order/{{$catalogue['CATALOGUE_ID']."/".($catalogue['CATALOGUE_ORDER']-1)}}'><div>
                                        <span class='glyphicon glyphicon-chevron-down' aria-hidden='true'></span></div></a>
                            @endif
                        </td>
                        <td class="tdCenter">{{ $i }}</td>
                        <td class="tdCenter">{{$catalogue['CATALOGUE_NAME']}}</td>
                        <td class="tdCenter">
                             <a href="admin/catalogue/edit/{{$catalogue['CATALOGUE_ID']}}" class="btn btn-warning" ><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> แก้ไข </a>
                            <a href='#' data-href="admin/catalogue/delete/{{$catalogue['CATALOGUE_ID']}}" class="btn btn-danger" data-toggle='modal' data-target='#confirm-delete'>
                                <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> ลบ </a>
                        {{-- */$i++;/* --}}
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! str_replace('/?', '?', $data->render()) !!}
            </div>
        </div>
    </div>
</div>
@endSection
