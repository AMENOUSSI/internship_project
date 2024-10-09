<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouvementPolice extends Model
{
    /** @use HasFactory<\Database\Factories\MouvementPoliceFactory> */
    use HasFactory;

    protected $fillable = ['client_id','comment','ending_date','starting_date','type'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
