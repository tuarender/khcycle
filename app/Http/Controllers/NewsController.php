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
        $sql = "SELECT NEWS_ID,NEWS_TITLE,NEWS_IMAGE_TITLE_NAME,NEWS_IMAGE_TITLE_EXT,NEWS_SAMPLE,NEWS_IS_YOUTUBE,NEWS_YOUTUBE_URI FROM KH_NEWS WHERE NEWS_DELETE_STATUS <> 1 AND NEWS_ACTIVE_STATUS <> 0 ORDER BY NEWS_ORDER DESC,NEWS_CREATE_DATE";

        $news = DB::select($sql);

        return view('news.newsList', ['newsList' => $news],['name' => 'News/Articles']);
    }

    public function getNewsListHome()
    {
        $sql = "SELECT NEWS_ID,NEWS_TITLE,NEWS_IMAGE_TITLE_NAME,NEWS_IMAGE_TITLE_EXT,NEWS_SAMPLE,NEWS_IS_YOUTUBE,NEWS_YOUTUBE_URI FROM KH_NEWS WHERE NEWS_DELETE_STATUS <> 1 AND NEWS_ACTIVE_STATUS <> 0 ORDER BY NEWS_ORDER DESC,NEWS_CREATE_DATE LIMIT 0 , 6";

        $news = DB::select($sql);

        return view('home.newsList', ['newsList' => $news]);
    }

    public function getNews($newsId)
    {
        $sql = "SELECT NEWS_ID,NEWS_TITLE,NEWS_IMAGE_TITLE_NAME,NEWS_IMAGE_TITLE_EXT,NEWS_CONTENT,NEWS_CREATE_DATE,NEWS_IS_YOUTUBE,NEWS_YOUTUBE_URI FROM KH_NEWS WHERE NEWS_CREATE_DATE <> 1 AND NEWS_ACTIVE_STATUS <> 0 AND NEWS_ID = ?";
        $queryParam = array($newsId);

        $news = DB::select($sql,$queryParam);

        return view('news.news', ['news' => $news],['name' => 'News/Articles']);
    }

}


