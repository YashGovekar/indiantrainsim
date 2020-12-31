<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Controller;
use App\Services\FileSectionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FileSectionController extends Controller
{
    private $fileSectionSvc;

    /**
     * FileSectionController constructor.
     * @param $fileSectionSvc
     */
    public function __construct(FileSectionService $fileSectionSvc)
    {
        $this->fileSectionSvc = $fileSectionSvc;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $file_sections = $this->fileSectionSvc->getAll();
        return view('admin.file-sections.index', [
            'file_sections' => $file_sections,
        ]);
    }

    public function files($id)
    {
        $file_section = $this->fileSectionSvc->get($id);
        $files = $file_section->files;
        return view('admin.file-sections.files', [
            'files'        => $files,
            'file_section' => $file_section,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.file-sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $store = $this->fileSectionSvc->store($request->except('_token'));
        if ($store) {
            return redirect(route('admin.file-sections.index'));
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
