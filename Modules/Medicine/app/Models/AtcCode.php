<?php

namespace Modules\Medicine\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Medicine\Database\Factories\AtcCodeFactory;

class AtcCode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): AtcCodeFactory
    // {
    //     // return AtcCodeFactory::new();
    // }
}
