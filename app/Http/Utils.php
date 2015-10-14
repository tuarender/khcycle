<?php
namespace App\Http;
class Utils 
{
	public static function getDefaultResponse(){
		$response = array(
	        'status' => 'error',
	        'msg' => 'An error occored.'
	    );
		return $response;
	}

	public static function getTemplateList(){
		$templateList = array(
	        "product",
	        "productGroup"
	    );
	    return $templateList;
	}

	public static function setActive($route){
        return (\Request::is($route.'/*') || \Request::is($route) ||(\Request::is('/')&&$route=="home")) ? "active" : '';
    }
}

?>