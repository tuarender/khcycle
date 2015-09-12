<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App;

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

    public function getPage($page){

        if($page=='contact'){
            $data = DB::table('KH_CONTACTUS')->get();
        }
        else{
            return "Page not found";
        }
        
        return view('admin.'.$page,['name'=>'Contact Setting','data'=>$data]);
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

    public function listmember(Request $request)
    {
        if(Session::has('user'))
        {
            $rule = Session::get('user')->KH_MEMBER_RULE;
            if(($rule) == 'ADMIN')
            {
                if ($request->isMethod('post'))
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
                        ->where('login.KH_MEMBER_RULE','<>','ADMIN');
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
                return view('admin.listmember')->with('name','Member Setting')->with('data',$data);
            } else{
                Session::flash('alert-warning', 'PERMISSION DENIED');
                return redirect('member');
            }
        }else{
            Session::flash('alert-warning', 'กรุณาLoginก่อน');
            return redirect('member');
        }
    }
}
