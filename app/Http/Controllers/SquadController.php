<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Squad;

class SquadController extends Controller
{
    public function getBrideSquad(){
        $brideSquad = Squad::where('team', 2)->get();
        return json_encode($brideSquad);
    }

    public function getGroomSquad(){
        $groomSquad = Squad::where('team', 1)->get();
        return json_encode($groomSquad);
    }
}
