<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouvementPolice extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','police_id','comment','ending_date','starting_date','type','reference',];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($mouvement) {
            $year = date('Y');
            // Si l'ID est auto-incrémenté après l'enregistrement, récupérez-le avec un autre moyen.
            $nextId = self::max('id') + 1;
            $mouvement->reference = "MPL({$year})-{$nextId}";
        });
    }



    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
