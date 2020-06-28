<?php

namespace App\Http\Controllers;

use App\Models\Temparature;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class TemparatureController extends VoyagerBaseController
{

    public function record(Request $request)
    {

        $records = Temparature::where([
            ['user_id', auth()->user()->id],
            ['room_id', $request->room_id],
        ])->whereDate('created_at', $request->created_at)->get();
        return view('ajax.temp.record', compact('records'));
    }


    public function add(Request $request)
    {

        $errors = Validator::make($request->all(), [
            'room_id' => 'required',
            'created_at' => 'required',
        ]);
        if ($errors->fails()) {
            return response()->json([
                'errors' => 'Select all the fields.'
            ]);
        }
        $records = People::where([
            ['user_id', auth()->user()->id],
            ['room_id', $request->room_id],
        ])->get();
        $date = $request->created_at;
        return view('ajax.temp.add', compact('records', 'date'));
    }

    public function store(Request $request)
    {
        $records = Temparature::where([
            ['user_id', auth()->user()->id],
            ['room_id', $request->room_id],
            ['people_id', $request->people_id],
        ])->whereDate('created_at', $request->created_at)->get();

        if ($records->count() > 0) {
            if ($request->has('morning')) {
                auth()->user()->temparatures()->update([
                    'morning' => $request->morning,
                ]);
            } elseif ($request->has('evenning')) {
                auth()->user()->temparatures()->update([
                    'evenning' => $request->evenning,
                ]);
            }
        } else {
            auth()->user()->temparatures()->create($request->all());
        }
    }
}
