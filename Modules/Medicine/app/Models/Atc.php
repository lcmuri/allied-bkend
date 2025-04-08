<?php

namespace Modules\Medicine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Medicine\Database\Factories\AtcFactory;

class Atc extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'parent_id',
        'name',
        'code',
        'level'
    ];

    // protected static function newFactory(): AtcFactory
    // {
    //     // return AtcFactory::new();
    // }
}
