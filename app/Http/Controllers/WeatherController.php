<?php

namespace App\Http\Controllers;

use App\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    //
    public function index()
    {

        $lat = '53.25209';
        $lon = '34.37167';

        $weather = new Weather($lat, $lon);

        $weather->loadData();

//dd($weather->data);

        return view('weather.index', compact('weather'));
    }
}
