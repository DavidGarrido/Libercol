<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
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
    ];


    public function fiscals()
    {
        return $this->hasMany(\App\Models\Fiscal::class);
    }

    public function points()
    {
        return $this->hasMany(\App\Models\Point::class);
    }

    public function clients()
    {
        return $this->hasMany(\App\Models\Client::class);
    }
}