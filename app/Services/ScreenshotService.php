<?php

namespace App\Services;

use App\Contracts\BaseRepository;
use App\Models\Screenshot;
use Illuminate\Support\Collection;

class ScreenshotService extends BaseRepository
{
    public function __construct(Screenshot $model)
    {
        parent::__construct($model);
    }

    public function getJsonApi(): ?Collection
    {
        $screenshots = $this->all();
        foreach ($screenshots as $screenshot) {
            $screenshot->link = $screenshot->path;
        }
        return $screenshots;
    }
}
