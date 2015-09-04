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
        $sqlBanner = "SELECT BANNER_ID, BANNER_IMAGE, BANNER_IMAGE_EXT, BANNER_URL, BANNER_IS_YOUTUBE, BANNER_YOUTUBE_URI FROM KH_BANNER WHERE BANNER_IS_DELETED <> 1 ORDER BY BANNER_ORDER";
        $sqlBrand = "SELECT BRAND_ID,BRAND_NAME,BRAND_LOGO_NAME FROM KH_BRAND WHERE BRAND_DELETE_STATUS <> 1 ORDER BY BRAND_ORDER";
        $brand = DB::select($sqlBrand);
        $banners = DB::select($sqlBanner);

        return view('home.home', ['brand' => $brand],['banners' => $banners]);
    }
}
