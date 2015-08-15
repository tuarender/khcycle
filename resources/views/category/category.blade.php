@extends('app')
@section('content')
    <br><br><br><br>

    <div class="row">
        <div class="form-group">
            <?php $i=1; ?>
                @foreach($categories as $data)
                    @if($i==5)
                       <br><?php $i=1; ?>
                    @endif
        <div class="col-lg-3"> <a href="pdf/{!! $data->CATEGORY_PATH_PDF !!}" target="_blank"><img src="cover/{!!  $data->CATEGORY_COVER_PIC !!}.jpg"> </a>
           <b> <p>{!! $data->CATEGORY_NAME  !!}</p></b> </div>
                        <?php $i++; ?>

        @endforeach
    </div>



@endsection
@stop