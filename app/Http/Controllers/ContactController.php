<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $data = DB::table('KH_CONTACTUS')->get();

        $zone = DB::table('KH_ZONE as zone')
            ->join('KH_BRANCH as br','zone.ID','=','br.BRANCH_ZONE')
            ->where('br.BRANCH_DELETE_STATUS','<>','1')
            ->distinct()
            ->select('zone.ZONE_NAME')
            ->get();


        $zonesub = DB::table('KH_BRANCH as br')
            ->join('KH_ZONE AS zone', 'br.BRANCH_ZONE', '=', 'zone.ID')
            ->select('zone.ZONE_NAME',
                'br.BRANCH_ZONE',
                'br.BRANCH_ID',
                'br.BRANCH_SHOP',
                'br.BRANCH_ADDR',
                'br.BRANCH_EMAIL',
                'br.BRANCH_BRAND_01',
                'br.BRANCH_BRAND_02',
                'br.BRANCH_BRAND_03',
                'br.BRANCH_BRAND_04',
                'br.BRANCH_BRAND_05',
                'br.BRANCH_BRAND_06',
                'br.BRANCH_BRAND_07',
                'br.BRANCH_BRAND_08',
                'br.BRANCH_BRAND_09',
                'br.BRANCH_BRAND_10'
                )
            ->where('BRANCH_DELETE_STATUS', '<>', '1')
            ->get();

        return View::make('contact.contact')->with('name','Contact')
            ->with('admin','admin/contact')
            ->with('data',$data)
            ->with('zone',$zone)
            ->with('zonesub',$zonesub);
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
}
