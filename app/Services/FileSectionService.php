<?php

namespace App\Services;

use App\Repositories\FileSectionRepository;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class FileSectionService
{
    private $fileSectionRepo;

    /**
     * FileSectionService constructor.
     * @param $fileSectionRepo
     */
    public function __construct(FileSectionRepository $fileSectionRepo)
    {
        $this->fileSectionRepo = $fileSectionRepo;
    }

    public function getAll(): Collection
    {
        return $this->fileSectionRepo->all();
    }

    public function store(array $data): bool
    {
        try {
            $this->fileSectionRepo->create($data);
            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function get($id)
    {
        return $this->fileSectionRepo->find($id);
    }
}
