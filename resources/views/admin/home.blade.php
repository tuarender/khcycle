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
	<div class="row">
		<div class='col-xs-12' style="text-align:right">
		<button type="button" class="btn btn-primary btn-sm" onclick="getSetting('home/banner',true)">
		  <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> เพิ่มแบนเนอร์
		</button>
		</div>
	</div>
	<div class='table-responsive'>
		<table class="table table-bordered table-condensed table-hover tableAdmin">
			<thead>
				<tr class='tableHeader'>
					<th class='tdCenter'>จัดการลำดับ</th>
					<th class='tdCenter'>ลำดับ</th>
					<th class='tdCenter'>ชนิดแบนเนอร์</th>
					<th>ลิงค์ภาพ/วีดีโอ (Youtube)</th>
					<th class='tdCenter'>จัดการข้อมูล</th>
				</tr>
			</thead>
			<tbody>
<?php
		for ($i=0;$i<count($data);$i++) {
			$bannerType="ภาพ";
			$bannerUri=$data[$i]['BANNER_URL'];
			if($data[$i]['BANNER_IS_YOUTUBE']==1){
				$bannerType="วีดีโอ";
				$bannerUri=$data[$i]['BANNER_YOUTUBE_URI'];
			}
			echo "<tr>";
			echo "<td class='tdCenter tdGryph'>";
			if($i!=0){
				echo "<div><span class='glyphicon glyphicon-chevron-up' aria-hidden='true'></span></div>";
			}
			if($i!=count($data)-1){
				echo "<div><span class='glyphicon glyphicon-chevron-down' aria-hidden='true'></span></div>";
			}
			echo "</td>";
			echo "<td class='tdCenter'>".$data[$i]['BANNER_ORDER']."</td>";
			echo "<td class='tdCenter'>".$bannerType."</td>";
			echo "<td>".$bannerUri."</td>";
			echo "<td class='tdCenter'>";
			echo "<div class='btn-group' role='group'>";
			echo "  <button type='button' onclick='getSetting(\"home/banner/".$data[$i]['BANNER_ID']."\",true)' class='btn btn-warning'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> แก้ไข</button>";
			echo "  <button type='button' onclick='' class='btn btn-danger'><span class='glyphicon glyphicon-remove-sign' aria-hidden='true'></span> ลบ</button>";
			echo "</div>";
			echo "</td>";
			echo "</tr>";
		}
?>			</tbody>
		</table>
	</div>
</div>
<?php
	}
	else{
		echo "error occered";
	}
?>
@endsection