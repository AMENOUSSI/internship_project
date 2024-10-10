<?php

namespace App\Observers;

use App\Models\Client;
use Carbon\Carbon;

class ClientObserver
{
    protected static $currentYear;
    protected static $lastId = 0;
    /**
     * Handle the Client "created" event.
     */
    public function creating(Client $client)
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
            self::$lastId = Client::whereYear('created_date', $currentYear)->count() + 1;
        } else {
            // Sinon, incrémenter l'ID
            self::$lastId++;
        }

        // Générer l'ID formaté
        $id = str_pad(self::$lastId, 2, '0', STR_PAD_LEFT);

        // Générer la référence
        $client->reference = "CUS-$currentYear-$id";

        // Vérifier l'unicité de la référence
        while (Client::where('reference', $client->reference)->exists()) {
            self::$lastId++;
            $id = str_pad(self::$lastId, 2, '0', STR_PAD_LEFT);
            $client->reference = "CUS-$currentYear-$id";
        }
    }

    public function created(Client $client)
    {
        /*$year = Carbon::parse($client->created_date)->format('Y');
        $id = str_pad($client->id, 2, '0', STR_PAD_LEFT);
        $client->reference = "CUS-$year-$id";

        // Sauvegardez la référence dans la base de données
        $client->saveQuietly(); // Utilisez saveQuietly pour éviter de relancer l'événement `saving`*/


    }

    /**
     * Handle the Client "updated" event.
     */
    public function updated(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "deleted" event.
     */
    public function deleted(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "restored" event.
     */
    public function restored(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "force deleted" event.
     */
    public function forceDeleted(Client $client): void
    {
        //
    }
}
