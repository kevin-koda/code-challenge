<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    //
    public $allCountries;

    public function __construct()
    {
        
    }

    public function index(){
        $this->allCountries = (new CountryApiController)->AvailableCountries();
        $paginated = (new PaginationController)->paginate($this->allCountries);

        return view('countries', ['countries' => $paginated]);
    }

    public function country($code)
    {
        $HolidayLimit = 4;

        //get country ifnormation
        $countryInfo = (new CountryApiController)->CountryInfo($code);
        if($countryInfo){
            $countryHoliday = (new CountryApiController)->PublicHolidays($code, $HolidayLimit);
        }else{
            $countryHoliday['nextHolidays']  = false;
            $countryHoliday['holidaysCount'] = false;
        }
        

        return view('country', [
            'info'         => $countryInfo, 
            'holidays'     => $countryHoliday['nextHolidays'], 
            'holidayCount' => $countryHoliday['holidaysCount']
        ]);
    }
}
