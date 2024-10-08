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
        'comment',
        'gender',
        'birth_date'
        ,'phone_number',
        'created_date',
        'email',
        'type_client',
        'complete_name'
    ];

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }

    public function affaires()
    {
        return $this->hasMany(Affaire::class);
    }
}
