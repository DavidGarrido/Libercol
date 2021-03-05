<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
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
        'company_id' => 'integer',
    ];


    public function inventaries()
    {
        return $this->hasMany(\App\Models\Inventary::class);
    }

    public function tickets()
    {
        return $this->hasMany(\App\Models\Ticket::class);
    }

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }
}
