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
}

?>