<?php
	if(isset($banners)){
?>
<div class="slideContainer" style="display:none">
  <div class="fotorama" data-nav="false" data-width="100%" data-height="100%" data-fit="cover" data-loop="true">
<?php
	foreach ($banners as $banner) {
		if($banner['BANNER_IS_YOUTUBE']==1){
			echo "<div class='videoWrapper'><iframe src='".$banner['BANNER_YOUTUBE_URI']."' frameborder='0' allowfullscreen></iframe></div>";
		}
		else{
			echo "<img src='images/banner/".$banner['BANNER_IMAGE'].".".$banner['BANNER_IMAGE_EXT']."'>";
		}
	}
?>
  </div>
</div>
<?php
	}
?>