<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        return view('member.login')->with('name', 'Member');
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
            $id = DB::table('KH_MEMBER_LOGIN')->insertGetId(
              [
                  'KH_MEMBER_LOGIN_USERNAME'=>$member_username,
                  'KH_MEMBER_LOGIN_PASSWORD'=>$ervpass,
                  'KH_MEMBER_LOGIN_REAL'=>$member_password]
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
            ->where('KH_memBER_LOGIN_PASSWORD','=',$pass)
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
            ->leftjoin('KH_INFORMATION AS info','login.KH_MEMBER_LOGIN_ID','=','info.KH_INFORMATION_MEMBER')
            ->leftjoin('KH_CONTACT AS contact','login.KH_MEMBER_LOGIN_ID','=','contact.KH_CONTACT_MEMBER')
            ->select(
                'login.KH_MEMBER_LOGIN_ID',
                'login.KH_MEMBER_LOGIN_USERNAME',
                'contact.KH_CONTACT_NAME',
                'contact.KH_CONTACT_EMAIL',
                'contact.KH_CONTACT_TEL',
                'info.KH_INFORMATION_HEIGHT',
                'info.KH_INFORMATION_WEIGHT',
                'info.KH_INFORMATION_SHOE',
                'contact.KH_CONTACT_ADDR')
            ->where('login.KH_MEMBER_LOGIN_ID','=',$id)
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
                $matchlogin = $this->chkmatchlogin($kh_username,$encryp_password);

                if($matchlogin>0)
                {
                    $id = DB::table('KH_MEMBER_LOGIN')->select('KH_MEMBER_LOGIN_ID')->where('KH_MEMBER_LOGIN_USERNAME','=',$kh_username)->first();
                    if($id)
                    {
                        Auth::loginUsingId($id);
                        Session::flash('alert-danger', '1');
                       return redirect('member');
                    }else{
                        Session::flash('alert-danger', '2');
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

    public function listmember(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $data = DB::table('KH_MEMBER_LOGIN AS login ')
                ->leftjoin('KH_INFORMATION AS info','login.KH_MEMBER_LOGIN_ID','=','info.KH_INFORMATION_MEMBER')
                ->leftjoin('KH_CONTACT AS contact','login.KH_MEMBER_LOGIN_ID','=','contact.KH_CONTACT_MEMBER')
                ->select(
                    'login.KH_MEMBER_LOGIN_ID',
                    'login.KH_MEMBER_LOGIN_USERNAME',
                    'contact.KH_CONTACT_NAME',
                    'contact.KH_CONTACT_EMAIL',
                    'contact.KH_CONTACT_TEL',
                    'info.KH_INFORMATION_HEIGHT',
                    'info.KH_INFORMATION_WEIGHT',
                    'info.KH_INFORMATION_SHOE',
                    'contact.KH_CONTACT_ADDR');
            if($request->has('sch_name'))
            {
                $sch_name = $request->input('sch_name');
                $data = $data->where('KH_CONTACT_NAME','like','%'.$sch_name.'%');
            }
            if($request->has('sch_tel'))
            {
                $sch_tel = $request->input('sch_tel');
                $data = $data->where('KH_CONTACT_TEL','like','%'.$sch_tel.'%');
            }
            $data = $data->get();

        }else{

        $data = DB::table('KH_MEMBER_LOGIN AS login ')
            ->leftjoin('KH_INFORMATION AS info','login.KH_MEMBER_LOGIN_ID','=','info.KH_INFORMATION_MEMBER')
            ->leftjoin('KH_CONTACT AS contact','login.KH_MEMBER_LOGIN_ID','=','contact.KH_CONTACT_MEMBER')
            ->select(
                'login.KH_MEMBER_LOGIN_ID',
                'login.KH_MEMBER_LOGIN_USERNAME',
                'contact.KH_CONTACT_NAME',
                'contact.KH_CONTACT_EMAIL',
                'contact.KH_CONTACT_TEL',
                'info.KH_INFORMATION_HEIGHT',
                'info.KH_INFORMATION_WEIGHT',
                'info.KH_INFORMATION_SHOE',
                'contact.KH_CONTACT_ADDR')
            ->get();
        }

        return view('member.listmember')->with('name','Member')->with('data',$data);
    }

}
