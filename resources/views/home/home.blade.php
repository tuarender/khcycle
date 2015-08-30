@extends('app')
@section('content')
@include('partials.banner')
    <div id="detail" class="detail" style="display:none">
      <div class="catalogue head1">
        Lastest Catalogue
        <div>
          <a href="catalogue"><img src="cover/accessory.jpg"  style="max-width:130px" /></a>
        </div>
      </div>
      <div class="brand head1">
        <div>
            KH Product
        </div>
        <div>
        <ul id="horizontal-list">
          <li><a href="#"><img src="images/brand/product/sample1.jpg" /></a></li>
          <li><a href="#"><img src="images/brand/product/sample2.jpg" /></a></li>
          <li><a href="#"><img src="images/brand/product/sample3.jpg" /></a></li>
          <li><a href="#"><img src="images/brand/product/sample4.jpg" /></a></li>
        </ul>
      </div>
      </div>
    </div>
    <div id="newsList" class="container-fluid" style="max-width:80%;display:none">
        <div class="row">
          <img src="images/loading.gif" style="display: block;margin-left: auto;margin-right: auto;">
        </div>
    </div>
@endsection
@section('scripts')
  <script type="text/javascript">
    $(document).ready(function(){
        $('#detail').fadeIn('slow');
        getNews();
    }); 

    function getNews(){
      var url = "newsHome";
      $.ajax({
        url: url, 
        success: function(result){
          if(result){
            $('#newsList').html(result).fadeIn('slow');
          }
        }
      });
    }
  </script>
@endsection
@stop
