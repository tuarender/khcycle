<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $sqlCatalouge = "SELECT CATALOGUE_ID,CATALOGUE_NAME,CATALOGUE_COVER_PIC,CATALOGUE_PATH_PDF FROM KH_CATALOGUE WHERE CATALOGUE_DELETE_STATUS <> 1 ORDER BY CATALOGUE_ORDER,CATALOGUE_CREATE_DATE_TIME DESC LIMIT 0 , 1";
        $sqlBanner = "SELECT BANNER_ID, BANNER_IMAGE, BANNER_IMAGE_EXT, BANNER_URL, BANNER_IS_YOUTUBE, BANNER_YOUTUBE_URI FROM KH_BANNER WHERE BANNER_IS_DELETED <> 1 ORDER BY BANNER_ORDER DESC";
        $sqlBrand = "SELECT BRAND_ID,BRAND_NAME,BRAND_LOGO_NAME FROM KH_BRAND WHERE BRAND_DELETE_STATUS <> 1 ORDER BY BRAND_ORDER DESC";
        $catalogue = DB::select($sqlCatalouge);
        $brand = DB::select($sqlBrand);
        $banners = DB::select($sqlBanner);
        $contact = DB::table('KH_CONTACTUS')->get();

        return view('home.home', ['brand' => $brand,'catalogue' => $catalogue,'banners' => $banners ,'contact'=>$contact ]);
    }
}
