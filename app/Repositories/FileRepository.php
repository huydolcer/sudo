<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\File;
use Exception;
use Illuminate\Support\Facades\Cookie;
use Mockery\Undefined;
use Nette\Utils\Random;

use function PHPUnit\Framework\isEmpty;

class FileRepository extends AbstractRepository
{
    protected function getModel()
    {
        return File::class;
    }
    public function uploadFile($files)
    {
        $uploadedFiles = [];
        $uploadPath = public_path('uploads');
    
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
    
        $filesArray = is_array($files) ? $files : [$files];
    
        // Tạo hoặc lấy giá trị cookie_local_temp
        $cookie_local_temp = Cookie::get('cookie_local_temp') ?? Random::generate(10);
        Cookie::queue('cookie_local_temp', $cookie_local_temp, 60 * 24 * 30);
    
        foreach ($filesArray as $file) {
            if ($file->isValid()) {
                $newFileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $newFileName);
    
                if (file_exists($uploadPath . '/' . $newFileName)) {
                    $size = filesize($uploadPath . '/' . $newFileName);
                    
                    $authId = Auth::id();
                    if($authId){
                        $cookie_local_temp = null;
                    }
                    // Sử dụng $cookie_local_temp đã tạo thay vì gọi lại Cookie::get()
                    $data = [
                        'user_id' => $authId,
                        'cookie_local_temp' => $cookie_local_temp,
                        'name' => $file->getClientOriginalName(),
                        'path' => $newFileName,
                        'size' => $size,
                        'type' => $file->getClientMimeType()
                    ];
    
                    // Ghi log thông tin tệp
                    Log::info('Uploading file data:', $data);
    
                    try {
                        $uploadedFiles[] = $this->model->create($data);
                    } catch (\Exception $e) {
                        dd($e);
                        throw new Exception('Không thể lưu tệp vào cơ sở dữ liệu: ' . $e->getMessage());
                    }
                } else {
                    throw new Exception('Tệp không tồn tại sau khi upload.');
                }
            } else {
                throw new Exception('Tệp không hợp lệ: ' . $file->getClientOriginalName());
            }
        }
    
        return $uploadedFiles;
    }
    

    public function deleteFile($fileName)
    {
        $file_path = public_path('uploads') . '/' . $fileName;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    public function updateFile($file, $fileName)
    {
        $this->deleteFile($fileName);
        return $this->uploadFile($file);
    }

    public function allFiles()
    {
        return $this->model->all();
    }
    public function getFileById($id)
    {
        $cookie_value = Cookie::get('cookie_local_temp');

        $temp = $id;
        Log::info('temp:', ['temp' => $temp]);

        if($temp == "null"){
            Log::info("Da vao day");
            return $this->model->where('cookie_local_temp' , $cookie_value)->get();
        }
        Log::info('Cookie value:', ['cookie_local_temp' => $cookie_value]);
        Log::info('User ID:', ['id' => $id]);
        return $this->model->where('user_id', $id)->get();
    }
}

