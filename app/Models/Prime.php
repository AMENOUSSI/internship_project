<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prime extends Model
{
    /** @use HasFactory<\Database\Factories\PrimeFactory> */
    use HasFactory;

    protected $fillable = ['client_id','prime_nette','assessors','tax','type_prime','type_risque','total'];

    public static function boot()
    {
        parent::boot();

        // Calculer le total avant de créer ou de mettre à jour un enregistrement
        static::saving(function ($prime) {
            $prime->total = $prime->prime_nette + $prime->assessors + $prime->tax;
        });
    }


    public function police()
    {
        return $this->belongsTo(Police::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function assurance()
    {
        return $this->client->assurances->first();
    }
}
