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

    public function index()
    {
        $sql = "SELECT BRAND_ID,BRAND_ORDER,BRAND_NAME,BRAND_LOGO_NAME FROM KH_BRAND WHERE BRAND_DELETE_STATUS <> 1 ORDER BY BRAND_ORDER";
        $brand = DB::select($sql);

        return view('product.product', ['brand' => $brand]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getProduct($brandId,$groupId=null)
    {
        $group = null;
        //$response = Utils::getDefaultResponse();
        $sql = "SELECT PRODUCT_ID,PRODUCT_NAME,PRODUCT_FILE_NAME FROM KH_PRODUCT WHERE PRODUCT_DELETE_STATUS <> 1 AND PRODUCT_STATUS = 'ACTIVE' AND PRODUCT_BRAND_ID = ? ";
        $queryParam = array($brandId);

        //in case have group id
        if(!is_null($groupId)){
            $sql.= " AND PRODUCT_GROUP_ID = ?";
            array_push($queryParam, $groupId);
        }
        $sql.=" ORDER BY PRODUCT_ORDER";

        $product = DB::select($sql,$queryParam);

/*        if(isset($brand)){
            if(count($brand)>0){
                $response['status'] = "Success";
                $response['msg'] = "Success to retrive product";
                $response['data'] = $brand;
            }
            else{
                $response['status'] = "Not found";
                $response['msg'] = "Can not found any data";
            }
        }*/
        return view('product.productList', ['product' => $product,'group' => $group]);
    }

}
