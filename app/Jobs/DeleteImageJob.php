<?php

namespace App\Jobs;


use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;

class DeleteImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function handle()
    {

        $filePath = public_path($this->image->path);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        $this->image->delete();
    }
}