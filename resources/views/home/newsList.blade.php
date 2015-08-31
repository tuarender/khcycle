<?php
	if(isset($newsList)){
?>
<div class=".container-fluid">
	<div class="row">
		<?php
			$indicator = 1;
			foreach($newsList as $news){
				$display = "<img class='img-responsive' src='images/news/".$news['NEWS_IMAGE_TITLE_NAME'].".".$news['NEWS_IMAGE_TITLE_EXT']."'>";
				$content = "<h2>".$news['NEWS_TITLE']."</h2>";
				$content.= "<p>".$news['NEWS_CONTENT_SUB']."</p>";
				$content.= "<a href='news/".$news['NEWS_ID']."' class='btn btn-info btn-md readmoreBtn'><span class='glyphicon glyphicon-eye-open'></span> Read more</a>";
        
				$display = "<div class='col-sm-5'>".$display."</div>";
				$content = "<div class='col-sm-7'>".$content."</div>";

				echo "<div class='col-md-12'>";
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
				$indicator+=1;
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