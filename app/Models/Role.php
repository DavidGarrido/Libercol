<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected $fillable = ['name','slug','code'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];
    public function getRouteKeyName()
    {
        // return $this->getKeyName();
        return 'slug';
    }


    public function permissions()
    {
        return $this->belongsToMany(\App\Models\Permission::class);
    }
    public function users()
    {
        return $this->morphedByMany(\App\Models\User::class, 'rolegable');
    }
    public function companies()
    {
        return $this->morphedByMany(\App\Models\Company::class, 'rolegable');
    }
    public function points()
    {
        return $this->morphedByMany(\App\Models\Point::class, 'rolegable');
    }
}
