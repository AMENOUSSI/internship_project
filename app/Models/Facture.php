<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    /** @use HasFactory<\Database\Factories\FactureFactory> */
    use HasFactory;

    protected $fillable = ['client_id','emit_date','reference','status','amount','payment_date'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($facture) {
            $year = date('Y');
            // Si l'ID est auto-incrémenté après l'enregistrement, récupérez-le avec un autre moyen.
            $nextId = self::max('id') + 1;
            $facture->reference = "FAC({$year})-{$nextId}";
        });
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
