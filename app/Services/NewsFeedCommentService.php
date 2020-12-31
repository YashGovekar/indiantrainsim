<?php

namespace App\Services;

use App\Repositories\NewsFeedCommentRepository;
use Auth;

class NewsFeedCommentService
{
    private $newsFeedCommentRepo;

    /**
     * NewsFeedCommentService constructor.
     * @param $newsFeedCommentRepo
     */
    public function __construct(NewsFeedCommentRepository $newsFeedCommentRepo)
    {
        $this->newsFeedCommentRepo = $newsFeedCommentRepo;
    }

    public function store(array $all)
    {
        $all['user_id'] = Auth::id();
        $this->newsFeedCommentRepo->create($all);
    }
}
