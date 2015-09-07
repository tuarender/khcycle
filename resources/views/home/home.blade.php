@extends('app')
@section('content')
@include('partials.banner')
    <div id="detail" class="detail" style="display:none;">
      <div class="container-fluid" style="width:90%">
        <div class="col-md-4 catalogue">
          <div class="head1">Lastest Catalogue</div>
          <div class="lastestCatalogue">
<?php
  if(isset($catalogue)){
    if(!is_null($catalogue[0])){
      echo "<a href='pdf/".$catalogue[0]['CATALOGUE_PATH_PDF']."' target='_blank'>";
      echo "<img src='cover/accessory.jpg' style='max-width:130px' /></a>";
      echo "<div class='catalogueDetail'><a class='linkCatalogue' href='pdf/".$catalogue[0]['CATALOGUE_PATH_PDF']."' target='_blank'>".$catalogue[0]['CATALOGUE_NAME']."</a>";
      echo "&nbsp;&nbsp;<a class='linkViewMoreCatalogue' href='catalogue'>View more..</a></div>";
    }
  }
?>
          </div>
        </div>
        <div class="col-md-8 brand head1">
          <div>
              KH Product
          </div>
          <div>
        <?php
          if(isset($brand)){
            echo "<ul id='horizontal-list'>";
            for($i=0;$i<count($brand);$i++){
              echo "<li id='".$brand[$i]["BRAND_ID"]."'>";
              echo "<a href='product/brand/".$brand[$i]["BRAND_ID"]."'>";
              echo "<div>";
              echo "<img onerror='this.src=\"images/brand/product/default.png\"' src='images/brand/product/sample".$brand[$i]["BRAND_ID"].".jpg' class='brandLogo_home'>";
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
    </div>
    <div id="newsList" class="container-fluid newsHome" style="display:none">
        <div class="row">
          <img src="images/loading.gif" style="display: block;margin-left: auto;margin-right: auto;">
        </div>
    </div>

<div class="container-fluid contactContainer" style="display:none">
  <div class="row">
    <div class="col-md-4">
      <div class="jumbotron">
        <b>KHCYCLE BIKE STUDIO</b><br>

        <b>เลขที่ 29 ถนนประเสริฐมนูญกิจ แขวงคลองกุ่ม กรุงเทพฯ 10240</b><br>
        <b>โทร: 0-2510-1906</b><br>
        <b>Email:Sales@khcycle.com</b><br>
      </div>
    </div>
    <div class="col-md-8">
      <img src="images/contact/contact.png"/>
    </div>
  </div>
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron">
          <div id="googleMap" style="width:90%;height:300px;margin-left:auto;margin-right:auto"></div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('scripts')
  <script type="text/javascript">
    var flagNewsSwap = false;
    var doTimeout;
    $(document).ready(function(){
        $('.slideContainer').fadeIn('slow',function(){
          $('#detail').fadeIn('slow'); 
          $('.contactContainer').fadeIn('slow',function(){
            var topTag = ($('.slideContainer').height()*0.8)-100;
            var rightTag = ($('.slideContainer').width()*0.9)-120;
            if($('.slideContainer').width()<800){
              rightTag-=50;
            }
            $(".tag").css({ top: topTag ,left: rightTag });
            $(".tag").fadeIn(800);
          });
          $('#footer').fadeIn('slow');
        });
        getNews();
        $(window).on('resize', function(){
          swapNews();
          clearTimeout(doTimeout);
          doTimeout = setTimeout(function() {
              resizeTag();
          }, 100);
        });
    }); 

    function resizeTag(){
      console.log("Do it!");
      console.log("width:"+$('.slideContainer').width());
      console.log("rightTag:"+rightTag);
      var topTag = ($('.slideContainer').height()*0.8)-100;
      var rightTag = ($('.slideContainer').width()*0.9)-120;
      if($('.slideContainer').width()<800){
        rightTag-=50;
      }
      $(".tag").css({ top: topTag,left: rightTag });
    }

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
  <script src="http://maps.googleapis.com/maps/api/js"></script>
  <hr>
  <script>
    var myCenter=new google.maps.LatLng(13.8082871,100.6528724);
    var marker;

    function initialize()
    {
      var mapProp = {
        center:myCenter,
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      };

      var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

      var marker=new google.maps.Marker({
        position:myCenter,
        animation:google.maps.Animation.BOUNCE
      });

      google.maps.event.addDomListener(window, "resize", function() {
         var center = map.getCenter();
         google.maps.event.trigger(map, "resize");
         map.setCenter(center); 
      });

      marker.setMap(map);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
@endsection
@stop
