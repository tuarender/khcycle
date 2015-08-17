@extends('app')
@section('content')
@include('partials.banner')
    <div class="detail">
      <div class="catalogue head1">
        Lastest Catalogue
          <br>
          @foreach($categories as $data)
          <a href="pdf/{!! $data['CATEGORY_PATH_PDF'] !!}" target="_blank"><img src="cover/{!!  $data['CATEGORY_COVER_PIC'] !!}.jpg"  width="200px" height="150px"> </a>
          <b> <p>{!! $data['CATEGORY_NAME']  !!} <a href="category">View More>></a></p></b>
          @endforeach
      </div>
      <div class="brand head1">
        KH Product
        <ul id="horizontal-list">
          <li><a href="#"><img src="images/brand/assos.jpg" /></a></li>
          <li><a href="#"><img src="images/brand/lightweight.jpg" /></a></li>
          <li><a href="#"><img src="images/brand/scott.jpg" /></a></li>
          <li><a href="#"><img src="images/brand/sidi.jpg" /></a></li>
          <li><a href="#"><img src="images/brand/syncros.jpg" /></a></li>
          <li><a href="#"><img src="images/brand/yeti.jpg" /></a></li>
          <li><a href="#"><img src="images/brand/brand1.gif" /></a></li>
          <li><a href="#"><img src="images/brand/brand2.gif" /></a></li>
          <li><a href="#"><img src="images/brand/brand3.gif" /></a></li>
          <li><a href="#"><img src="images/brand/brand4.gif" /></a></li>
        </ul>
      </div>
    </div>


<?php
  if(isset($data)){
   // print_r($data);
  }
?>
    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>

    <br>
@endsection
@stop
