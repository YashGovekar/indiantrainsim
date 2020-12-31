<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Controller;
use App\Services\FileSectionService;
use App\Services\FileService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Redirect;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    /**
     * @var FileService
     */
    private $fileSvc;
    private $fileSectionSvc;

    /**
     * FileController constructor.
     * @param FileService $fileSvc
     * @param FileSectionService $fileSectionSvc
     */
    public function __construct(
        FileService $fileSvc,
        FileSectionService $fileSectionSvc
    ) {
        $this->fileSvc = $fileSvc;
        $this->fileSectionSvc = $fileSectionSvc;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $files = $this->fileSvc->getAll();
        return view('admin.files.index', [
            'files' => $files,
        ]);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $file = $this->fileSvc->get($id);
        $file_sections = $this->fileSectionSvc->getAll();
        return view('admin.files.edit', [
            'file'          => $file,
            'file_sections' => $file_sections,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');
        if (!$request->has('approved')) {
            $data['approved'] = false;
        }
        $this->fileSvc->update($id, $data);
        return redirect(route('admin.files.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        if (!$this->fileSvc->destroy($id)) {
            flash('Something went wrong!')->error();
        }
        flash('File Deleted!')->success();
        return Redirect::back();
    }

    /**
     * @param $id
     * @return StreamedResponse
     */
    public function download($id): StreamedResponse
    {
        return $this->fileSvc->download($id);
    }
}
