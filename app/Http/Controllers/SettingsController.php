<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function getSettings(){
        $settings = Setting::all();
        return json_encode($settings);
    }
}
