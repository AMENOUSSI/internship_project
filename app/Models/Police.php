<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Police extends Model
{
    /** @use HasFactory<\Database\Factories\PoliceFactory> */
    use HasFactory;

    protected $fillable = [
        'client_id',
        'assureur_id',
        'affaire_id',
        'assurance_id',
        'starting_date',
        'ending_date',
        'reference'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($police) {
            $year = date('Y');
            // Si l'ID est auto-incrémenté après l'enregistrement, récupérez-le avec un autre moyen.
            $nextId = self::max('id') + 1;
            $police->reference = "POL({$year})-{$nextId}";
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function affaire()
    {
        return $this->belongsTo(Affaire::class);
    }

    public function assureur()
    {
        return $this->belongsTo(Assureur::class);
    }

    public function mouvement()
    {
        return $this->hasMany(MouvementPolice::class);
    }

    public function assurance()
    {
        return $this->belongsTo(Assurance::class);
    }
}
