<?php

namespace App\Repositories;

use App\Contracts\BaseRepository;
use App\Models\File;
use App\Repositories\Interfaces\FileRepositoryInterface;

class FileRepository extends BaseRepository implements FileRepositoryInterface
{
    public function __construct(File $model)
    {
        parent::__construct($model);
    }

    public function getAll()
    {
        return File::with('section')->get();
    }
}
