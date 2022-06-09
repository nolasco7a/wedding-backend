<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Guest;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        
        $userId = 1; 
        $guest = Guest::find($userId);

        try {
            Mail::to($guest->email, 'Invitation wedding')->send(new TestMail($guest));
            return response()->json(['message' => 'Email sent'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Email not sent '], 500);
        }
        
    }

    public function sendInvitation(Request $request){
        $id = $request->id;
        if ($id != null || $id != '') {
            $guestId = $id;
            $guest = Guest::find($guestId);
            if ($guest->email_status == 1) {
                //return json_encode(['status' => false, 'message' => 'Email already sent']);
                return redirect()->route('guestResume')->with('message','Email already sent');
            }

            if (($guest->email != null || $guest->email != '') && ($guest->email_status == 0 || $guest->email_status == null)) {
                try {
                    Mail::to(trim($guest->email), 'Invitation wedding')->send(new TestMail($guest));
                    $guest->email_status = 1;
                    $guest->status = 2;
                    $guest->save();
                    //return json_encode(['status' => true, 'message' => 'Email sent']);
                    return redirect()->route('guestResume')->with('message','Email sent successfully.');
                } catch (\Throwable $th) {
                    //return json_encode(['status' => false, 'message' => 'Email not sent']);
                    return redirect()->route('guestResume')->with('message','Oops! There was some error sending the email.');
                }
            }
        }else{
            return redirect()->route('guestResume')->with('message','Oops!, Guest not found.');
        }
    }

    public function sendPendingInvitations(){
        $guests = Guest::where('email_status', 0)
        ->where('category', 1)
        ->where('status', 0)
        ->get();
        foreach ($guests as $guest) {
            try {
                Mail::to($guest->email)->send(new TestMail($guest), 'Invitation wedding');
                $guest->email_status = 1;
                $guest->save();
            } catch (\Throwable $th) {
                return response()->json(['message' => 'Oops! There was some error sending the email.'], 500);
            }
        }
        return response()->json(['message' => 'Emails sent successfully.'], 200);
    }
}
