@extends('app')
@section('content')

    <div class="productContainer">
        <div class="row">
            <div class="col-lg-1">
                Contact
            </div>
            <div class="col-lg-5">

            </div>
            <div class="col-lg-3">
                สินใจสินค้าติดต่อ 0-2510-1906
            </div>
            <div class="col-lg-3">
                Social Network:
                <a class="btn btn-social-icon btn-facebook">
                    <i class="fa fa-facebook">f</i>
                </a>
                <a class="btn btn-social-icon btn-instagram">
                    <i class="fa fa-instagram">In</i>
                </a>
            </div>
        </div>
    </div>
    <div class="contactContainer">
        <div class="row">
            <div class="col-lg-4">
            <b>KHCYCLE BIKE STUDIO</b><br>

                    <b>เลขที่ 29 ถนนประเสริฐมนูญกิจ แขวงคลองกุ่ม กรุงเทพฯ 10240</b><br>
                    <b>โทร: 0-2510-1906</b><br>
                    <b>Email:Sales@khcycle.com</b><br>

                <a href="#" class="contactbutton">ติดต่อสอบถาม</a><br><br><br>
                คลิ๊กเพื่อดูแผนที่ขนาดใหญ่<br>
                <div id="googleMap" style="width:400px;height:300px;"></div>
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