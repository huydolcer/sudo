<?php

namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Repositories\UserRepository;
;


class UserService{


    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function regisn(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        $user->sendEmailVerificationNotification();
        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    public function login(Request $request){
        // Kiểm tra thông tin đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Đăng nhập thành công
            return redirect()->route('index');
        }
    
        // Đăng nhập thất bại
        return back()->with('error', 'Tài khoản hoặc mật khẩu không chính xác');
    }
}