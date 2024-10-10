<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouvementPolice extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','police_id','comment','ending_date','starting_date','type','reference',];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function police()
    {
        return $this->belongsTo(Client::class);
    }

}
