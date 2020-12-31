<?php

namespace App\Repositories\Interfaces;

use App\Models\NewsFeed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface NewsFeedRepositoryInterface
{
    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model;

    /**
     * @return Collection
     */
    public function all(): ?Collection;

    public function __construct(NewsFeed $model);
}
