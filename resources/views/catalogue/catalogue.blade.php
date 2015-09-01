@extends('app')
@section('content')
    <div class="container-fluid" style="max-width: 60%">
        <div class="row">
            <div class="form-group">
                <?php $i=1; ?>
                    @foreach($catalogue as $data)
                        @if($i==5)
                           <br><?php $i=1; ?>
                        @endif
            <div class="col-md-3">
                <a href="pdf/{!! $data['CATALOGUE_PATH_PDF'] !!}" target="_blank">
                    <img src="cover/{!!  $data['CATALOGUE_COVER_PIC'] !!}.jpg" class="img-responsive"> </a>
               <b> <center> <p>{!! $data['CATALOGUE_NAME']  !!}</p> </center></b>
            </div>
                            <?php $i++; ?>

            @endforeach
        </div>
    </div>


@endsection
@stop