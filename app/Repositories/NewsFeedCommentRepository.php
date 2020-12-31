<?php

namespace App\Repositories;

use App\Contracts\BaseRepository;
use App\Models\NewsFeedComment;
use App\Repositories\Interfaces\NewsFeedCommentRepositoryInterface;

class NewsFeedCommentRepository extends BaseRepository implements NewsFeedCommentRepositoryInterface
{
    public function __construct(NewsFeedComment $model)
    {
        parent::__construct($model);
    }
}
