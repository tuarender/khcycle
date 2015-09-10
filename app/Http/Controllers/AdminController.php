<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function getContact()
    {
        return view('admin.contact')->with('name','Contact Setting');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
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
