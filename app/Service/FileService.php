<?php

namespace App\Service;

use App\Repositories\FileRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class FileService 
{
    protected $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function uploadFiles(array $data)
    {
        if (!isset($data['files']) || empty($data['files'])) {
            throw new Exception('No files were uploaded.');
        }
    
        $uploadedFiles = [];
        $failedFiles = [];
    
        foreach ($data['files'] as $file) {
            try {
                // Bắt đầu một giao dịch mới cho từng file
                DB::beginTransaction();
    
                if ($file->getClientOriginalName() == 'error_test.jpg') {
                    throw new Exception('File name is invalid');
                }
    
                // Gọi phương thức upload và lưu vào database
                $result = $this->fileRepository->uploadFile($file);
                $uploadedFiles[] = $result;
    
                // Commit giao dịch nếu upload thành công
                DB::commit();
            } catch (Exception $e) {
                // Rollback nếu có lỗi với file này
                DB::rollBack();
                error_log('Error uploading file: ' . $file->getClientOriginalName() . ' - ' . $e->getMessage());
                $failedFiles[] = $file->getClientOriginalName();
            }
        }
    
        return [
            'successful_uploads' => $uploadedFiles,
            'failed_uploads' => $failedFiles,
            'message' => 'Upload process completed with ' . count($uploadedFiles) . ' successful uploads and ' . count($failedFiles) . ' failures.'
        ];
    }
    
    

    public function deleteFile($fileName)
    {
        $this->fileRepository->deleteFile($fileName);
    }

    public function deleteFiles($files)
    {
        foreach ($files as $file) {
            $this->fileRepository->deleteFile($file);
        }
    }
    public function getFileById($id)
    {
        return $this->fileRepository->getFileById($id);
    }
}
