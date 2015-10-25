<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Utils;

use DB;

class ProductController extends Controller
{

    public function index($brandId=null){
        $sql = "SELECT BRAND_ID,BRAND_ORDER,BRAND_NAME,BRAND_LOGO_NAME,BRAND_LOGO_EXT FROM KH_BRAND WHERE BRAND_DELETE_STATUS <> 1 ORDER BY BRAND_ORDER DESC";
        $brand = DB::select($sql);

        return view('product.product', ['brand' => $brand,'brandId' => $brandId,'name' => "Product"]);
    }

    public function getProduct($brandId,$groupId=null){
        $groups = null;
        $products = null;
        //SQL
        $sqlBrand = "SELECT BRAND_NAME FROM KH_BRAND WHERE BRAND_ID = ?";
        $sqlGroup = "SELECT GROUP_ID,GROUP_NAME FROM KH_GROUP WHERE GROUP_DELETE_STATUS = 0 AND GROUP_ID IN (SELECT GROUP_ID FROM KH_BRAND_GROUP WHERE BRAND_ID = ?)";
        $sqlProduct = "SELECT PRODUCT_ID,PRODUCT_NAME,PRODUCT_MIN_FILE_NAME,PRODUCT_MIN_EXT,PRODUCT_FULL_FILE_NAME,PRODUCT_FULL_EXT FROM KH_PRODUCT WHERE PRODUCT_DELETE_STATUS <> 1 AND PRODUCT_STATUS = 'ACTIVE' AND PRODUCT_BRAND_ID = ? ";

        //query parameter
        $queryParam = array($brandId);
        $productQueryParam  = array($brandId);

        //if have group id then add to query parameter
        if(!is_null($groupId)){
            $sqlProduct.= " AND PRODUCT_GROUP_ID = ?";
            array_push($productQueryParam, $groupId);
        }

        //Order
        $sqlGroup.=" ORDER BY GROUP_NAME";
        $sqlProduct.=" ORDER BY PRODUCT_ORDER DESC,PRODUCT_NAME";

        //execute
        $brand = DB::select($sqlBrand,$queryParam);
        $groups = DB::select($sqlGroup,$queryParam);
        $products = DB::select($sqlProduct,$productQueryParam);
        
        $brandName="";
        if(count($brand)>0){
            $brandName = $brand[0]['BRAND_NAME'];
        }

        return view('product.productList', ['products' => $products,'groups' => $groups,'brandId' => $brandId,'groupId' => $groupId,'name'=>$brandName]);
    }

}
