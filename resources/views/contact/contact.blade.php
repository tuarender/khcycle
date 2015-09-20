@extends('app')
@extends('partials.subheader')
@section('content')
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
    </script>

@endsection
@stop