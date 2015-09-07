<?php
	if(isset($newsList)){
?>
<div class="container-fluid">
		<?php
			$indicator = 1;
			foreach($newsList as $news){
				if($news['NEWS_IS_YOUTUBE']==1){
					$display = "<div class='videoWrapper'><iframe src='".$news['NEWS_YOUTUBE_URI']."' frameborder='0' allowfullscreen></iframe></div>";
				}
				else{
					$display = "<img class='img-responsive' onerror='this.src=\"images/news/default.png\"' src='images/news/".$news['NEWS_IMAGE_TITLE_NAME'].".".$news['NEWS_IMAGE_TITLE_EXT']."'>";
				}

				echo '<div class="row">';
				$content = "<h2>".$news['NEWS_TITLE']."</h2>";
				$content.= "<p class='news'>".$news['NEWS_CONTENT_SUB']."</p>";
				$content.= "<a href='news/".$news['NEWS_ID']."' class='btn btn-info btn-lg readmoreBtn'><span class='glyphicon glyphicon-eye-open'></span> Read more</a>";
        
				$display = "<div id='display".$indicator."' class='col-sm-8'>".$display."</div>";
				$content = "<div id='content".$indicator."' class='col-sm-4'>".$content."</div>";

				echo "<div class='col-md-12 newsEnd'>";
				echo "<div class='row newsInnerRow'>";
				if($indicator%2==1){
					echo $display;
					echo $content;
				}
				else{
					echo $content;
					echo $display;
				}

				echo "</div>";
				echo "</div>";

				echo "<div class='col-xs-12'><hr style='width:100%;margin:15px 0px;border-color:#E7E7E7'><div>";
				echo '</div>';
				$indicator+=1;
			}
		?>
		<div class="col-md-12 viewmoreContainer"><h3><a class="viewmore" href="news">View More></a><h3></div>
	</div>
</div>	
<?php
	}
	else{
		echo "Error occored.";
	}
?>