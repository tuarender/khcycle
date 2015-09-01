@extends('app')
@section('content')
@include('partials.banner')
    <div id="detail" class="detail" style="display:none;">
      <div class="catalogue head1">
        Lastest Catalogue
        <div>
          <a href="catalogue"><img src="cover/accessory.jpg"  style="max-width:130px" /></a><br>
          <a href="catalogue">Read more...</a>
        </div>
      </div>
      <div class="brand head1">
        <div>
            KH Product
        </div>
        <div>
      <?php
        if(isset($brand)){
          echo "<ul id='horizontal-list'>";
          for($i=0;$i<count($brand);$i++){
            echo "<li id='".$brand[$i]["BRAND_ID"]."'>";
            echo "<a href='#'>";
            echo "<div class='brandDiv'>";
            echo "<img src='images/brand/product/sample".$brand[$i]["BRAND_ID"].".jpg' class='brandLogo_home'>";
            echo "</div>";
            echo "</a>";
            echo "</li>";
          }
          echo "</ul>";
        }
      ?>
      </div>
      </div>
    </div>
    <div id="newsList" class="container-fluid" style="max-width:85%;display:none">
        <div class="row">
          <img src="images/loading.gif" style="display: block;margin-left: auto;margin-right: auto;">
        </div>
    </div>
@endsection
@section('scripts')
  <script type="text/javascript">
    var flagNewsSwap = false;
    $(document).ready(function(){
        $('#detail').fadeIn('slow');
        getNews();
        $(window).on('resize', function(){
          swapNews();
        });
    }); 

    function getNews(){
      var url = "newsHome";
      $.ajax({
        url: url, 
        success: function(result){
          if(result){
            $('#newsList').html(result).fadeIn('slow',function(){
              swapNews();
            });
          }
        }
      });
    }

    function swapNews(){
      if ($(this).width() <=749) {
        if(!flagNewsSwap){
          for(var i=2;$('#display'+i).length;i+=2){
            var display = $('#display'+i).clone();
            var content = $('#content'+i).clone();
            $('#display'+i).replaceWith(content);
            $('#content'+i).replaceWith(display);
          }
          flagNewsSwap = true;
        }
      }
      else{
        if(flagNewsSwap){
          for(var i=2;$('#display'+i).length;i+=2){
            var display = $('#display'+i).clone();
            var content = $('#content'+i).clone();
            $('#content'+i).replaceWith(display);
            $('#display'+i).replaceWith(content);
          }
          flagNewsSwap = false;
        }
      }
    }
  </script>
@endsection
@stop
