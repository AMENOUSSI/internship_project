<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'assurance_id',
        'assureur_id',
        'taux'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function assurance()
    {
        return $this->belongsTo(Assurance::class);
    }

    public function assureur()
    {
        return $this->belongsTo(Assureur::class);
    }
}
