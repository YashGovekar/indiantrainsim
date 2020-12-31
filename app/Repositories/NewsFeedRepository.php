<?php

namespace App\Repositories;

use App\Contracts\BaseRepository;
use App\Models\NewsFeed;
use App\Repositories\Interfaces\NewsFeedRepositoryInterface;

class NewsFeedRepository extends BaseRepository implements NewsFeedRepositoryInterface
{
    public function __construct(NewsFeed $model)
    {
        parent::__construct($model);
    }
}
