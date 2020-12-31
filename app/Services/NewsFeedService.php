<?php

namespace App\Services;

use App\Models\NewsFeed;
use App\Repositories\NewsFeedRepository;
use Illuminate\Support\Collection;

class NewsFeedService
{
    private $newsFeedRepo;
    private $fileSvc;

    /**
     * NewsFeedService constructor.
     * @param NewsFeedRepository $newsFeedRepo
     * @param FileService $fileSvc
     */
    public function __construct(
        NewsFeedRepository $newsFeedRepo,
        FileService $fileSvc
    ) {
        $this->fileSvc = $fileSvc;
        $this->newsFeedRepo = $newsFeedRepo;
    }

    public function getAll(): ?Collection
    {
        return $this->newsFeedRepo->all()->each(function ($news_feed, $key) {
            $news_feed->load('comments.user');
        });
    }

    public function store(array $data)
    {
        $this->newsFeedRepo->create($data);
        flash('NewsFeed Posted!')->success();
    }

    public function get(int $id): NewsFeed
    {
        return $this->newsFeedRepo->find($id)->load('comments.user');
    }

    public function update($id, array $data, $delete_file)
    {
        $news_feed = $this->get($id);
        if ($delete_file) {
            $this->fileSvc->delete([$news_feed->image]);
        }
        $news_feed->update($data);
        flash('Success!')->success();
    }
}
