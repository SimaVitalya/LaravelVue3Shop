<?php


namespace App\Services;


use LisDev\Delivery\NovaPoshtaApi2;

class NovaPoshtaService
{
    /**
     * @var NovaPoshtaApi2
     */
    public $api;

    const CRIMEA = 'АРК';

    public function __construct()
    {
        $this->api = new NovaPoshtaApi2(env('NOVA_POSHTA_KEY'));
    }

    public function getRegions($search = '')
    {
        $regions = $this->api->getAreas($search);

        try {
            $regions = $regions['data'];
        } catch (\Exception $e) {
            $regions = [];
        }
        $regionsWithoutArk = [];

        foreach ($regions as $region) {
            if ($region['DescriptionRu'] !== self::CRIMEA) {
                $regionsWithoutArk['Ru'][] = $region['DescriptionRu'];

            }
        }
        return $regionsWithoutArk;
    }

    public function getRegionCities($region = '')
    {
        $cities = $this->api->getCity('', $region);

        try {
            $cities = $cities['data'];
        } catch (\Exception $e) {
            $cities = [];
        }
        $parseCities = [];

        foreach ($cities as $city) {
            $parseCities['Ru'][] = [
                'name' => $city['DescriptionRu'],
                'ref' => $city['Ref']
            ];
        }
        return $parseCities;
    }

    public function getRegionCity($region = '', $cityRegion)
    {
        $cities = $this->api->getCity($cityRegion, $region);

        try {
            $cities = $cities['data'];
        } catch (\Exception $e) {
            $cities = [];
        }
        $parseCities = [];

        foreach ($cities as $city) {
            $parseCities = [
                'name' => $city['DescriptionRu'],
                'ref' => $city['Ref']
            ];
        }
        return $parseCities;
    }

    public function getPostalOffices($city)
    {
        $postalOffices = $this->api->getWarehouses($city);

        $parsePostalOffices = [];
        if (!empty($postalOffices['data'])) {
            foreach ($postalOffices['data'] as $postalOffice) {
                if($postalOffice['CategoryOfWarehouse'] !== 'Postomat')
                {
                    $parsePostalOffices['Ru'][] = [
                        'id'   =>  $postalOffice['Ref'],
                        'name' =>  $postalOffice['DescriptionRu'],
                        'number' => $postalOffice['Number']
                    ];
                }
            }
        }
        return $parsePostalOffices;
    }

    public function getPostalPostomat($city)
    {
        $postalOffices = $this->api->getWarehouses($city['ref']);

        $parsePostalOffices = [];
        if (!empty($postalOffices['data'])) {
            foreach ($postalOffices['data'] as $postalOffice) {
                if($postalOffice['CategoryOfWarehouse'] == 'Branch')
                {
                    $parsePostalOffices['Ru'][] = [
                        'id'   =>  $postalOffice['Ref'],
                        'name' =>  $postalOffice['DescriptionRu'],
                        'number' => $postalOffice['Number']
                    ];

                }
            }
        }
        return $parsePostalOffices;
    }
}
