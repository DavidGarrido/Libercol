<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallettype extends Model
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
        'bank_id' => 'integer',
        'limit' => 'integer',
    ];


    public function wallets()
    {
        return $this->hasMany(\App\Models\Wallet::class);
    }

    public function bank()
    {
        return $this->belongsTo(\App\Models\Bank::class);
    }
}
