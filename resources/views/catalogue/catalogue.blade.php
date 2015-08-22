@extends('app')
@section('content')
    <br><br><br><br>

    <div class="row">
        <div class="form-group">
            <?php $i=1; ?>
                @foreach($catalogue as $data)
                    @if($i==5)
                       <br><?php $i=1; ?>
                    @endif
        <div class="col-lg-3"> <a href="pdf/{!! $data['CATALOGUE_PATH_PDF'] !!}" target="_blank"><img src="cover/{!!  $data['CATALOGUE_COVER_PIC'] !!}.jpg"> </a>
           <b> <p>{!! $data['CATALOGUE_NAME']  !!}</p></b> </div>
                        <?php $i++; ?>

        @endforeach
    </div>



@endsection
@stop