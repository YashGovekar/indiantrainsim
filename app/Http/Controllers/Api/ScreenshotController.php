<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Controller;
use App\Services\ScreenshotService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ScreenshotController extends Controller
{
    private $screenshotSvc;

    /**
     * ScreenshotController constructor.
     * @param $screenshotSvc
     */
    public function __construct(ScreenshotService $screenshotSvc)
    {
        $this->screenshotSvc = $screenshotSvc;
    }

    public function index(): ?Collection
    {
        return $this->screenshotSvc->getJsonApi();
    }
}
