<?php

namespace App\Widgets;

//use Illuminate\Support\Facades\Auth;

use App\Models\Room;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class EmptyRoomDimmer extends BaseDimmer
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
        $string = 'Empty Room';
        $rooms = Room::all();
        $room_no = '';
        $nmbr = [];
        foreach ($rooms as $room) {
            $people = $room->people;
            if ($people->count() == 0) {
                $nmbr[] = $room->id;
                $room_no .= $room->room_no . ' |';
            }
        }
        $count = count($nmbr);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-group',
            'title'  => "{$count} {$string}",
            'text'   => Str::limit(Str::substr($room_no, 0, -1), 23),
            'button' => [
                'text' => 'Show Details',
                'link' => route('voyager.rooms.index', ['room' => 'empty']),
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
        return true;
        //return Auth::user()->can('browse', Voyager::model('User'));
    }
}
