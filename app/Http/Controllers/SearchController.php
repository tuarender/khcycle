<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Request;

class SearchController extends Controller
{
    public function search(){
    	$keyword = Input::get('keyword');
        $sql = "SELECT BRAND_ID,BRAND_ORDER,BRAND_NAME,BRAND_LOGO_NAME,BRAND_LOGO_EXT FROM KH_BRAND WHERE BRAND_DELETE_STATUS <> 1 ORDER BY BRAND_ORDER DESC";
        $brand = DB::select($sql);

        return view('product.product', ['brand' => $brand,'keyword'=>$keyword,'name' => "Product"]);
    }

    public function searchProduct($keyword){
        $page = intval(Request::input('page',1));
        if(!is_int($page)){
            $page = 1;
        }
    	$sqlProduct = "SELECT PRODUCT_ID,PRODUCT_NAME,PRODUCT_MIN_FILE_NAME,PRODUCT_MIN_EXT,PRODUCT_FULL_FILE_NAME,PRODUCT_FULL_EXT FROM KH_PRODUCT WHERE PRODUCT_DELETE_STATUS <> 1 AND PRODUCT_STATUS = 'ACTIVE' AND LOWER(PRODUCT_NAME) LIKE ?";
    	$sqlProduct.= " ORDER BY PRODUCT_ORDER DESC,PRODUCT_NAME";
    	$productQueryParam = array("%".strtolower($keyword)."%");
    	$products = DB::select($sqlProduct,$productQueryParam);
    	return view('product.searchProductList', ['products' => $products,'keyword'=>$keyword,'sql'=>$sqlProduct,'page'=>$page]);
    }
}
