<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assureur extends Model
{
    /** @use HasFactory<\Database\Factories\AssureurFactory> */
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    public function polices()
    {
        return $this->hasMany(Police::class);
    }

    public function assurances()
    {
        return $this->hasMany(Assurance::class);
    }
}
