<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'municipality_id' => 'integer',
    ];


    public function contacts()
    {
        return $this->hasMany(\App\Models\Contact::class);
    }

    public function municipality()
    {
        return $this->belongsTo(\App\Models\Municipality::class);
    }
}
