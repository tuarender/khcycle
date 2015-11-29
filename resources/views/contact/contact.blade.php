@extends('app')
@section('content')
@include('partials.subheader')
    <div id="contact" class="container-fluid contactContainer" style="width:90%;display:none">
        <div class="sessionContainer" style="width: 90%">
        @if(Session::has('user'))
            <div class="row">
                Log in as {{Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a><br>
                @if(Session::get('user')->KH_MEMBER_RULE =='ADMIN')
                <a href="{{ $admin }}" class="btn btn-info btnKhcycle"><span class="glyphicon glyphicon-asterisk"></span> จัดการข้อมูลโดยแอดมิน</a>
                @endif
            </div>
        @endif

        </div>
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <div class="jumbotron" style="overflow-y: scroll;height: 100px">
                    @foreach($data as $contact)
                       <b> <?php echo nl2br($contact['KH_CONTACTUS']) ?></b>
                    @endforeach
                    <br>
                    <a href="https://www.facebook.com/KhcycleThailand" target="_blank" class="contactbutton">ติดต่อสอบถาม</a>
                </div>
                <div id="googleMap" style="width:100%;margin-left:auto;margin-right:auto;"></div>
            </div>
            <div class="col-md-8 col-lg-8">
                <img id="imgcontact" src="images/contact/contact.png" class="img-responsive"/>
            </div>
        </div>
        <br>
        <div class="row">
            @foreach($zone as $datazone)
                <ul>
                    {{$datazone['ZONE_NAME']}}
                   @foreach($zonesub as $sub)
                       @if($sub['ZONE_NAME']==$datazone['ZONE_NAME'])
                            <li><a href="#" data-toggle="modal" data-target="#shopModal" data-whatever="{{$sub['BRANCH_SHOP']}}" data-body="{{ nl2br($sub['BRANCH_ADDR'])}}"
                                        data-email="{{$sub['BRANCH_EMAIL']}}" data-brand01="{{$sub['BRANCH_BRAND_01']}}"
                                   data-brand02="{{$sub['BRANCH_BRAND_02']}}"data-brand03="{{$sub['BRANCH_BRAND_03']}}"
                                   data-brand01="{{$sub['BRANCH_BRAND_04']}}"data-brand01="{{$sub['BRANCH_BRAND_05']}}"
                                   data-brand06="{{$sub['BRANCH_BRAND_06']}}"data-brand07="{{$sub['BRANCH_BRAND_07']}}"
                                   data-brand08="{{$sub['BRANCH_BRAND_08']}}"data-brand09="{{$sub['BRANCH_BRAND_09']}}"
                                   data-brand10="{{$sub['BRANCH_BRAND_10']}}">
                                    {{$sub['BRANCH_SHOP']}} </a></li>
                        @endif
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
    </div>


    <div class="modal fade" id="shopModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
    </div>

@endsection
@section('scripts')
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script>
        $(document).ready(function(){
            $('#contact').fadeIn(1200);
            $('#footer').fadeIn('slow');
            ImageResize();
            $(window).on('resize', function(){
                ImageResize();
            });
        });
        var myCenter=new google.maps.LatLng(13.8082871,100.6528724);
        var marker;

        function initialize()
        {
            var mapProp = {
                center:myCenter,
                zoom:15,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };

            var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

            var marker=new google.maps.Marker({
                position:myCenter,
                animation:google.maps.Animation.BOUNCE
            });

            google.maps.event.addDomListener(window, "resize", function() {
                var center = map.getCenter();
                google.maps.event.trigger(map, "resize");
                map.setCenter(center); 
            });

            marker.setMap(map);
        }

        google.maps.event.addDomListener(window, 'load', initialize);


        function ImageResize(){
            if($(window).width()<=991)
            {
                $('#googleMap').height(180);
            }else{
            var imgpic = $('#imgcontact').height()-130;
            $('#googleMap').height(imgpic);
            //           alert( imgpic);
            }
        };


        $('#shopModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            var address = button.data('body')
            var email = button.data('email')
            var brand01 = button.data('brand01')
            var brand02 = button.data('brand02')
            var brand03 = button.data('brand03')
            var brand04 = button.data('brand04')
            var brand05 = button.data('brand05')
            var brand06 = button.data('brand06')
            var brand07 = button.data('brand07')
            var brand08 = button.data('brand08')
            var brand09 = button.data('brand09')
            var brand10 = button.data('brand10')

            var all_brand = [brand01,brand02,brand03,brand04,brand05,brand06,brand07,brand08,brand09,brand10];
            all_brand = $.grep(all_brand,function(n){return(n)});

            //alert(all_brand);

            var body = "<div>"+address+"</div><div>EMAIL: "+email+"</div><div>BRAND: "+all_brand +"</div>"
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text(recipient)
            modal.find('.modal-body').html(body)
        })
    </script>

@endsection
@stop