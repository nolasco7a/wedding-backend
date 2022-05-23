<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Illuminate\Http\Request;

/* 
Data dictionary:
    status: 
    0 - gift unavailable,
    1 - gift available, new gift.
    2 - gift already selected.;
 */

class GiftController extends Controller
{
    public function getGifts(){
        $gifts = Gift::where('status', 1)->get();
        return json_encode($gifts);
    }

    public function pickGift(Request $request){
        $gift = Gift::find($request->id);
        $gift->status = 2;
        $gift->save();
        return response()->json(['message' => 'Gift picked'], 200);
    }

    public function giftResume(){
        $giftSelected = Gift::where('status', 2)->get();
        $giftAvailable = Gift::where('status', 1)->get();

        return view('voyager_custom_views.gift_resume', compact('giftSelected', 'giftAvailable'));
    }
}
