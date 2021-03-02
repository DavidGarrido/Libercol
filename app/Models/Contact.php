<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
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
        'tel' => 'integer',
        'cel_one' => 'integer',
        'cel_two' => 'integer',
        'whatsapp' => 'integer',
        'telegram' => 'integer',
        'address_id' => 'integer',
        'modeltable_id' => 'integer',
    ];


    public function address()
    {
        return $this->belongsTo(\App\Models\Address::class);
    }
}
