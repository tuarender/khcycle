@extends('app')
@section('content')
    <br><br><br><br>
    @foreach($categories as $d)
      <h1>  {!! $d->CATEGORY_NAME  !!} </h1>
      <a href="pdf/{!! $d->CATEGORY_PATH_PDF !!}" target="_blank"><img</a>
    @endforeach
@endsection
@stop