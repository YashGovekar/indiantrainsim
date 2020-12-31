<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Controller;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    private $userSvc;

    /**
     * UserController constructor.
     * @param UserService $userSvc
     */
    public function __construct(UserService $userSvc)
    {
        $this->userSvc = $userSvc;
    }

    public function index()
    {
        $users = $this->userSvc->all();
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        $user = $this->userSvc->find($id);
        return view('admin.users.show', [
            'user' => $user,
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $this->userSvc->destroy($id);
        return redirect()->back();
    }
}
