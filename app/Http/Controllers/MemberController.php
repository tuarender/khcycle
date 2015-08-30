<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

        return view('member.member')->with('name', 'Member');
    }

    public function forgetpassword()
    {
        return view('member.forgetpassword')->with('name','ForgetPassword');
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
            'member_password'=>'required|confirmed',
            'member_password_confirmation'=>'required',
            'member_email'=>'required|confirmed',
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
            'member_email.confirmed'=>'กรุณาใส่Emailให้ตรงกัน',
            'member_email_confirmation.required'=>'กรุณาระบุ Email',
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
            $ervpass =$this-> getEncode_member($member_password,strlen($member_password));

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
            $id = DB::table('kh_member_login')->insertGetId(
              [
                  'KH_MEMBER_LOGIN_USERNAME'=>$member_username,
                  'KH_MEMBER_LOGIN_PASSWORD'=>$ervpass,
                  'KH_MEMBER_LOGIN_REAL'=>$member_password]
            );

            //insert contact
            DB::table('kh_contact')->insert([
                'KH_CONTACT_MEMBER'=>$id,
                'KH_CONTACT_EMAIL' =>$member_email,
                'KH_CONTACT_NAME'=>$member_name,
                "KH_CONTACT_TEL"=>$member_tel,
                'KH_CONTACT_ADDR'=>$member_addr
            ]);

            //insert information
            DB::table('kh_information')->insert([
               'KH_INFORMATION_MEMBER' =>$id,
                'KH_INFORMATION_HEIGHT'=>$member_height,
                'KH_INFORMATION_WEIGHT'=>$member_weight,
                'KH_INFORMATION_SHOE'=>$member_shoe
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
        $query = DB::table('kh_member_login')
            ->where('KH_MEMBER_LOGIN_USERNAME','=',$user)
            ->count();
        return $query;
    }

    private function checkemail($email)
    {
        $query = DB::table('kh_contact')
            ->where('KH_CONTACT_EMAIL','=',$email)
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

}
