@extends('app')
@extends('partials.subheader')
@section('content')
    <div id="contact" class="container-fluid contactContainer" style="width:90%;display:none">
        <div class="sessionContainer" style="width: 95%">
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
            <div class="col-md-4">
                <div class="jumbotron">
                    @foreach($data as $contact)
                    {{--<b>KHCYCLE BIKE STUDIO</b><br>--}}

                    {{--<b>เลขที่ 29 ถนนประเสริฐมนูญกิจ แขวงคลองกุ่ม กรุงเทพฯ 10240</b><br>--}}
                    {{--<b>โทร: 0-2510-1906</b><br>--}}
                    {{--<b>Email:Sales@khcycle.com</b><br>--}}
                       <b> <?php echo nl2br($contact['KH_CONTACTUS']) ?></b>
                    @endforeach
                    <br>
                    <a href="#" class="contactbutton">ติดต่อสอบถาม</a>
                    </div>
            </div>
            <div class="col-md-8">
                <img src="images/contact/contact.png"/>
            </div>
        </div>
        <div class="row">
            <div class="jumbotron">
                <div id="googleMap" style="width:100%;height:300px;margin-left:auto;margin-right:auto"></div>
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
    </script>

@endsection
@stop