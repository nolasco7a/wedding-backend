<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationsController extends Controller
{
    public function getLocations(){
        $locations = Location::all();
        return json_encode($locations);
    }
}
