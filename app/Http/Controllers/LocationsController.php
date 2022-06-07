<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\LocationLodgings;

class LocationsController extends Controller
{
    public function getLocations(){
        $locations = Location::all();
        return json_encode($locations);
    }

    public function getLocationLodging(){
        $lodgings = LocationLodgings::all();
        return json_encode($lodgings);
    }
}
