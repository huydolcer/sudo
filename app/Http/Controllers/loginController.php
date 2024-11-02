<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite; // Đảm bảo đã import Socialite
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Log; 
use App\Service\UserService;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('login'); // Trả về view login
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect(); // Chuyển hướng tới Google
    }

    public function handleGoogleCallback()
    {
    
        try {
            // Lấy thông tin người dùng từ Google bằng cách sử dụng Guzzle client
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            // Xử lý lỗi nếu không thể lấy thông tin người dùng
            return redirect()->route('login')->with('error', 'Đăng nhập bằng Google không thành công: ' . $e->getMessage());
        }
    
        // Tìm kiếm hoặc tạo mới người dùng
        $user = User::where('email', $googleUser->getEmail())->first();
    
        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(bin2hex(random_bytes(8))), // Tạo mật khẩu ngẫu nhiên
            ]);
        }
    
        // Đăng nhập người dùng
        Auth::login($user, true);
        $cookie = Cookie::make('user_id', $user->id, 60*24*7); // Tạo cookie lưu user_id trong 7 ngày
        Log::info('User logged in with Google. User ID: ' . $user->id);
        Log::info('Cookie created: user_id=' . $user->id);
        
        // Chuyển hướng về trang chủ
        return redirect()->to('/')->withCookie($cookie);
    }

    public function login(Request $request)
    {
        return $this->userService->login($request);
    }
    


    public function logout()
    {
        Auth::logout(); // Đăng xuất người dùng
        return redirect()->route('index'); // Chuyển hướng về trang đăng nhập
    }

    
}
