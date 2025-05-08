<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Medicine\Models\DoseForm;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

// use Modules\Product\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'brand_id',
        'category_id',
        'dose_form_id',
        'name',
        'slug',
        'pack_size',
        'item_code',
        'description',
        'status',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function doseForm(): BelongsTo
    {
        return $this->belongsTo(DoseForm::class);
    }

    // protected static function newFactory(): ProductFactory
    // {
    //     // return ProductFactory::new();
    // }
}
