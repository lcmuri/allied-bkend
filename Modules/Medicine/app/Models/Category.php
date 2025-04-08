<?php

namespace Modules\Medicine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

// use Modules\Medicine\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;
    use HasSlug;
    use HasRecursiveRelationships;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'status'
    ];

    // TODO: ADD STATUS CAST

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
     * The medicines that belong to the category.
     */
    public function medicines(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class, 'category_medicine')
            ->withPivot(['category_id', 'atc_id', 'status', 'strength', 'description'])
            ->withTimestamps();
    }

    /**
     * The dose forms associated with this category through medicines.
     */
    public function doseForms(): BelongsToMany
    {
        return $this->belongsToMany(DoseForm::class, 'category_medicine')
            ->withPivot(['medicine_id', 'atc_id', 'status', 'strength', 'description'])
            ->withTimestamps();
    }
    // ... existing 

    // protected static function newFactory(): CategoryFactory
    // {
    //     // return CategoryFactory::new();
    // }
}
