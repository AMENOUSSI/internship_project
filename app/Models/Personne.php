<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    /** @use HasFactory<\Database\Factories\PersonneFactory> */
    use HasFactory;

    protected $fillable =['type','rate'];
}
