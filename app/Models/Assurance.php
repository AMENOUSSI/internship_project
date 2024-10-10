<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assurance extends Model
{
    /** @use HasFactory<\Database\Factories\AssuranceFactory> */
    use HasFactory;

    protected $fillable = [
        'client_id', 'assureur_id', 'affaire_id', 'assurance_type',
        'starting_date', 'ending_date', 'reference'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function assureur()
    {
        return $this->belongsTo(Assureur::class);
    }

    public function affaire()
    {
        return $this->belongsTo(Affaire::class);
    }
}
