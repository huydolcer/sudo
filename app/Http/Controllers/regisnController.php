<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\UserService;
class regisnController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function regisn_new()
    {
        return view('regisn');
    }
    public function register(Request $request)
    {
        return $this->userService->regisn($request);
    }
}
