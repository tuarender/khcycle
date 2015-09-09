<?php
	echo "<div>";
	if(isset($groups)&&!empty($groups)){
		echo "<ul class='groupList'>";
		echo "<li><a ";
		if(!isset($groupId)){
			echo "class='groupListActive' ";
		}
		echo "href='javascript:getProduct(".$brandId.")'>All</a></li>";
		foreach($groups as $group){
			echo "<li><a ";
			if(isset($groupId)&&$groupId==$group['GROUP_ID']){
				echo "class='groupListActive' ";
			}
			echo "href='javascript:getProduct(".$brandId.",".$group['GROUP_ID'].")'>".$group['GROUP_NAME']."</a></li>";
		}
		echo "</ul>";
	}
	echo "</div>";
?>