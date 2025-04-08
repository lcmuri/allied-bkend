<?php

namespace Modules\Medicine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

// use Modules\Medicine\Database\Factories\DoseFormFactory;

class DoseForm extends Model
{
    use HasFactory;
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
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
     * The medicines associated with this dose form.
     */
    public function medicines(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class, 'category_medicine')
            ->withPivot(['category_id', 'atc_id', 'status', 'strength', 'description'])
            ->withTimestamps();
    }

    /**
     * The categories associated with this dose form through medicines.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_medicine')
            ->withPivot(['medicine_id', 'atc_id', 'status', 'strength', 'description'])
            ->withTimestamps();
    }

    // protected static function newFactory(): DoseFormFactory
    // {
    //     // return DoseFormFactory::new();
    // }
}
