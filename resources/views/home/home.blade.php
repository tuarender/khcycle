@extends('app')
@section('content')
@include('partials.banner')
    <div id="detail" class="detail" style="display:none;">
      <div class="container-fluid" style="width:85%">
        <div class="col-md-4 catalogue head1">
          Lastest Catalogue
          <div>
            <a href="catalogue"><img src="cover/accessory.jpg"  style="max-width:130px" /></a><br>
            <a href="catalogue">Read more...</a>
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
    </div>
    <div id="newsList" class="container-fluid newsHome" style=";display:none">
        <div class="row">
          <img src="images/loading.gif" style="display: block;margin-left: auto;margin-right: auto;">
        </div>
    </div>

  <div class="contactContainer" style="display:none">
    <div class="jumbotron">
    <div class="row">
      <div class="col-lg-4">
        <b>KHCYCLE BIKE STUDIO</b><br>

        <b>เลขที่ 29 ถนนประเสริฐมนูญกิจ แขวงคลองกุ่ม กรุงเทพฯ 10240</b><br>
        <b>โทร: 0-2510-1906</b><br>
        <b>Email:Sales@khcycle.com</b><br>

        คลิ๊กเพื่อดูแผนที่ขนาดใหญ่<br>
        <div id="googleMap" style="width:400px;height:300px;"></div>
      </div>
      <div class="col-lg-8">
        <img src="images/contact/contact.png"/>
      </div>
    </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script type="text/javascript">
    var flagNewsSwap = false;
    $(document).ready(function(){
        $('.slideContainer').fadeIn('slow',function(){
          $('#detail').fadeIn('slow'); 
          $('.contactContainer').fadeIn('slow');
          $('#footer').fadeIn('slow');
        });
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

      marker.setMap(map);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
@endsection
@stop
