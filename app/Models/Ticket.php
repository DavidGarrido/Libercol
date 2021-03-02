<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
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
        'total' => 'integer',
        'utc' => 'integer',
        'point_id' => 'integer',
        'creator_id' => 'integer',
        'vendor_id' => 'integer',
    ];


    public function extras()
    {
        return $this->hasMany(\App\Models\Extra::class);
    }

    public function point()
    {
        return $this->belongsTo(\App\Models\Point::class);
    }

    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
