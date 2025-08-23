<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media; // ✅ CORRECT ONE

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'sale_price',
        'stock',
        'sku',
        'brand_id',
        'is_active',
        'is_featured',
        'meta_data',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'meta_data' => 'array',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(50)
            ->height(50)
            ->sharpen(10);
            
        $this->addMediaConversion('medium')
            ->width(300)
            ->height(300)
            ->sharpen(10);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the primary image URL for datatable display
     */
    public function getImageUrlAttribute(): string
    {
        $media = $this->getFirstMedia('images');
        
        if (!$media) {
            return 'https://via.placeholder.com/50x50?text=No+Image';
        }

        // Try to get the full URL first
        $url = $media->getFullUrl();
      
        
        // If that fails, construct manually
        if (!$url || !filter_var($url, FILTER_VALIDATE_URL)) {
            $url = asset('storage/' . $media->id . '/' . $media->file_name);
        }
        
        return $url;
    }
} 