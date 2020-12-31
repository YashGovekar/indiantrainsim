<?php

namespace App\Providers;

use App\Contracts\BaseRepository;
use App\Contracts\BaseRepositoryInterface;
use App\Repositories\FileRepository;
use App\Repositories\FileSectionRepository;
use App\Repositories\Interfaces\FileRepositoryInterface;
use App\Repositories\Interfaces\FileSectionRepositoryInterface;
use App\Repositories\Interfaces\NewsFeedRepositoryInterface;
use App\Repositories\NewsFeedRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(FileSectionRepositoryInterface::class, FileSectionRepository::class);
        $this->app->bind(FileRepositoryInterface::class, FileRepository::class);
        $this->app->bind(NewsFeedRepositoryInterface::class, NewsFeedRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
