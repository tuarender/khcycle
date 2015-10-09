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
        <a href="admin/product/product/{{$productId}}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> เพิ่มสินค้า</a>
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
                    <th class='tdCenter'>รูปสินค้า</th>
                    <th class='tdCenter'>ข้อมูลสินค้า</th>
                    <th class='tdCenter'>หมวดหมู่</th>
                    <th class='tdCenter'>จัดการสินค้า</th>
                </tr>
            </thead>
            <tbody>
<?php
        for ($i=0;$i<count($data);$i++) {
            echo "<tr>";
            echo "<td class='tdCenter tdGryph'>";
            if($i!=0){
                echo "<a href='admin/product/moveProduct/order/".$data[$i]['PRODUCT_BRAND_ID']."/".$data[$i]['PRODUCT_ID']."/".$data[$i-1]['PRODUCT_ORDER']."'><div><span class='glyphicon glyphicon-chevron-up' aria-hidden='true'></span></div></a>";
            }
            if($i!=count($data)-1){
                echo "<a href='admin/product/moveProduct/order/".$data[$i]['PRODUCT_BRAND_ID']."/".$data[$i]['PRODUCT_ID']."/".$data[$i+1]['PRODUCT_ORDER']."'><div><span class='glyphicon glyphicon-chevron-down' aria-hidden='true'></span></div></a>";
            }

            echo "</td>";
            echo "<td class='tdCenter'>".($i+1)."</td>";
            echo "<td class='tdCenter'>";
            echo "<img class='img-responsive productThumb adminProductImg' onerror='this.src=\"images/product/default.png\"' src='images/product/".$data[$i]['PRODUCT_MIN_FILE_NAME'].".".$data[$i]['PRODUCT_MIN_EXT']."'>";
            echo "</td>";
            echo "<td class='tdCenter'>".$data[$i]['PRODUCT_NAME']."</td>";
            echo "<td class='tdCenter'>".$data[$i]['GROUP_NAME']."</td>";
            echo "<td class='tdCenter'>";
            echo "<div class='btn-group' role='group'>";
            echo "  <a href='admin/product/product/".$productId."/".$data[$i]['PRODUCT_ID']."' class='btn btn-warning'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> แก้ไข</a>";
            echo "  <a  href='#'' data-href='admin/product/deleteProduct/".$data[$i]['PRODUCT_BRAND_ID']."/".$data[$i]['PRODUCT_ID']."' class='btn btn-danger' data-toggle='modal' data-target='#confirm-delete'><span class='glyphicon glyphicon-remove-sign' aria-hidden='true'></span> ลบ</a>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
?>          </tbody>
        </table>
        {!! str_replace('/?', '?', $data->render()) !!}
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