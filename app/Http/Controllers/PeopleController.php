<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class PeopleController extends VoyagerBaseController
{
    public function peopleByRoom(Request $request)
    {

        $people = People::where([
            ['user_id', auth()->user()->id],
            ['room_id', $request->room_id],
        ])->get();
        return view('ajax.people.people-by-room', compact('people'));
    }

    public function destroy(Request $request, $id)
    {
        People::findOrFail($id)->forceDelete();
        return $id;
    }
}
