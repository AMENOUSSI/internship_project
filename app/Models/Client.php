<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    protected $fillable = [
        'pays_id',
        'reference',
        'comment',
        'gender',
        'birth_date'
        ,'phone_number',
        'created_date',
        'type',
        'adresse',
        'email',
        'category_people_id',
        'complete_name'
    ];

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }

    public function assurances()
    {
        return $this->hasMany(Assurance::class);
    }

    public function affaires()
    {
        return $this->hasMany(Affaire::class);
    }

    public function prime()
    {
        return $this->belongsTo(Prime::class);
    }

    public function categoryPeople()
    {
        return $this->belongsTo(CategoryPerson::class);
    }

    public function mouvement()
    {
        return $this->hasOne(MouvementPolice::class);
    }

    /*protected static function booted()
    {
        static::created(function ($client) {
            $year = \Carbon\Carbon::parse($client->created_date)->format('Y'); // Format de l'année à partir de created_date
            $id = str_pad($client->id, 2, '0', STR_PAD_LEFT); // ID formaté
            $client->reference = 'CUS-' . $year . '-' . $id;
            $client->saveQuietly(); // Sauvegarde sans déclencher d'autres événements
        });
    }*/
}
