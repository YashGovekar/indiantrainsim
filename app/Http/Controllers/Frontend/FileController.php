<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Controller;
use App\Services\FileSectionService;
use App\Services\FileService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Redirect;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    private $fileSectionSvc;
    private $fileSvc;
    private $userSvc;

    /**
     * FileController constructor.
     * @param FileSectionService $fileSectionSvc
     * @param FileService $fileSvc
     * @param UserService $userSvc
     */
    public function __construct(
        FileSectionService $fileSectionSvc,
        FileService $fileSvc,
        UserService $userSvc
    ) {
        $this->fileSectionSvc = $fileSectionSvc;
        $this->fileSvc = $fileSvc;
        $this->userSvc = $userSvc;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $file_sections = $this->fileSectionSvc->getAll();
        return Inertia::render('Frontend/Files/Index', [
            'file_sections' => $file_sections,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $file_sections = $this->fileSectionSvc->getAll();
        return Inertia::render('Frontend/Files/Create', [
            'file_sections' => $file_sections,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */

    public function store(Request $request): RedirectResponse
    {
        $validate = '';
        if (config('app.enable_virus_scan')) {
            $validate = 'clamav';
        }
        $request->validate([
            'file'            => 'required|file|'.$validate,
            'name'            => 'required',
            'description'     => 'required',
            'file_section_id' => 'required',
            'image_file'      => 'required|file|mimes:png,jpg,jpeg,gif|'.$validate,
        ]);
        $message = '';
        if ($request->hasFile('file') && $request->hasFile('image_file')) {

            $image_file = $request->file('image_file');
            $file = $request->file('file');

            $data = $request->all();

            $data['image'] = $this->fileSvc->uploadPublicly($image_file, 'images', $data['name'].'_image');

            $file_info = $this->fileSvc->uploadFile($file, $data['name']);

            if ($this->fileSvc->store($data, $file_info)) {
                $message = 'File Uploaded Successfully! We will let you know when the file is approved!';
            } else {
                $message = 'File Uploaded Failed! Something went wrong.';
            }
        }
        return Redirect::back()->with('message', $message);
    }

    /**
     * @param $id
     * @return StreamedResponse
     */
    public function download($id): StreamedResponse
    {
        return $this->fileSvc->download($id);
    }

    /**
     * Report the specified resource.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function report(int $id): RedirectResponse
    {
        $this->fileSvc->report($id);
        return Redirect::back()->with('message', 'Thanks For Reporting!');
    }

    /**
     * @return Response
     */
    public function hot(): Response
    {
        $files = $this->fileSvc->hotFiles();
        return Inertia::render('Frontend/Files/Hot', [
            'files' => $files,
        ]);
    }

    public function manage(): Response
    {
        $files = $this->userSvc->find(auth()->id())->files->load('user_downloads.user');
        return Inertia::render('Frontend/Files/Manage', [
            'files' => $files,
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $this->fileSvc->destroy($id);
        return Redirect::back()->with('message', 'File Deleted!');
    }
}
