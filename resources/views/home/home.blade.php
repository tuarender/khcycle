@extends('app')
@section('content')
@include('partials.banner')
    <div class="detail">
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
    <div style="height:500px;background-color:">

<?php
  if(isset($data)){
    print_r($data);
  }
?>
    </div>
@endsection
@stop
