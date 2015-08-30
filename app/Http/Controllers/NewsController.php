<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Utils;

use DB;

class NewsController extends Controller
{

    public function getNewsList()
    {
        $sql = "SELECT NEWS_ID,NEWS_TITLE,NEWS_IMAGE_TITLE_NAME,NEWS_IMAGE_TITLE_EXT,SUBSTR(NEWS_CONTENT,1,200) AS NEWS_CONTENT_SUB FROM KH_NEWS WHERE NEWS_DELETE_STATUS <> 1 AND NEWS_ACTIVE_STATUS <> 0 ORDER BY NEWS_ORDER,NEWS_CREATE_DATE";

        $news = DB::select($sql);

        return view('news.newsList', ['newsList' => $news]);
    }

    public function getNews($newsId)
    {
        $sql = "SELECT NEWS_ID,NEWS_TITLE,NEWS_IMAGE_TITLE_NAME,NEWS_IMAGE_TITLE_EXT,NEWS_CONTENT,NEWS_CREATE_DATE FROM KH_NEWS WHERE NEWS_CREATE_DATE <> 1 AND NEWS_ACTIVE_STATUS <> 0 AND NEWS_ID = ?";
        $queryParam = array($newsId);

        $news = DB::select($sql,$queryParam);

        return view('news.news', ['news' => $news]);
    }

}


