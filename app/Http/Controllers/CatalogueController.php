<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $catalogue = \DB::select('select * from KH_CATALOGUE');
        return view('catalogue.catalogue',[
            'catalogue'=> $catalogue,
            'name'=>'Catalogue',
            'admin'=>'admin/catalogue']);
    }

}
