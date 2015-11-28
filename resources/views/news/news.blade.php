@extends('app')
@section('content')
@include('partials.subheader')
<?php
	if(isset($news)){
?>
<div id="fb-root"></div>
<div id="newsContainer" class="container-fluid" style="max-width:80%;display:none">
<?php
	echo "<div class='row'>";
	echo "<h1>".$news[0]['NEWS_TITLE']."</h1>";
	echo "</div>";
	echo "<div class='row'>";
	echo "<div class='fb-share-button' ";
    echo "data-href='http://khcycle.co.th/news/".$news[0]['NEWS_ID']."'"; 
    echo "    data-layout='button_count' style='margin-bottom:5px;'>";
    echo "</div>";
//	echo "<div data-easyshare data-easyshare-http data-easyshare-url='/news/".$news[0]['NEWS_ID']."' style='margin-bottom:5px;'>";
//	echo "<button data-easyshare-button='facebook'>";
//	echo " <span class='fa fa-facebook'></span>";
//	echo " <span>Share</span> </button>";
//	echo "</div>";
	echo "</div>";
	echo "<div class='row'>";
	if($news[0]['NEWS_IS_YOUTUBE']==0){
		echo "<img onerror='this.src=\"images/news/default.png\"' src='images/news/".$news[0]['NEWS_IMAGE_TITLE_NAME'].".".$news[0]['NEWS_IMAGE_TITLE_EXT']."' class='img-responsive imageTitleNews'>";
	}
	else{
		echo "<div class='videoWrapper'><iframe src='".$news[0]['NEWS_YOUTUBE_URI']."' frameborder='0' allowfullscreen></iframe></div>";
	}
	echo "</div>";
	echo "<div class='row topBuffer'>";
	echo "<p  class='news'>".html_entity_decode($news[0]['NEWS_CONTENT'])."</p>";
	echo "</div>";
?>
</div>
<?php
	}
	else{
		echo "Error occored.";
	}
?>
@endsection
@section('scripts')
<script type="text/javascript">
	(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=164040760280647";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

    $(document).ready(function(){
        $('#newsContainer').fadeIn('slow');
        $('#footer').fadeIn('slow');
    });
</script>
@endsection
@stop