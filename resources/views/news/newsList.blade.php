@extends('app')
@extends('partials.subheader')
@section('content')
@if(Session::has('user'))
<div class="sessionContainer" style="width: 90%">	
    <div class="row">
        Log in as {{Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a><br>
        @if(Session::get('user')->KH_MEMBER_RULE =='ADMIN')
        <a href="admin/news" class="btn btn-info btnKhcycle"><span class="glyphicon glyphicon-asterisk"></span> จัดการข้อมูลโดยแอดมิน</a>
        @endif
    </div>
</div>
@endif
<?php
	if(isset($newsList)){
?>
<div id="newsContainer" class="container-fluid" style="display:none">
		<?php
			for($i=0;$i<count($newsList);$i++){
				if($i%2==0){
					echo "<div class='row'>";
				}
				echo "<div class='col-md-6'>";
				echo "	<div class='row newsInnerRow'>";
				echo "		<div class='col-sm-6'>";
				if($newsList[$i]['NEWS_IS_YOUTUBE']==1){
					echo "<div class='videoWrapper'><iframe src='".$newsList[$i]['NEWS_YOUTUBE_URI']."' frameborder='0' allowfullscreen></iframe></div>";
				}
				else{
					echo "<img class='img-responsive' onerror='this.src=\"images/news/default.png\"' src='images/news/".$newsList[$i]['NEWS_IMAGE_TITLE_NAME'].".".$newsList[$i]['NEWS_IMAGE_TITLE_EXT']."'>";
				}
				echo "		</div>";
				echo "		<div class='col-sm-6'>";
				echo "<h2>".$newsList[$i]['NEWS_TITLE']."</h2>";
				echo "<p class='newsList'>".html_entity_decode($newsList[$i]['NEWS_SAMPLE'])."</p>";
				echo "<a href='news/".$newsList[$i]['NEWS_ID']."' class='btn btn-info btn-md readmoreBtn'><span class='glyphicon glyphicon-eye-open'></span> Read more</a>";
				echo "		</div>";
				echo "	</div>";
				echo "</div>";
				if($i%2==1||($i+1)==count($newsList)){
					echo "</div>";
				}
			}
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
    $(document).ready(function(){
        $('#newsContainer').fadeIn(1200);
        $('#footer').fadeIn('slow');
    });
</script>
@endsection
@stop