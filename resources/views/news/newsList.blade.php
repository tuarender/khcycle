@extends('app')
@section('content')
<?php
	if(isset($newsList)){
?>
<div class="container-fluid">
	<div class="row">
		<?php
			foreach($newsList as $news){
				echo "<div class='col-md-6'>";
				echo "<div class='row newsInnerRow'>";
				echo "<div class='col-sm-6'>";
				echo "<img class='img-responsive' src='images/news/".$news['NEWS_IMAGE_TITLE_NAME'].".".$news['NEWS_IMAGE_TITLE_EXT']."'>";
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
@stop