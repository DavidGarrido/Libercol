<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
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
        'modeltable_id' => 'integer',
        'wallettype_id' => 'integer',
        'reference' => 'integer',
    ];


    public function walletmoviments()
    {
        return $this->hasMany(\App\Models\Walletmoviment::class);
    }

    public function wallettype()
    {
        return $this->belongsTo(\App\Models\Wallettype::class);
    }
}
