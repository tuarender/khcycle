@extends('app')
@section('content')
@include('partials.subheader')
@if(Session::has('user'))
<div class="sessionContainer" style="width: 90%">   
    <div class="row">
        Log in as {{Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a><br>
        @if(Session::get('user')->KH_MEMBER_RULE =='ADMIN')
        <a href="admin/catalogue" class="btn btn-info btnKhcycle"><span class="glyphicon glyphicon-asterisk"></span> จัดการข้อมูลโดยแอดมิน</a>
        @endif
    </div>
</div>
@endif
    <div id="catalougeContainer" class="container-fluid" style="max-width:60%;margin-top:30px;display:none">
        <div class="row">
            <div class="form-group">
                <?php $i=1; ?>
                    @foreach($catalogue as $data)
                        @if($i==5)
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group">
                           <br><?php $i=1; ?>
                        @endif
            <div class="col-sm-3">
                <a href="PDF/{!! $data['CATALOGUE_PATH_PDF'] !!}" target="_blank">
                    <img onerror='this.src="cover/default.png"' src="cover/{!!  $data['CATALOGUE_COVER_PIC'] !!}.jpg" class="img-responsive"> </a>
               <b> <center> <p>{!! $data['CATALOGUE_NAME']  !!}</p> </center></b>
            </div>
                            <?php $i++; ?>

            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#catalougeContainer').fadeIn(1200);
        $('#footer').fadeIn('slow');
    });
</script>
@endsection
@stop