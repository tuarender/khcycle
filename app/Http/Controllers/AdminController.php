<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function getSetting($pageSetting=null)
    {
        $data = DB::table('KH_CONTACTUS')->get();
        return view('admin.admin',['page'=>$pageSetting]);
    }

    public function getPage($page,Request $request)
    {

        if ($page == 'contact') {
            $data = DB::table('KH_CONTACTUS')->get();
            $menu = "Contact Setting";
        } else if ($page == 'catalogue') {
            $data=  DB::table('KH_CATALOGUE')->get();
            $menu="CATALOGUE SETTING";
        } else if($page=='member') {
            $data =  $this->listmember($request);
            $menu = "ADMIN SETTING";
        } else if($page=='zone'){

        }
        else{
            return "Page not found";
        }
        
        return view('admin.'.$page,['name'=>$menu,'data'=>$data]);
    }

    public function postContact(Request $request)
    {
        $contact = $request->input('contact_name');

        DB::table('KH_CONTACTUS')->update([
            'KH_CONTACTUS'=>$contact,
        ]);

        Session::flash('alert-success', 'อัพเดตเรียบร้อยแล้ว');
        return redirect('admin/contact');
    }

    public function listmember($request)
    {

        if ($request->isMethod('post'))
        {
            $data = 2;
        }
        else{
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
                    'contact.KH_CONTACT_ADDR')
                ->where('login.KH_MEMBER_RULE','<>','ADMIN')
                ->get();
        }

        return $data;
//        if(Session::has('user'))
//        {
//            $rule = Session::get('user')->KH_MEMBER_RULE;
//            if(($rule) == 'ADMIN')
//            {
//                if ($request->isMethod('post'))
//                {
//                    $data = DB::table('KH_MEMBER_LOGIN AS login ')
//                        ->leftjoin('KH_INFORMATION AS info','login.ID','=','info.KH_INFORMATION_MEMBER')
//                        ->leftjoin('KH_CONTACT AS contact','login.ID','=','contact.KH_CONTACT_MEMBER')
//                        ->select(
//                            'login.ID',
//                            'login.KH_MEMBER_LOGIN_USERNAME',
//                            'contact.KH_CONTACT_NAME',
//                            'contact.KH_CONTACT_EMAIL',
//                            'contact.KH_CONTACT_TEL',
//                            'info.KH_INFORMATION_HEIGHT',
//                            'info.KH_INFORMATION_WEIGHT',
//                            'info.KH_INFORMATION_SHOE',
//                            'contact.KH_CONTACT_ADDR')
//                        ->where('login.KH_MEMBER_RULE','<>','ADMIN');
//                    if($request->has('sch_name'))
//                    {
//                        $sch_name = $request->input('sch_name');
//                        $data = $data->where('KH_CONTACT_NAME','like','%'.$sch_name.'%');
//                    }
//                    if($request->has('sch_tel'))
//                    {
//                        $sch_tel = $request->input('sch_tel');
//                        $data = $data->where('KH_CONTACT_TEL','like','%'.$sch_tel.'%');
//                    }
//                    $data = $data->get();
//
//                }else{
//
//                    $data = DB::table('KH_MEMBER_LOGIN AS login ')
//                        ->leftjoin('KH_INFORMATION AS info','login.ID','=','info.KH_INFORMATION_MEMBER')
//                        ->leftjoin('KH_CONTACT AS contact','login.ID','=','contact.KH_CONTACT_MEMBER')
//                        ->select(
//                            'login.ID',
//                            'login.KH_MEMBER_LOGIN_USERNAME',
//                            'contact.KH_CONTACT_NAME',
//                            'contact.KH_CONTACT_EMAIL',
//                            'contact.KH_CONTACT_TEL',
//                            'info.KH_INFORMATION_HEIGHT',
//                            'info.KH_INFORMATION_WEIGHT',
//                            'info.KH_INFORMATION_SHOE',
//                            'contact.KH_CONTACT_ADDR')
//                        ->where('login.KH_MEMBER_RULE','<>','ADMIN')
//                        ->get();
//                }
//                $menu = "MEMBER SETTING";
//                return view('admin.'.$page,['name'=>$menu,'data'=>$data]);
//                //return view('admin.listmember')->with('name','Member Setting')->with('data',$data);
//            } else{
//                Session::flash('alert-warning', 'PERMISSION DENIED');
//                return redirect('member');
//            }
//        }else{
//            Session::flash('alert-warning', 'กรุณาLoginก่อน');
//            return redirect('member');
//        }
    }

    public function memberEdit($id)
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
                'contact.KH_CONTACT_ADDR')
            ->where('login.ID','=',$id)
            ->get();
        return view('admin/memberdetail')->with('data',$data)
            ->with('name','Member Setting->แก้ไขข้อมูลสมาชิก');
    }

    public function updatemember(Request $request,$id)
    {
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
            return redirect('admin/member')->withErrors($validator)->withInput();
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
            return redirect('admin/member');
        }
    }

    public function zoneIndex()
    {
        $name= 'ZONE MANAGE';
        $data = DB::table('KH_ZONE')
            ->select(
                'ID',
                'ZONE_NAME')
            ->where('ZONE_DELETE_STATUS','<>','1')
            ->get();
        return view('admin/zone',['name'=>$name,'data'=>$data]);
    }

    public function zoneCreate(Request $request)
    {
        if($request->isMethod('post'))
        {
            $zone_name = $request->input('zone_name');
            DB::table('KH_ZONE')->insert([
                'ZONE_NAME'=>$zone_name
            ]);

            $name= 'ZONE MANAGE';
            $data = DB::table('KH_ZONE')
                ->select(
                    'ID',
                    'ZONE_NAME')
                ->where('ZONE_DELETE_STATUS','<>','1')
                ->get();
            return redirect('admin/zone')->with(['name'=>$name,'data'=>$data]);
        }
        $name = 'Zone Add';
        return view('admin/zoneEdit',[
            'name'=>$name]);
    }

    public function zoneEdit($id)
    {

    }

    public function branchIndex()
    {

    }

    public function catalogueEdit($id)
    {

    }

    public function catalogueAdd(Request $request)
    {

    }

}
