<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Spatie\Image\Enums\AlignPosition;
use Spatie\Image\Enums\CropPosition;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Enums\Unit;
use Spatie\Image\Image;

class ResizeImage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    private $w, $h, $fileName, $path;
    public function __construct($filePath, $w, $h)
    {
        $this->path = dirname($filePath);
        $this->fileName = basename($filePath);
        $this->w = $w;
        $this->h = $h;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $w = $this->w;
        $h = $this->h;
        $srcPath = storage_path() . '/app/public/' . $this->path . '/' . $this->fileName;
        $destPath = storage_path() . '/app/public/' . $this->path . "/crop_{$w}x{$h}_" . $this->fileName;

        Image::load($srcPath)
            ->fit(Fit::Fill, $w, $h)
            ->watermark(
                base_path('resources/img/watermark.png'),
                AlignPosition::Center,
	        width:100,widthUnit:Unit::Percent,
	        height:50,heightUnit:Unit::Percent,
	        fit: Fit::Stretch,
            alpha: 50
            )
            ->save($destPath);
    }
}
