<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Controller;
use App\Services\FileService;
use App\Services\NewsFeedService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    private $newsFeedSvc;
    private $fileSvc;

    /**
     * NewsFeedController constructor.
     * @param FileService $fileSvc
     * @param NewsFeedService $newsFeedSvc
     */
    public function __construct(
        FileService $fileSvc,
        NewsFeedService $newsFeedSvc
    )
    {
        $this->fileSvc = $fileSvc;
        $this->newsFeedSvc = $newsFeedSvc;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.news-feeds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('image')) {
            flash('Please Upload Image as well!');
            return redirect()->back();
        }
        $data = $request->except('_token');
        $image_file = $request->file('image');
        $data['image'] = $this->fileSvc->uploadPublicly($image_file, 'news-feeds', $image_file->getClientOriginalName());
        $this->newsFeedSvc->store($data);
        return redirect(route('admin.dashboard'));
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
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $news_feed = $this->newsFeedSvc->get($id);
        return view('admin.news-feeds.edit', [
            'news_feed' => $news_feed,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');
        $delete_file = false;
        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            $data['image'] = $this->fileSvc->uploadPublicly($image_file, 'news-feeds', $image_file->getClientOriginalName());
            $delete_file = true;
        }
        $this->newsFeedSvc->update($id, $data, $delete_file);
        return redirect(route('admin.dashboard'));
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
