<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Controller;
use App\Services\FileService;
use App\Services\NewsFeedCommentService;
use App\Services\NewsFeedService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    private $newsFeedSvc;
    private $userSvc;
    private $fileSvc;
    private $newsFeedCommentSvc;

    /**
     * HomeController constructor.
     * @param FileService $fileSvc
     * @param NewsFeedService $newsFeedSvc
     * @param NewsFeedCommentService $newsFeedCommentSvc
     * @param UserService $userSvc
     */
    public function __construct(
        FileService $fileSvc,
        NewsFeedService $newsFeedSvc,
        NewsFeedCommentService $newsFeedCommentSvc,
        UserService $userSvc
    ) {
        $this->userSvc = $userSvc;
        $this->fileSvc = $fileSvc;
        $this->newsFeedSvc = $newsFeedSvc;
        $this->newsFeedCommentSvc = $newsFeedCommentSvc;
    }

    public function index(): Response
    {
        $news_feeds = $this->newsFeedSvc->getAll();
        $users = $this->userSvc->all()->count();
        $downloads = $this->fileSvc->getTotalDownloads();
        return Inertia::render('Frontend/Home', [
            'downloads'  => $downloads,
            'news_feeds' => $news_feeds,
            'users'      => $users,
        ]);
    }

    public function show_newsfeed($id): Response
    {
        $news_feed = $this->newsFeedSvc->get($id);
        return Inertia::render('Frontend/ShowNews', [
            'news_feed' => $news_feed,
        ]);
    }

    public function store_comment(Request $request): RedirectResponse
    {
        $this->newsFeedCommentSvc->store($request->all());
        return redirect()->back();
    }

    public function profile()
    {
        return Inertia::render('Frontend/Profile');
    }
}
