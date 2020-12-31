<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{
    private $userRepo;
    private $fileSvc;

    /**
     * UserService constructor.
     * @param UserRepository $userRepo
     * @param FileService $fileSvc
     */
    public function __construct(
        UserRepository $userRepo,
        FileService $fileSvc
    ) {
        $this->fileSvc = $fileSvc;
        $this->userRepo = $userRepo;
    }

    public function all(): Collection
    {
        return $this->userRepo->all();
    }

    public function find($id): User
    {
        return $this->userRepo->find($id);
    }

    public function login($email, $password): bool
    {
        $fieldType = filter_var($email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $data = [
            $fieldType => $email,
            'password' => $password,
        ];
        if (Auth::attempt($data)) {
            return true;
        }
        return false;
    }

    public function store(array $data): bool
    {
        try {
            $password = $data['re_password'];
            if ($password === $data['re_password']) {
                $data['password'] = Hash::make($password);
                unset($data['re_password']);
            }
            $this->userRepo->create($data);
            $this->login($data['email'], $password);
            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function checkIfExists($email): bool
    {
        if (User::where('email', $email)->exists()) {
            return false;
        }
        return true;
    }

    public function logout(): bool
    {
        try {
            Auth::logout();
            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->find($id);
            foreach ($user->files as $file) {
                $this->fileSvc->delete($file->path);
            }
            $user->delete();
            flash('User Deleted Successfully!');
        } catch (Exception $e) {
            flash('Something went wrong!');
        }
    }
}
