<?php

namespace App\Repositories;

use App\Contracts\BaseRepository;
use App\Models\FileSection;
use App\Repositories\Interfaces\FileSectionRepositoryInterface;
use Illuminate\Support\Collection;

class FileSectionRepository extends BaseRepository implements FileSectionRepositoryInterface
{
    public function __construct(FileSection $model)
    {
        parent::__construct($model);
    }
}
