@extends('admin.admin')
@section('adminContent')
@include('admin.partials.adminSubHeader')
<?php
    if(isset($data)){
?>
<div class="sessionContainer" style="width: 100%">
    Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a>
</div>
<div class="container-fluid">
    @include('partials.flashmessage')
    <div class="row">
        <div class='col-xs-12' style="text-align:right">
        <a href="admin/product/brand" class="btn btn-primary btn-sm disabled"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> เพิ่มแบรนด์สินค้า</a>
        </div>
    </div>
<?php
    if(count($data)>0){
?>
    <div class='table-responsive'>
        <table class="table table-bordered table-condensed table-hover tableAdmin">
            <thead>
                <tr class='tableHeader'>
                    <th class='tdCenter'>จัดการลำดับ</th>
                    <th class='tdCenter'>ลำดับ</th>
                    <th class='tdCenter'>ชื่อแบรนด์</th>
                    <th class='tdCenter'>การจัดสินค้าในแบรนด์</th>
                    <th class='tdCenter'>จัดการข้อมูล</th>
                </tr>
            </thead>
            <tbody>
<?php
        for ($i=0;$i<count($data);$i++) {
            echo "<tr>";
            echo "<td class='tdCenter tdGryph'>";
            if($i!=0){
                echo "<a href='admin/product/moveBrand/order/".$data[$i]['BRAND_ID']."/".$data[$i-1]['BRAND_ORDER']."'><div><span class='glyphicon glyphicon-chevron-up' aria-hidden='true'></span></div></a>";
            }
            if($i!=count($data)-1){
                echo "<a href='admin/product/moveBrand/order/".$data[$i]['BRAND_ID']."/".$data[$i+1]['BRAND_ORDER']."'><div><span class='glyphicon glyphicon-chevron-down' aria-hidden='true'></span></div></a>";
            }

            echo "</td>";
            echo "<td class='tdCenter'>".($i+1)."</td>";
            echo "<td class='tdCenter'>".$data[$i]['BRAND_NAME']."</td>";
            echo "<td class='tdCenter'><a href='admin/product/productOf/".$data[$i]['BRAND_ID']."' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> กดเพื่อจัดการสินค้า</a></td>";
            echo "<td class='tdCenter'>";
            echo "<div class='btn-group' role='group'>";
            echo "  <a href='admin/product/brand/".$data[$i]['BRAND_ID']."' class='btn btn-warning disabled'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> แก้ไข</a>";
            echo "  <a  href='#'' data-href='admin/product/deleteBrand/".$data[$i]['BRAND_ID']."' class='btn btn-danger' data-toggle='modal' data-target='#confirm-delete'><span class='glyphicon glyphicon-remove-sign' aria-hidden='true'></span> ลบ</a>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
?>          </tbody>
        </table>
    </div>
<?php
    }
?>
</div>
<?php
    }
    else{
        echo "error occered";
    }
?>
@endsection