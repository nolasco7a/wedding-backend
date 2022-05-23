<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class Gift extends AbstractWidget
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
        $countGifts = \App\Models\Gift::count();
        $giftsSelected = \App\Models\Gift::where('status', 2)->count();
        $giftsAvailable = \App\Models\Gift::where('status', 1)->count();
        //$string = trans_choice('voyager::dimmer.user', $guestConfirmed);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-gift',
            'title'  => "{$countGifts} Regalos",
            'text'   => __("{$giftsSelected} Regalos seleccionados, </br> 
            {$giftsAvailable} Regalos disponibles"),
            'button' => [
                'text' => "Regalos",//__('voyager::dimmer.user_link_text'),
                'link' => "admin/gifts"/* route('voyager.users.index'), */
            ],
            'image' => url('storage/widgets/gift-bg.jpg'),
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
//<!-- resumen de todos los apartados, cuantos ya los pidio un empleado y cuantos estan pendientes de ser seleccionados -->
//<!-- hacer un vista con un listado de lo mencionado anteriormente -->