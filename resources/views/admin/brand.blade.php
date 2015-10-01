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
        <a href="admin/product/brand" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> เพิ่มแบรนด์สินค้า</a>
        <a href="admin/product/group" class="btn btn-info btn-sm"><span class="glyphicon glyphicon glyphicon-th-list" aria-hidden="true"></span> จัดการกลุ่มสินค้า</a>
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
                    <th class='tdCenter'>กลุ่มสินค้า</th>
                    <th class='tdCenter'>จัดการข้อมูล</th>
                </tr>
            </thead>
            <tbody>
<?php
        for ($i=0;$i<count($data);$i++) {
            unset($selectedGroupArray);
            $selectedGroupArray = array();
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
            echo "<td class=''>";
            if(isset($data[$i]['GROUP_LIST'])){
                echo "<div class='form-group'>";
                echo "<ul style='list-style-type:none'>";
                foreach ($data[$i]['GROUP_LIST'] as $selectedGroup) {
                    echo "<li>".$selectedGroup['GROUP_NAME']." <a href='admin/product/removeGroupFromBrand/".$data[$i]['BRAND_ID']."/".$selectedGroup['GROUP_ID']."' style='color:#c9302c'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span> ลบ</a></li>";
                    array_push($selectedGroupArray, $selectedGroup['GROUP_ID']);
                }
                echo "</ul>";
                echo "</div>";
            }
            if(count($dataGroup)>0){
                $isSelectEmpty = true;
                $selectGroupForm = "<select class='form-control selectGroup' >";
                $selectGroupForm.= "<option>เลือกเพื่อเพิ่มกลุ่ม</option>";
                foreach ($dataGroup as $group) {
                    if(!in_array($group['GROUP_ID'], $selectedGroupArray)){
                        $isSelectEmpty = false;
                        $selectGroupForm.= "<option value='".$data[$i]['BRAND_ID']."/".$group['GROUP_ID']."''>".$group['GROUP_NAME']."</option>";
                    }
                }
                $selectGroupForm.= "</select>";
                if(!$isSelectEmpty){
                    echo $selectGroupForm;
                }
            }
            else{
                echo "<font color='red'>ไม่พบข้อมูลกลุ่มสินค้า</font>";
            }
            echo "</td>";

            echo "<td class='tdCenter'>";
            echo "<div class='btn-group' role='group'>";
            echo "  <a href='admin/product/brand/".$data[$i]['BRAND_ID']."' class='btn btn-warning'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> แก้ไข</a>";
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
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.selectGroup').change(function(){
                if($(this).val()){
                    window.location.href = 'admin/product/addGroupToBrand/'+$(this).val();
                }
            });
        });
    </script>
@endsection