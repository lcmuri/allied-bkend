<?php

namespace Modules\Medicine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    // Generate URL for the category
    public function getUrlAttribute()
    {
        return route('categories.show', $this->slug);
    }

    // Count of all descendants
    public function getDescendantsCountAttribute()
    {
        return $this->descendants()->count();
    }

    // Count of direct children
    public function getChildrenCountAttribute()
    {
        return $this->children()->count();
    }

    // protected static function newFactory(): CategoryFactory
    // {
    //     // return CategoryFactory::new();
    // }
}
