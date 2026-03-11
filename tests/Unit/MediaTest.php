<?php

namespace Tests\Unit;

use App\Models\Media;
use Tests\TestCase;

class MediaTest extends TestCase
{
    /** @test */
    public function it_has_correct_collection_constants()
    {
        $this->assertEquals('profile', Media::COLLECTION_PROFILE);
        $this->assertEquals('logo', Media::COLLECTION_LOGO);
        $this->assertEquals('gallery', Media::COLLECTION_GALLERY);
        $this->assertEquals('sponsor', Media::COLLECTION_SPONSOR);
        $this->assertEquals('document', Media::COLLECTION_DOCUMENT);
    }

    /** @test */
    public function it_checks_if_image()
    {
        $media = new Media(['mime_type' => 'image/jpeg']);
        $this->assertTrue($media->isImage());

        $media->mime_type = 'image/png';
        $this->assertTrue($media->isImage());

        $media->mime_type = 'application/pdf';
        $this->assertFalse($media->isImage());
    }

    /** @test */
    public function it_checks_if_document()
    {
        $media = new Media(['mime_type' => 'application/pdf']);
        $this->assertTrue($media->isDocument());

        $media->mime_type = 'image/jpeg';
        $this->assertFalse($media->isDocument());
    }

    /** @test */
    public function it_formats_file_size_bytes()
    {
        $media = new Media(['file_size' => 500]);
        $this->assertEquals('500 B', $media->getFormattedSize());
    }

    /** @test */
    public function it_formats_file_size_kilobytes()
    {
        $media = new Media(['file_size' => 2048]);
        $this->assertEquals('2 KB', $media->getFormattedSize());
    }

    /** @test */
    public function it_formats_file_size_megabytes()
    {
        $media = new Media(['file_size' => 5242880]); // ~5MB
        $formatted = $media->getFormattedSize();
        $this->assertStringContainsString('MB', $formatted);
    }

    /** @test */
    public function it_returns_dimensions_for_images()
    {
        $media = new Media([
            'mime_type' => 'image/jpeg',
            'metadata' => ['width' => 1920, 'height' => 1080],
        ]);
        $dims = $media->getDimensions();
        $this->assertNotNull($dims);
        $this->assertEquals(1920, $dims['width']);
        $this->assertEquals(1080, $dims['height']);
    }

    /** @test */
    public function it_returns_null_dimensions_for_non_images()
    {
        $media = new Media(['mime_type' => 'application/pdf']);
        $this->assertNull($media->getDimensions());
    }
}