<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\FileService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Exception;

class FileUploadController extends Controller
{
    use ValidatesRequests;
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
{
    $this->validate($request, [
        'files' => 'required',
        'files.*' => 'file|max:5000'
    ]);

    try {
        $result = $this->fileService->uploadFiles($request->all());
        return response()->json([
            'success' => true,
            'message' => $result['message'],
            'successful_uploads' => $result['successful_uploads'],
            'failed_uploads' => $result['failed_uploads']
        ]);

    } catch (Exception $e) {
        return response()->json(['error' => 'File upload failed: ' . $e->getMessage()]);
    }
}


    public function destroy($fileName)
    {
        $this->fileService->deleteFile($fileName);
        return back()->with('success', 'File deleted successfully');
    }
}
