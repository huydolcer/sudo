<?php

namespace App\Http\Controllers;
use App\Service\FileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }
    public function index()
    {
        return view('profile');
    }
    public function getFileByUserId($id)
    {
        $files = $this->fileService->getFileById($id);
        return response()->json($files);
    }
}
