@extends('app')
@extends('partials.subheader')
@section('content')
<?php
	if(isset($newsList)){
?>
<div id="newsContainer" class="container-fluid" style="display:none">
	<div class="row">
		<?php
			foreach($newsList as $news){
				echo "<div class='col-md-6'>";
				echo "<div class='row newsInnerRow'>";
				echo "<div class='col-sm-6'>";
				if($news['NEWS_IS_YOUTUBE']==1){
					echo "<div class='videoWrapper'><iframe src='".$news['NEWS_YOUTUBE_URI']."' frameborder='0' allowfullscreen></iframe></div>";
				}
				else{
					echo "<img class='img-responsive' onerror='this.src=\"images/news/default.png\"' src='images/news/".$news['NEWS_IMAGE_TITLE_NAME'].".".$news['NEWS_IMAGE_TITLE_EXT']."'>";
				}
				echo "</div>";
				echo "<div class='col-sm-6'>";
				echo "<h2>".$news['NEWS_TITLE']."</h2>";
				echo "<p class='news'>".$news['NEWS_CONTENT_SUB']."</p>";
				echo "<a href='news/".$news['NEWS_ID']."' class='btn btn-info btn-md readmoreBtn'><span class='glyphicon glyphicon-eye-open'></span> Read more</a>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
			}
		?>
	</div>
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
        $('#newsContainer').fadeIn(1500);
    });
</script>
@endsection
@stop