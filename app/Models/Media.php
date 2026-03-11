<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'mediable_type',
        'mediable_id',
        'collection',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
        'metadata',
        'disk',
        'sort_order',
        'uploaded_by',
    ];

    protected $casts = [
        'metadata' => 'array',
        'file_size' => 'integer',
        'sort_order' => 'integer',
    ];

    // ============================================================
    // Collection Constants
    // ============================================================

    const COLLECTION_PROFILE = 'profile';
    const COLLECTION_LOGO = 'logo';
    const COLLECTION_GALLERY = 'gallery';
    const COLLECTION_SPONSOR = 'sponsor';
    const COLLECTION_DOCUMENT = 'document';

    // ============================================================
    // Relationships
    // ============================================================

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // ============================================================
    // Scopes
    // ============================================================

    public function scopeInCollection($query, string $collection)
    {
        return $query->where('collection', $collection);
    }

    public function scopeImages($query)
    {
        return $query->where('mime_type', 'like', 'image/%');
    }

    public function scopeDocuments($query)
    {
        return $query->where('mime_type', 'application/%');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    // ============================================================
    // Helpers
    // ============================================================

    public function getUrl(): string
    {
        if ($this->disk === 's3') {
            return config('filesystems.disks.s3.url') . '/' . $this->file_path;
        }
        
        return asset('storage/' . $this->file_path);
    }

    public function isImage(): bool
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    public function isDocument(): bool
    {
        return str_starts_with($this->mime_type, 'application/');
    }

    public function getFormattedSize(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getDimensions(): ?array
    {
        if (!$this->isImage() || empty($this->metadata['width'])) {
            return null;
        }
        
        return [
            'width' => $this->metadata['width'],
            'height' => $this->metadata['height'],
        ];
    }
}