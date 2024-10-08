<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affaire extends Model
{
    /** @use HasFactory<\Database\Factories\AffaireFactory> */
    use HasFactory;
    protected $fillable = ['name','starting_date','ending_date','reference'];

    public function clients()
    {
        return $this->belongsTo(Client::class);
    }
}
