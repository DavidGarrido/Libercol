<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
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
        'sales' => 'integer',
        'profit' => 'integer',
        'starts' => 'integer',
        'client_id' => 'integer',
    ];


    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }
}
