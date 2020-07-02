<?php

namespace App\Widgets;

//use Illuminate\Support\Facades\Auth;

use App\Models\Room;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class NotFillupRoomDimmer extends BaseDimmer
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
        $string = 'Rooms Not Fillup';
        $rooms = Room::all();
        $room_no = '';
        $rmId = [];
        foreach ($rooms as $room) {
            $people = $room->people;
            if ($people->count() < $room->capability) {
                $rmId[] = $room->id;
                $room_no .= $room->room_no . ' |';
            }
        }
        $count = count($rmId);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-group',
            'title'  => "{$count} {$string}",
            'text'   => Str::limit(Str::substr($room_no, 0, -1), 23),
            'button' => [
                'text' => 'Show Details',
                'link' => route('voyager.rooms.index', ['room' => 'no-fill-up']),
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
