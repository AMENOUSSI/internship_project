<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prime extends Model
{
    /** @use HasFactory<\Database\Factories\PrimeFactory> */
    use HasFactory;

    protected $fillable = ['police_id','client_id','prime_nette','assessors','tax'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function police()
    {
        return $this->belongsTo(Police::class);
    }
}
