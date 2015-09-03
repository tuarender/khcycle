@extends('app')
@extends('partials.subheader')
@section('content')
<?php
	if(isset($news)){
?>
<div id="newsContainer" class="container-fluid" style="max-width:80%;display:none">
<?php
	echo "<div class='row'>";
	echo "<h1>".$news[0]['NEWS_TITLE']."</h1>";
	echo "</div>";
	echo "<div class='row'>";
	echo "<img src='images/news/".$news[0]['NEWS_IMAGE_TITLE_NAME'].".".$news[0]['NEWS_IMAGE_TITLE_EXT']."' class='img-responsive imageTitleNews'>";
	echo "</div>";
	echo "<div class='row topBuffer'>";
	echo "<p  class='news'>".$news[0]['NEWS_CONTENT']."</p>";
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
    $(document).ready(function(){
        $('#newsContainer').fadeIn('slow');
    });
</script>
@endsection
@stop