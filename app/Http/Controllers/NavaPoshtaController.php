<?php

namespace App\Http\Controllers;

use App\Services\NovaPoshtaService;
use Illuminate\Http\Request;

class NavaPoshtaController extends Controller
{
    public function showRegions()
    {
        $novaPoshta = new NovaPoshtaService();
        $regions = $novaPoshta->getRegions();
//        dd($regions);
        return response()->json($regions);
    }

    public function showRegionCities($region)
    {
        $novaPoshta = new NovaPoshtaService();
        $cities = $novaPoshta->getRegionCities($region);
//        dd($cities);
        return response()->json( $cities);
    }

    public function showRegionCity($region, $cityRef)
    {
        $novaPoshta = new NovaPoshtaService();
        $city = $novaPoshta->getRegionCity($region, $cityRef);
//        dd($city);

        return response()->json($city);
    }

    public function showPostalOffices(Request $request)
    {
        $cityRef = $request->city_ref;
        $novaPoshta = new NovaPoshtaService();
        $postalOffices = $novaPoshta->getPostalOffices($cityRef);
//        dd($postalOffices);

        return response()->json($postalOffices);
    }

    public function showPostalPostomat($cityRef)
    {
        $novaPoshta = new NovaPoshtaService();
        $postalPostomat = $novaPoshta->getPostalPostomat($cityRef);
//        dd($postalPostomat);

        return response()->json($postalPostomat);
    }
}
