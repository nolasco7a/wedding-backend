<?php

namespace App\Http\Controllers;

use App\Models\SectionHome;
use App\Models\MyWedding;
use Illuminate\Http\Request;

class ViewDataController extends Controller
{
    public function getHomeData(){
        $homeData = SectionHome::first();
        return $homeData;
    }

    public function getSlider(){
        $slider = MyWedding::all();
        return $slider;
    }
}
