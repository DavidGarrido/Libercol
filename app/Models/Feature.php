<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
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
        'weight' => 'decimal:1',
        'inventary_id' => 'integer',
        'color_id' => 'integer',
        'material_id' => 'integer',
    ];


    public function listsales()
    {
        return $this->hasMany(\App\Models\Listsale::class);
    }

    public function inventary()
    {
        return $this->belongsTo(\App\Models\Inventary::class);
    }

    public function color()
    {
        return $this->belongsTo(\App\Models\Color::class);
    }

    public function material()
    {
        return $this->belongsTo(\App\Models\Material::class);
    }
}
