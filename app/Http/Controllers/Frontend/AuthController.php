<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Controller;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    private $userSvc;

    /**
     * AuthController constructor.
     * @param $userSvc
     */
    public function __construct(UserService $userSvc)
    {
        $this->userSvc = $userSvc;
    }

    public function auth(): Response
    {
        return Inertia::render('Frontend/Auth');
    }

    public function login(Request $request): RedirectResponse
    {
        $email = $request->input('login-form-username');
        $password = $request->input('login-form-password');

        $login = $this->userSvc->login($email, $password);

        if ($login) {
            return Redirect::intended(route('frontend.home'));
        }

        return Redirect::route('frontend.auth.index')->with(['message' => "InCorrect Details"]);
    }

    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required',
            'name'     => 'required',
            'email'    => 'required|email',
            'phone'    => 'required',
        ]);

        $data = $request->all();

        if (!$this->userSvc->checkIfExists($data['email'])) {
            return Redirect::route('frontend.auth.index')->with(['message' => "User Already Exists!"]);
        }

        if ($data['password'] !== $data['re_password']) {
            return Redirect::route('frontend.auth.index')->with(['message' => "Passwords do not match!"]);
        }

        $register = $this->userSvc->store($data);

        if ($register) {
            return Redirect::intended(route('frontend.home'));
        }

        return Redirect::route('frontend.auth.index')->with(['message' => "Something went wrong!"]);
    }

    public function logout(): RedirectResponse
    {
        $this->userSvc->logout();
        return Redirect::route('frontend.home');
    }
}
