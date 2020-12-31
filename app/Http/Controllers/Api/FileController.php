<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Controller;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FileController extends Controller
{
    private $fileSvc;

    /**
     * FileController constructor.
     * @param $fileSvc
     */
    public function __construct(FileService $fileSvc)
    {
        $this->fileSvc = $fileSvc;
    }

    public function index()
    {
        return $this->fileSvc->getAll(true);
    }
}
