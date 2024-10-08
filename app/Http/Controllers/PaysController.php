<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaysController extends Controller
{
    /**
     * Display a listing of the countries.
     */


    /*public function importPays()
    {
        $response = Http::get('https://api.thecompaniesapi.com/v2/locations/countries');
        $pays = $response->json('countries');

        foreach ($pays as $paysData) {
            Pays::create([
                'code' => $paysData['code'],
                'name' => $paysData['nameFr'], // Utilisez 'name' si vous préférez le nom en anglais
            ]);
        }
        return 'Importation terminée !';
    }*/

    public function importPays()
    {
        $page = 1;
        $totalPages = 1; // Initialiser pour démarrer la boucle
        $url = 'https://api.thecompaniesapi.com/v2/locations/countries';

        do {
            $response = Http::get($url, ['page' => $page]);
            $data = $response->json();
            $paysList = $data['countries'];

            // Insérer les pays dans la base de données
            foreach ($paysList as $paysData) {
                Pays::updateOrCreate( // Utiliser updateOrCreate pour éviter les doublons
                    ['code' => $paysData['code']],
                    ['name' => $paysData['nameFr']]
                );
            }

            // Mettre à jour les variables de pagination
            $page++;
            $totalPages = $data['meta']['lastPage'];

        } while ($page <= $totalPages);

        return 'Importation terminée pour tous les pays !';
    }




}
