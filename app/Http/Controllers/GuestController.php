<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Gift;
use App\Models\ChildParent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/*
Data dictionary:
    status:
    0 - new guest, not yet invited,
    1 - confirmed, invited,
    2 - pending, invited,
    3 - declined, not invited,

    category:
    2 - child,
    1 - parent,

    mail_status:
    0 - email not sent,
    1 - email sent,
 */
class GuestController extends Controller
{
    public function getGuests(){
        $guests = Guest::all();
        return $guests;
    }

    public function getChildOfParents(Request $request){
        $getChildrenId = Guest::select('child')
            ->from('guests as g')
            ->join('child_parents as cp', 'g.id', '=', 'cp.father')
            ->where('g.id', $request->id)
            ->get();
        $countChildren = count($getChildrenId);

        if ($countChildren == 0) {
            return response()->json(['message' => 'No children found'], 404);
        }else{
            foreach ($getChildrenId as $childId) {
                $children[] = Guest::find($childId->child)
                    ->where('status', "!=", 1)
                    ->get();
            }
            return response()->json($children, 200);
        }
    }

    public function changueStatusGuest(Request $request){
        $guest = Guest::find($request->id);
        $guest->status = $request->status;
        $guest->save();
        return response()->json(['message' => 'Guest status changed'], 200);
    }

    public function guestResume(){
        $confirmedGuests=[];
        $guests = Guest::select('g.*')
            ->from('guests as g')
            ->leftJoin('child_parents as cp', 'g.id', '=', 'cp.parent')
            ->where('g.status', 1)
            ->where('g.category', 1)
            ->get();
        foreach ($guests as $guest) {
            $countChildrenGuest = ChildParent::select('cp.*')
                ->from('child_parents as cp')
                ->join('guests as g', 'cp.parent', '=', 'g.id')
                ->where('cp.parent', $guest->id)
                ->where('g.status', 1)
                ->count();

                $confirmedGuests[] = [
                    'id' => $guest->id,
                    'name' => $guest->first_name,
                    'last_name' => $guest->last_name,
                    'email' => $guest->email,
                    'phone' => $guest->phone_number,
                    'updated_at' => Carbon::parse($guest->updated_at)->format('d-m-Y'),
                    'childrens' => $countChildrenGuest,
                ];
        }

        //dd($confirmedGuests);
        $pendingGuests = Guest::where('status', 2)
        ->where('category', 1)
        ->where('email_status', 1)
        ->get();

        $pendingInvitations = Guest::where('status', 0)
        ->where('category', 1)
        ->where('email_status', 0)
        ->get();


        return view('voyager_custom_views.guest_resume', compact('confirmedGuests', 'pendingGuests', 'pendingInvitations'));
    }

    protected function validatorDataNewGuest(array $data){
        return validator::make($data, [
            'name'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'phone_number'=>'required|numeric',
            'status'=>'required|boolean'
        ]);
    }

    public function createNewGuests(Request $request){
        try {
            if ($this->validatorDataNewGuest($request->all())->validate()){
                Guest::create([
                    'first_name' => $request->name,
                    'last_name' => $request->lastname,
                    'email'=>$request->email,
                    'phone_number'=>$request->phone_number,
                    'status'=>$request->status,
                    'song' => $request->song !== '' ? $request->song : null,
                    'allergies' => $request->allergies !== '' ? $request->allergies : null,
                    'other_event' => $request->other_event !== '' ? $request->other_event : null,
                    'seating_chart'=>1,
                    'category'=>1,
                    'email_status'=>$request->status?1:0
                ])->save();
                if ($request->selected_gifts != null || $request->selected_gifts != '') {
                    foreach ($request->selected_gifts as $gift) {
                        Gift::where('id', $gift['id'])->update(['status' => 2]);
                    }
                }

            }else{
                return response()->json(['message'=>'Data incorrect, fill the fields correctly']. 400);
            }
            return response()->json(['message'=>'New guest created successfully'], 200);
        }catch(Exception $e){
            return response()->json(['message'=>'It have occurred an error, new guest can not be created', 'error'=>$e->getMessage()], 400);
        }
    }
}
