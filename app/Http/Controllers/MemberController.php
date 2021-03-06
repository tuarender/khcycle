<?php

namespace App\Http\Controllers;

use Mail;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ResetsPasswords;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function index()
    {
        //
        if(Session::has('user'))
        {
            return $this->profilemember();
        }
        else{
            return view('member.login')->with('name', 'Member');
        }
    }

    public function forgotPassword()
    {
        return view('member.forgotPassword')->with('name','ForgotPassword');
    }

    public function getResetPassword($token)
    {
        $foundToken = $this->getTokenForReset($token);
        if(count($foundToken)==1){
            Session::flash('alert-success', 'กรุณาตั้งรหัสผ่านใหม่');
            return view('member.resetPassword')->with('name','ResetPassword')->with('token',$token);
        }
        else{
            Session::flash('alert-danger', 'ไม่พบข้อมูลของรีเซ็ตรหัสผ่านในระบบ ลิงค์ดังกล่าวอาจจะหมดอายุ กรุณากรอกข้อมูลเพื่อรับอีเมล์ใหม่');
            return view('member.forgotPassword')->with('name','ForgotPassword');
        }
    }

    public function register()
    {
        return view('member.register')->with('name','Register');
    }


    public static function getEncode_member($str,$numRound)
    {
        $result = $str;
        for($i=0;$i<$numRound;$i++)
        {
            $result = base64_encode($result);
        }
        return $result;
    }

    public function postregister(Request $request)
    {
        //เงื่อไขที่ใช้ในการ Validator
        $rules=[
            'member_username' =>'required',
            'member_password'=>'required|confirmed|max:20',
            'member_password_confirmation'=>'required',
            'member_email'=>'required|email|confirmed',
            'member_email_confirmation'=>'required',
            'member_name'=>'required',
            'member_tel'=>'required',
            'member_address'=>'required',
            'member_weight'=>'required',
            'member_height'=>'required',
            'member_shoe'=>'required'
        ];
        //Custom ควบคุม Message Error
        $messages = [
            'member_username.required'=>'กรุณาระบุชื่อ Username',
            'member_password.required'=>'กรุณาระบุ Password',
            'member_password.confirmed'=>'กรุณาใส่ Password ให้ตรงกัน',
            'member_password_confirmation.required'=>'กรุณาระบุ Password',
            'member_email.required'=>'กรุณาระบุ Email',
            'member_email.email'=>'Email ของคุณไม่ถูกต้อง',
            'member_email.confirmed'=>'กรุณาใส่Emailให้ตรงกัน',
            'member_email_confirmation.required'=>'กรุณาระบุ Email',
            'member_name.required'=>'กรุณาระบุชื่อ-นามสกุล',
            'member_tel.required'=>'กรุณาระบุเบอร์โทร',
            'member_address.required'=>'กรุณาระบุที่อยู่',
            'member_weight.required'=>'กรุณาระบุน้ำหนัก',
            'member_height.required'=>'กรุณาระบุส่วนสูง',
            'member_shoe.required'=>'กรุณาระบุเบอร์รองเท้า',
            'member_password.max'=>'ความยาว password ไม่เกิน 20ตัวอักษร'
        ];
        $validator =  Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect('register')->withErrors($validator)->withInput();
        }else {

            //data for kh_member
            $member_username = $request->input('member_username','John Doe');
            $member_password = $request->input('member_password','qwerty');

            //data for contact
            $member_email = $request->input('member_email','example@mail.com');
            $member_name = $request->input('member_name','John Doe');
            $member_tel = $request->input('member_tel','0x-xxx-xxxx');
            $member_addr = $request->input('member_address','Example Address');

            //data for kh_information
            $member_height = $request->input('member_height',0.00);
            $member_weight = $request->input('member_weight',0.00);
            $member_shoe = $request ->input('member_shoe',0.00);
            $member_line = $request->input('member_line');
            $member_bike = $request->input('member_bike');

            $ervpass = $this-> getEncode_member($member_password,strlen($member_password));

            //check user
            $FindUser = $this->checkuser($member_username);
            if($FindUser>0)
            {
                Session::flash('alert-danger', 'ชื่อUserนี้ถูกใช้งานแล้ว');
                return redirect('register')->withInput();
            }

            //check email
            $FindEmail = $this->checkemail($member_email);
            if($FindEmail>0)
            {
                Session::flash('alert-danger', 'ชื่อEmailนี้ถูกใช้งานแล้ว');
                return redirect('register')->withInput();
            }

            //insert username password
            $id = DB::table('KH_MEMBER_LOGIN')->insertGetId(
              [
                  'KH_MEMBER_LOGIN_USERNAME'=>$member_username,
                  'KH_MEMBER_LOGIN_PASSWORD'=>$ervpass]
            );

            //insert contact
            DB::table('KH_CONTACT')->insert([
                'KH_CONTACT_MEMBER'=>$id,
                'KH_CONTACT_EMAIL' =>$member_email,
                'KH_CONTACT_NAME'=>$member_name,
                "KH_CONTACT_TEL"=>$member_tel,
                'KH_CONTACT_ADDR'=>$member_addr
            ]);

            //insert information
            DB::table('KH_INFORMATION')->insert([
               'KH_INFORMATION_MEMBER' =>$id,
                'KH_INFORMATION_HEIGHT'=>$member_height,
                'KH_INFORMATION_WEIGHT'=>$member_weight,
                'KH_INFORMATION_SHOE'=>$member_shoe,
                'KH_INFORMATION_LINE'=>$member_line,
                'KH_INFORMATION_BIKE'=>$member_bike
            ]);
            Session::flash('alert-success', 'สมัครสมาชิกเรียบร้อยแล้ว');
            return redirect('member');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    private function checkuser($user)
    {
        $query = DB::table('KH_MEMBER_LOGIN')
            ->where('KH_MEMBER_LOGIN_USERNAME','=',$user)
            ->count();
        return $query;
    }

    private function checkemail($email)
    {
        $query = DB::table('KH_CONTACT')
            ->where('KH_CONTACT_EMAIL','=',$email)
            ->count();
        return $query;
    }

    private function chkmatchlogin($user,$pass)
    {
        $query = DB::table('KH_MEMBER_LOGIN')
            ->where('KH_MEMBER_LOGIN_USERNAME','=',$user)
            ->where('KH_MEMBER_LOGIN_PASSWORD','=',$pass)
            ->count();
        return $query;
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $data = DB::table('KH_MEMBER_LOGIN AS login ')
            ->leftjoin('KH_INFORMATION AS info','login.ID','=','info.KH_INFORMATION_MEMBER')
            ->leftjoin('KH_CONTACT AS contact','login.ID','=','contact.KH_CONTACT_MEMBER')
            ->select(
                'login.ID',
                'login.KH_MEMBER_LOGIN_USERNAME',
                'contact.KH_CONTACT_NAME',
                'contact.KH_CONTACT_EMAIL',
                'contact.KH_CONTACT_TEL',
                'info.KH_INFORMATION_HEIGHT',
                'info.KH_INFORMATION_WEIGHT',
                'info.KH_INFORMATION_SHOE',
                'info.KH_INFORMATION_LINE',
                'info.KH_INFORMATION_BIKE',
                'contact.KH_CONTACT_ADDR')
            ->where('login.ID','=',$id)
            ->get();
        return view('member.memberdetail')->with('name','Member')->with('data',$data);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules=[
            'member_name'=>'required',
            'member_tel'=>'required',
            'member_address'=>'required',
            'member_weight'=>'required',
            'member_height'=>'required',
            'member_shoe'=>'required'
        ];
        //Custom ควบคุม Message Error
        $messages = [
            'member_name.required'=>'กรุณาระบุชื่อ-นามสกุล',
            'member_tel.required'=>'กรุณาระบุเบอร์โทร',
            'member_address.required'=>'กรุณาระบุที่อยู่',
            'member_weight.required'=>'กรุณาระบุน้ำหนัก',
            'member_height.required'=>'กรุณาระบุส่วนสูง',
            'member_shoe.required'=>'กรุณาระบุเบอร์รองเท้า'
        ];

        $validator =  Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return redirect('register')->withErrors($validator)->withInput();
        }else {

            $member_name = $request->input('member_name', 'John Doe');
            $member_tel = $request->input('member_tel', '0x-xxx-xxxx');
            $member_addr = $request->input('member_address', 'Example Address');

            //data for kh_information
            $member_height = $request->input('member_height', 0.00);
            $member_weight = $request->input('member_weight', 0.00);
            $member_shoe = $request->input('member_shoe', 0.00);

            //insert contact
            DB::table('KH_CONTACT')
                ->where('KH_CONTACT_MEMBER','=',$id)
                ->update([
                    'KH_CONTACT_NAME'=>$member_name,
                'KH_CONTACT_TEL'=>$member_tel,
                'KH_CONTACT_ADDR'=>$member_addr]
                );

            //insert information
            DB::table('KH_INFORMATION')
                ->where('KH_INFORMATION_MEMBER','=',$id)
                ->update([
                'KH_INFORMATION_HEIGHT'=>$member_height,
                'KH_INFORMATION_WEIGHT'=>$member_weight,
                'KH_INFORMATION_SHOE'=>$member_shoe
            ]);
            Session::flash('alert-success', 'อัพเดตค่าเรียบร้อยแล้ว');
            return redirect('member/'.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function postLogin(Request $request)
    {
        $rules=[
            'kh_username' =>'required',
            'kh_password'=>'required',
        ];
        //Custom ควบคุม Message Error
        $messages = [
            'kh_username.required'=>'กรุณาระบุชื่อ Username',
            'kh_password.required'=>'กรุณาระบุ Password'
        ];

        $validator =  Validator::make($request->all(),$rules,$messages);
        if($validator->fails()) {
            return redirect('member')->withErrors($validator)->withInput();
        }else{
            $kh_username = $request->input('kh_username');
            $FindUser = $this->checkuser($kh_username);

            if($FindUser>0)
            {
                $kh_password = $request->input('kh_password');
                $encryp_password = $this->getEncode_member($kh_password,strlen($kh_password));
               // dd($encryp_password);
                $matchlogin = $this->chkmatchlogin($kh_username,$encryp_password);
               // dd($encryp_password);
                if($matchlogin>0)
                {
                    $id = DB::table('KH_MEMBER_LOGIN')->select('ID')->WHERE('KH_MEMBER_LOGIN_USERNAME','=',$kh_username)->first();
                    $user = User::find($id['ID']);
                    if($user)
                    {
                        $chk = Auth::loginusingID($id['ID']);

                        //$chk = Auth::attempt(array('KH_MEMBER_LOGIN_USERNAME'=>$kh_username,
                        //'password'=>$encryp_password));

                        Session::put('user',Auth::user());

                        if(Session::get('user')->KH_MEMBER_RULE =='ADMIN')
                            return redirect('admin/member');
                        else{
                            return redirect('member');
                        }
                    }else{
                        Session::flash('alert-danger', 'False');
                        return redirect('member');
                    }
//                   if(Auth::attempt(array('KH_MEMBER_LOGIN_USERNAME'=>$kh_username,'password'=>$encryp_password)))
//                   {
//                       Session::flash('alert-danger', '1');
//                       return redirect('member');
//                   }else{
//                       Session::flash('alert-danger', '2');
//                       return redirect('member');
//                   }
                }else{
                    Session::flash('alert-danger', 'Username/Password ผิด กรุณาลองอีกครั้ง');
                    return redirect('member');
                }
            }else{
                Session::flash('alert-danger', 'ไม่พบผู้ใช้งานกรุณาลองอีกครั้ง');
                return redirect('member');
            }
        }
    }

    public function profilemember()
    {

        $id = Session::get('user')->ID;

        $data = DB::table('KH_MEMBER_LOGIN AS login ')
            ->leftjoin('KH_INFORMATION AS info','login.ID','=','info.KH_INFORMATION_MEMBER')
            ->leftjoin('KH_CONTACT AS contact','login.ID','=','contact.KH_CONTACT_MEMBER')
            ->select(
                'login.ID',
                'login.KH_MEMBER_LOGIN_USERNAME',
                'contact.KH_CONTACT_NAME',
                'contact.KH_CONTACT_EMAIL',
                'contact.KH_CONTACT_TEL',
                'info.KH_INFORMATION_HEIGHT',
                'info.KH_INFORMATION_WEIGHT',
                'info.KH_INFORMATION_SHOE',
                'info.KH_INFORMATION_LINE',
                'info.KH_INFORMATION_BIKE',
                'contact.KH_CONTACT_ADDR')
            ->where('login.ID','=',$id)
            ->get();

        return view('member.memberprofile')->with('name','Member')->with('data',$data);
    }

    public function logout()
    {
        Auth::logout();
        Session::forget('user');
        return redirect('home');
    }

    public function generateToken(){
        $string = $this->generateRandomString(17);
        return bin2hex($string);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function checkSendForget($email){
        $sended =  "SELECT COUNT(*) AS COUNT_SEND FROM KH_PASSWORD_RESET WHERE EMAIL LIKE ? AND CREATE_AT >= DATE_SUB(NOW(),INTERVAL 15 MINUTE)";
        $queryParam = array($email);
        $data = DB::select($sended,$queryParam);
        $checkCountSend = 0;
        if(count($data)>0){
            $checkCountSend = $data[0]['COUNT_SEND'];
        }
        return $checkCountSend;
    }

    function getTokenForReset($token){
        $sended =  "SELECT EMAIL,TOKEN FROM KH_PASSWORD_RESET WHERE TOKEN LIKE ? AND CREATE_AT >= DATE_SUB(NOW(),INTERVAL 15 MINUTE)";
        $queryParam = array($token);
        $data = DB::select($sended,$queryParam);
        return $data;
    }

    public function postForgotPassword(Request $request){

        $rules=[
            'email' =>'required',
        ];
        
        $messages = [
            'email.required'=>'กรุณาระบุ email',
        ];

        $validator =  Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect('forgotPassword')->withErrors($validator)->withInput();
        }
        else{
            $email = $request->input('email');
            $findUser = $this->checkemail($email);
            if($findUser>0){
                $checkSendForget = $this->checkSendForget($email);
                if($checkSendForget<3){
                    $token = $this->generateToken();
                    DB::table('KH_PASSWORD_RESET')->insert([
                        'EMAIL'=>$email,
                        'TOKEN' =>$token
                    ]);

                    $subject = "KH Cycle Reset password";
                    Mail::send('email.forgotPassword', ['data'=>$token], function ($message) use ($email,$subject) {
                        $message->from('noreply@khcycle.co.th', 'KHcycle');
                        $message->to($email);
                        $message->subject($subject);
                    });
                    Session::flash('alert-success', 'เราได้ส่งข้อมูลไปยังอีเมล์ของท่านแล้ว');
                    return view('member.forgotPassword')->with('name','ForgotPassword');
                }
                else{
                    Session::flash('alert-danger', 'เราได้ส่งข้อมูลไปยังอีเมล์ของท่านแล้ว กรุณาตรวจสอบ');
                    return view('member.forgotPassword')->with('name','ForgotPassword');
                }
            }
            else{
                Session::flash('alert-danger', 'ไม่พบอีเมล์ดังกล่าว กรุณาตรวจสอบ');
                return view('member.forgotPassword')->with('name','ForgotPassword');
            }
        }
    }

    public function postResetPassword(Request $request){
        $token = $request->input('resetToken');
        $foundToken = $this->getTokenForReset($token);
        if(count($foundToken)==1){
            //เงื่อไขที่ใช้ในการ Validator
            $rules=[
                'member_password'=>'required|confirmed|Max:20',
                'member_password_confirmation'=>'required',
            ];
            //Custom ควบคุม Message Error
            $messages = [
                'member_password.required'=>'กรุณาระบุ Password',
                'member_password.confirmed'=>'กรุณาใส่ Password ให้ตรงกัน',
                'member_password_confirmation.required'=>'กรุณาระบุ Confirm Password',
                'member_password.max'=>'ความยาว Password ไม่เกิน 20 ตัวอักษร'
            ];
            $validator =  Validator::make($request->all(),$rules,$messages);

            if($validator->fails()){
                return redirect('resetPassword/'.$token)->withErrors($validator)->withInput();
            }else {
                $member_password = $request->input('member_password');
                $ervpass = $this-> getEncode_member($member_password,strlen($member_password));
                echo $foundToken[0]['EMAIL'];
                $contact = DB::table('KH_CONTACT')->where('KH_CONTACT_EMAIL','=',$foundToken[0]['EMAIL'])->select('KH_CONTACT_MEMBER')->get();
                if(count($contact)){
                    $id = $contact[0]['KH_CONTACT_MEMBER'];
                    DB::table('KH_MEMBER_LOGIN')
                    ->where('ID','=',$id)
                    ->update([
                        'KH_MEMBER_LOGIN_PASSWORD'=>$ervpass]
                    );
                    Session::flash('alert-success', 'เปลี่ยนรหัสผ่านสำเร็จ');
                    return view('member.login')->with('name','Member');
                }
                else{
                    Session::flash('alert-danger', 'เกิดข้อผิดพลาดในการรีเซ็ตรหัสผ่าน กรุณาติดต่อผู้ดูแลระบบ');
                    return view('member.forgotPassword')->with('name','ForgotPassword');
                }
            }
        }
        else{
            Session::flash('alert-danger', 'ไม่พบข้อมูลของรีเซ็ตรหัสผ่านในระบบ ลิงค์ดังกล่าวอาจจะหมดอายุ กรุณากรอกข้อมูลเพื่อรับอีเมล์ใหม่');
            return view('member.forgotPassword')->with('name','ForgotPassword');
        }
    }
}
