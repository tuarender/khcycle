@extends('app')
@section('content')
@include('partials.banner')
    <div id="detail" class="detail" style="display:none;">
      <div class="container-fluid">
        <div class="col-sm-4 catalogue">
          <div class="lastestCatalogue">
<?php
  if(isset($catalogue)){
    if(count($catalogue)>0){
      echo "<a href='PDF/".$catalogue[0]['CATALOGUE_PATH_PDF']."' target='_blank'>";
      echo "<div class='catalogueDetail'><a class='btn btn-md linkCatalogue' href='PDF/".$catalogue[0]['CATALOGUE_PATH_PDF']."' target='_blank'>Lastest Catalogue</a></div>";
      echo "<div><a class='linkViewMoreCatalogue' href='catalogue'>View more..</a></div>";
    }
  }
?>
          </div>
        </div>
        <div class="col-sm-8 brand head1">
          <div id="brandHome" data-loop="true" data-width="100%" data-ratio="208/58" data-autoplay="3000" data-stopautoplayontouch="false" class='row'>
        <?php
          if(isset($brand)){
            foreach($brand as $eachBrand){
              echo "<div id='".$eachBrand["BRAND_ID"]."' class='col-xs-12 col-sm-4 col-md-2 col-lg-2 brandList' style='text-align:right'>";
              echo "<a href='product/brand/".$eachBrand["BRAND_ID"]."'>";
              echo "<img onerror='this.src=\"images/brand/default.png\"' id='logoBrand".$eachBrand["BRAND_ID"]."' src='images/brand/".$eachBrand["BRAND_LOGO_NAME"].".".$eachBrand["BRAND_LOGO_EXT"]."'";
              echo " class='brandLogo_home img-responsive"; 
                if(isset($brandId)&&!is_null($brandId)&&$brandId==$eachBrand["BRAND_ID"]){
                  echo " brandLogoActive";
                }
                echo "'>";
                echo "</a>";
                echo "</div>";
            }
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
        @foreach($contact as $contacts)
          <b> <?php echo nl2br($contacts['KH_CONTACTUS']) ?></b>
        @endforeach
      </div>
      <div id="googleMap" style="width:100%;margin-left:auto;margin-right:auto"></div>
    </div>
    <div class="col-md-8">
      <img id="imgcontact" src="images/contact/contact.png"/>
    </div>
  </div>
</div>
@endsection
@section('scripts')
  <script type="text/javascript">
    var flagNewsSwap = false;
    var doTimeout;
    var isBrandSlider = false;
    $(document).ready(function(){
        $('.slideContainer').fadeIn('slow',function(){
          $('#detail').fadeIn('slow');
          $('.contactContainer').fadeIn('slow',function(){
            resizeTag();
          });
          $('#footer').fadeIn('slow');

          ImageResize();
        });
        getNews();
        brandSlider();
        $(window).on('resize', function(){
          ImageResize();
          brandSlider();
          swapNews();
          clearTimeout(doTimeout);
          doTimeout = setTimeout(function() {
              resizeTag();
          }, 100);
        });
    }); 

    function resizeTag(){
      var topTag = ($('.slideContainer').height()*0.8)-100;
      var rightTag = ($('.slideContainer').width()*0.9)-150;
      var topTagAdmin = 20;
      var rightTagAdmin = ($('.slideContainer').width()*0.9)-150;
      if($('.slideContainer').width()<800){
        rightTag-=50;
        rightTagAdmin-=50;
      }
      $(".tag").css({ top: topTag,left: rightTag });
      $(".tagAdmin").css({ top: topTagAdmin,left: rightTagAdmin });
      $(".tag").fadeIn(500);
      $(".tagAdmin").fadeIn(500);
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
    function brandSlider(){
      if ($(this).width() <=749) {
        if(!isBrandSlider){
            $('#brandHome').fotorama();
            isBrandSlider = true;
        }
      }
      else{
        if(isBrandSlider){
          $('#brandHome').data('fotorama').destroy();
          $('#brandHome').removeClass('fotorama');
          isBrandSlider = false;
        }
      }
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

    function ImageResize(){
      if($(window).width()<=991)
      {
        $('#googleMap').height(150);
      }
      else if(($(window).width()>991)&&($(window).width()<=1340))
      {
        var imgpic = $('#imgcontact').height()-210;
        $('#googleMap').height(imgpic);
      }else{
        var imgpic = $('#imgcontact').height()-185;
        $('#googleMap').height(imgpic);
      }
    };
  </script>
@endsection
@stop
