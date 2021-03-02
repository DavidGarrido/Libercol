<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walletmoviment extends Model
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
        'value' => 'integer',
        'interest' => 'integer',
        'utc_start' => 'integer',
        'utc_end' => 'integer',
        'wallet_id' => 'integer',
    ];


    public function wallet()
    {
        return $this->belongsTo(\App\Models\Wallet::class);
    }
}
