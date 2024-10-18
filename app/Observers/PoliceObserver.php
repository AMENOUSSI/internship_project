<?php

namespace App\Observers;

use App\Models\Client;
use App\Models\Police;
use Carbon\Carbon;

class PoliceObserver
{
    protected static $currentYear;
    protected static $lastId = 0;
    /**
     * Handle the Client "created" event.
     */
    public function creating(Police $police)
    {
        /*$year = Carbon::parse($client->created_date)->format('Y');
        $id = str_pad($client->id, 2, '0', STR_PAD_LEFT);
        $client->reference = "CUS-$year-$id";*/

        $currentYear = Carbon::now()->format('Y');

        // Vérifier si l'année a changé
        if (self::$currentYear !== $currentYear) {
            self::$currentYear = $currentYear;

            // Réinitialiser le dernier ID
            // Compter le nombre de clients pour l'année actuelle et ajouter 1
            self::$lastId = Police::whereYear('created_date', $currentYear)->count() + 1;
        } else {
            // Sinon, incrémenter l'ID
            self::$lastId++;
        }

        // Générer l'ID formaté
        $id = str_pad(self::$lastId, 5, '0', STR_PAD_LEFT);

        // Générer la référence
        $police->reference = "POL$currentYear-$id";

        // Vérifier l'unicité de la référence
        while (Client::where('reference', $police->reference)->exists()) {
            self::$lastId++;
            $id = str_pad(self::$lastId, 5, '0', STR_PAD_LEFT);
            $police->reference = "POL$currentYear-$id";
        }
}
}
