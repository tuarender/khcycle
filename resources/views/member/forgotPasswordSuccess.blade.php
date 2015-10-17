@extends('app')
@section('content')
@include('partials.subheader')
    <div class="contactcontainer">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">ลืมรหัสผ่าน</div>
                    <div class="panel-body">
                        @include('partials.flashmessage')        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@stop