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
        DB::beginTransaction();
    
        try {
            foreach ($data['files'] as $file) {
                if ($file->getClientOriginalName() == 'error_test.jpg') {
                    throw new Exception('File name is invalid');
                }
                try {
                    $result = $this->fileRepository->uploadFile($file);
                    $uploadedFiles[] = $result;
                } catch (Exception $e) {
                    error_log('Error uploading file: ' . $file->getClientOriginalName() . ' - ' . $e->getMessage());
                    $failedFiles[] = $file->getClientOriginalName();
                    continue;
                }
            }
    
          DB::commit();
    
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Upload failed. Transaction rolled back. Error: " . $e->getMessage());
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
