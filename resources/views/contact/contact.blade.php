@extends('app')
@extends('partials.subheader')
@section('content')
    <div class="contactContainer">
        <div class="row">
            <div class="col-lg-4">
            <b>KHCYCLE BIKE STUDIO</b><br>

                    <b>เลขที่ 29 ถนนประเสริฐมนูญกิจ แขวงคลองกุ่ม กรุงเทพฯ 10240</b><br>
                    <b>โทร: 0-2510-1906</b><br>
                    <b>Email:Sales@khcycle.com</b><br>

                <a href="#" class="contactbutton">ติดต่อสอบถาม</a><br><br><br>
                <div id="googleMap" style="width:400px;height:230px;"></div>
            </div>
            <div class="col-lg-8">
                <img src="images/contact/contact.png"/>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script>
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

            marker.setMap(map);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

@endsection
@stop