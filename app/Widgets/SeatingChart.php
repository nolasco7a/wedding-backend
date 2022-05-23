<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Auth;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class SeatingChart extends AbstractWidget
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
        $countSeats = \App\Models\Guest::where('seating_chart', 1)->count();
        //$string = trans_choice('voyager::dimmer.user', $guestConfirmed);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-rum',
            'title'  => "Contador de sillas",
            'text'   => __("{$countSeats} Sillas necesarias </br> 
            para los invitados"),
            'button' => [
                'text' => "Sillas de invitados",//__('voyager::dimmer.user_link_text'),
                'link' => ""/* route('voyager.users.index'), */
            ],
            'image' => url('storage/widgets/sits-bg.jpg'),
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
//<!-- Sillas necesarias invitados que necesitan silla y los que no-->
//<!-- ruta, lista de personas que necesitan silla, un resument nombre y un desglose de los hijos si los tiene -->