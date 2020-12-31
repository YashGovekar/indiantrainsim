<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Controller;
use App\Services\NewsFeedService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $newsFeedSvc;

    /**
     * DashboardController constructor.
     * @param $newsFeedSvc
     */
    public function __construct(NewsFeedService $newsFeedSvc)
    {
        $this->newsFeedSvc = $newsFeedSvc;
    }

    public function index()
    {
        $news_feeds = $this->newsFeedSvc->getAll();
        return view('admin.dashboard.index', [
            'news_feeds' => $news_feeds,
        ]);
    }
}
