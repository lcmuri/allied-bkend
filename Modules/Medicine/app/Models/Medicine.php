<?php

namespace Modules\Medicine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Medicine\Enums\ActiveStatus;
use Modules\Medicine\Exceptions\InvalidStatusTransition;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

// use Modules\Medicine\Database\Factories\MedicineFactory;

class Medicine extends Model
{
    use HasFactory;
    use HasSlug;

    // TODO: Add bulk status update functionality?

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'generic_name',
        'description',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => ActiveStatus::class,
    ];

    /**
     * The allowed status transitions.
     *
     * @var array<string, array<string>>
     */
    protected array $allowedStatusTransitions = [
        'draft' => ['pending', 'deleted'],
        'pending' => ['active', 'inactive', 'deleted'],
        'active' => ['inactive', 'discontinued', 'archived'],
        'inactive' => ['active', 'discontinued', 'deleted'],
        'discontinued' => ['active', 'deleted'],
        'archived' => ['deleted'],
        'deleted' => []
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
     * The categories that belong to the medicine.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_medicine')
            ->withPivot(['strength', 'description', 'dose_form_id', 'atc_id'])
            ->withTimestamps();
    }

    /**
     * The dose forms that belong to the medicine through the category_medicine table.
     */
    public function doseForms(): BelongsToMany
    {
        return $this->belongsToMany(DoseForm::class, 'category_medicine')
            ->withPivot(['category_id', 'atc_id', 'status', 'strength', 'description'])
            ->withTimestamps();
    }

    /**
     * The ATC codes that belong to the medicine through the category_medicine table.
     */
    public function atcCodes(): BelongsToMany
    {
        return $this->belongsToMany(AtcCode::class, 'category_medicine', 'medicine_id', 'atc_id')
            ->withPivot(['strength', 'description', 'category_id', 'dose_form_id'])
            ->withTimestamps();
    }


    /**
     * Check if the current status can transition to the given status.
     */
    public function canTransitionTo(ActiveStatus $status): bool
    {
        return in_array($status->value, $this->allowedStatusTransitions[$this->status->value] ?? []);
    }

    /**
     * Set the status attribute with transition validation.
     * mutator that validates status transitions
     */
    public function setStatusAttribute(string|ActiveStatus $value): void
    {
        $newStatus = is_string($value) ? ActiveStatus::from($value) : $value;

        if ($this->exists && !$this->canTransitionTo($newStatus)) {
            throw new InvalidStatusTransition(
                "Cannot transition from {$this->status->value} to {$newStatus->value}"
            );
        }

        $this->attributes['status'] = $newStatus->value;
    }

    /**
     * Scope a query to only include active medicines.
     */
    public function scopeActive($query)
    {
        return $query->where('status', ActiveStatus::Active->value);
    }

    /**
     * Scope a query to only include medicines with specific status.
     */
    public function scopeWithStatus($query, ActiveStatus|string $status)
    {
        $statusValue = $status instanceof ActiveStatus ? $status->value : $status;
        return $query->where('status', $statusValue);
    }

    // protected static function newFactory(): MedicineFactory
    // {
    //     // return MedicineFactory::new();
    // }
}
