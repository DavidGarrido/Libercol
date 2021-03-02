<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
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
        'departament_id' => 'integer',
    ];


    public function addresses()
    {
        return $this->hasMany(\App\Models\Address::class);
    }

    public function departament()
    {
        return $this->belongsTo(\App\Models\Departament::class);
    }
}
