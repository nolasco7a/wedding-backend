<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class Guest extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //acepted invitations
        $countGuests = \App\Models\Guest::count(); 
        $guestPending = \App\Models\Guest::where('status', '=', 2)->count();
        $guestConfirmed = \App\Models\Guest::where('status', 1)->count();
        $guestNoConfirmed = \App\Models\Guest::where('status', 0)->count();
        //$string = trans_choice('voyager::dimmer.user', $guestConfirmed);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-group',
            'title'  => "{$countGuests} Invitados",
            'text'   => __("{$guestConfirmed} Invitados confirmados </br> 
            {$guestPending} Invitados pendientes </br>"),
            'button' => [
                'text' => "Invitados",//__('voyager::dimmer.user_link_text'),
                'link' => "admin/guest%20resume"/* route('voyager.users.index'), */
            ],
            'image' => voyager_asset('images/widget-backgrounds/01.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Voyager::model('User'));
    }
}
