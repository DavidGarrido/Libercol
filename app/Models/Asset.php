<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
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
        'creator_id' => 'integer',
        'valoration' => 'integer',
    ];


    public function inventaries()
    {
        return $this->hasMany(\App\Models\Inventary::class);
    }

    public function features()
    {
        return $this->hasMany(\App\Models\Feature::class);
    }

    public function categories()
    {
        return $this->belongsToMany(\App\Models\Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
