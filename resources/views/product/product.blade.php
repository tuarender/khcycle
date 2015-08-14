@extends('app')
@section('content')

<div class="productContainer">
</div>
<?php
  if(isset($brand)){
    print_r($brand);
  }
?>
@endsection
@stop