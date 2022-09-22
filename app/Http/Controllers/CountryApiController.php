<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CountryApiController extends Controller
{
    private $api_url;
    public $datenow;
    //
    public function __construct()
    {
        $this->api_url = 'https://date.nager.at/api/v3/';
        $this->datenow = Carbon::now();
    }

    public function AvailableCountries()
    {
        $response = Http::get($this->api_url . 'AvailableCountries');
        if($response->status() == 200){
            return $response->json();
        }
        
        return false;
    }

    public function CountryInfo($code)
    {
        $response = Http::get($this->api_url . 'CountryInfo/' . $code);
        if($response->status() == 200){
            return $response->json();
        }
        
        return false;
    }

    public function PublicHolidays ($code, $limit)
    {
        $limited = array();
        $response = Http::get($this->api_url . 'PublicHolidays/' . $this->datenow->year . '/' . $code);

        //check if api does not return an error
        if($response->status() == 200){
            //if reponse is not empty
            if($response->json()){
                $ctr = 0;
                foreach($response->json() as $holiday){
                    if($this->datenow->now() < $holiday['date']){
                        if($ctr < $limit){
                            $limited[] = $holiday;
                            $ctr++;
                        }
                    }
                }

                return ['nextHolidays' => $limited, 'holidaysCount' => count($response->json())];
            }
        }

        //server error
        return false;
    }
}
