<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPerson extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryPersonFactory> */
    use HasFactory;

    protected $fillable = ['name'];
}
