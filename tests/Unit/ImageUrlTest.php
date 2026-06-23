<?php

namespace Tests\Unit;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageUrlTest extends TestCase
{
    public function test_get_url_falls_back_to_original_when_crop_missing(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('articles/1/foo.jpg', 'x');

        $url = Image::getUrlByFilePath('articles/1/foo.jpg', 300, 300);

        $this->assertStringContainsString('articles/1/foo.jpg', $url);
        $this->assertStringNotContainsString('crop_300x300_foo.jpg', $url);
    }

    public function test_get_url_uses_crop_when_present(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('articles/1/foo.jpg', 'x');
        Storage::disk('public')->put('articles/1/crop_300x300_foo.jpg', 'x');

        $url = Image::getUrlByFilePath('articles/1/foo.jpg', 300, 300);

        $this->assertStringContainsString('articles/1/crop_300x300_foo.jpg', $url);
    }
}

