<?php
	if(isset($banners)){
?>
<div class="slideContainer" style="display:none;position: relative">
  <div class="fotorama" data-nav="false" data-width="100%" data-height="100%" data-ratio="2" data-fit="cover" data-autoplay="true"  data-click="false" data-loop="true">
<?php
	foreach ($banners as $banner) {
		if($banner['BANNER_IS_YOUTUBE']==1){
			echo "<a href='".$banner['BANNER_YOUTUBE_URI']."'><img src='images/banner/".$banner['BANNER_IMAGE'].".".$banner['BANNER_IMAGE_EXT']."'></a>";
		}
		else{
			echo "<div data-img='images/banner/".$banner['BANNER_IMAGE'].".".$banner['BANNER_IMAGE_EXT']."'>";
			echo "<a href='".$banner['BANNER_URL']."' target='_blank'></a>";
			echo "</div>";
		}
	}
?>
  </div>
  <div class="container tag" style="display:none">
  	<div class="row">
  		<div class="col-xs-12">
  			<h3><u>Follow us</u></h3>
  		</div>
  	</div>
  	<div class="row">
  		<div class="col-xs-12">
            <a class="tagFacebookImage" href="https://www.facebook.com/KhcycleThailand" target="_blank">
              <img src="images/facebook.png" style="max-width:150px">
            </a>
            <span class="innerFollowUs">Follow us:</span>
            <a href="https://www.facebook.com/KhcycleThailand" target="_blank" class="btn btn-social-icon btn-facebook tagFacebookIcon">
                <i class="fa fa-facebook"></i>
            </a>
            <a href="https://instagram.com/khcycle_thailand/" target="_blank">
                <img src="images/instragram.png" class="img-responsive" style="max-width:32px;display:inline">
            </a>
            <a href="#lineLogo" data-targer="#lineLogo" data-toggle='modal' style="border:0px;outline:none">
                <img src="images/line.png" class="img-responsive" style="max-width:32px;display:inline;border : 0;">
            </a>
  		</div>
  	</div>
  </div>
</div>
<div  id='lineLogo' class='modal fade' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-lg'>
      <div class='modal-content'>
          <div class='modal-body'>
              <img src='images/lineQR_code.jpg' class='img-responsive' onerror='this.src="images/product/default-lg.png"'>
          </div>
      </div>
  </div>
</div>
<?php
	}
?>