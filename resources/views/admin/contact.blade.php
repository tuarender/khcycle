<div class="adminContainer">
    <div class="col-md-8">
        <div class="container">
            {{$name}}
            <hr style='width:100%;margin:15px 0px;border-color:#E7E7E7'>
        </div>
        <div class="sessionContainer" style="width: 90%">
            Log in as:{{ Session::get('user')->KH_MEMBER_LOGIN_USERNAME }} <a href="logout">ออกจากระบบ</a>
        </div>
        @include('partials.flashmessage')
        @foreach($data as $contact)
        <form class="form-horizontal" role="form" method="post" action="postcontact">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="col-md-3">
                    รายละเอียดโดยย่อ
                </div>
                <div class="col-md-9">
                    <textarea name="contact_name" rows="5" cols="50">{{$contact['KH_CONTACTUS']}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-3">

                </div>
                <div class="col-md-9">
                    <input type="submit" class="btn btn-primary btnKhcycle" value="ยินดีและบันทึก" />
                    <input type="reset"  class="btn btn-primary btnKhcycle" value="ยกเลิก" />
                </div>
            </div>
        </form>
        @endforeach
    </div>
</div>