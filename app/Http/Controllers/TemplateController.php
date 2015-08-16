<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\Factory;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Utils;

class TemplateController extends Controller
{


    public function getTemplate($template)
    {
        if(isset($template)){
            if(in_array($template, Utils::getTemplateList())){
                $template.="_template";
                $view = view('template.'.$template);
            }
        }

        return $view;
    }
}
