<?php

namespace App\Widgets;

//use Illuminate\Support\Facades\Auth;

use App\Models\Temparature;
use Illuminate\Support\Str;
use TCG\Voyager\Widgets\BaseDimmer;

class HighTemparatureDimmer extends BaseDimmer
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
        $peopleM = Temparature::where('morning', '>', 37.3)->whereDate('created_at', today())->get();
        $peopleE = Temparature::where('evenning', '>', 37.3)->whereDate('created_at', today())->get();
        $peopleM = $peopleM->pluck('people_id');
        $peopleE = $peopleE->pluck('people_id');
        $people = $peopleM->concat($peopleE);
        $count = count($people->unique());

        // return count($count);
        $string = $count > 1 ? ' Person' : ' People';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-group',
            'title'  => "{$count} {$string}",
            'text'   => Str::limit('High Temparature Record', 23),
            'button' => [
                'text' => 'Show Details',
                'link' => route('voyager.temparatures.index', ['people' => 'high-temp']),
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
