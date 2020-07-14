<?php

namespace App\Http\Controllers;

use App\Models\Temparature;
use App\Models\People;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use PDF;

class TemparatureController extends VoyagerBaseController
{

    public function record(Request $request)
    {

        $records = Temparature::where([
            ['user_id', auth()->user()->id],
            ['room_id', $request->room_id],
        ])->whereDate('created_at', $request->created_at)->with('people')->get();
        if (!$request->expectsJson()) {
            $room = Room::where('id', $request->room_id)->first()->value('room_no');
            $pdf = PDF::loadView('pdf.temp.record', compact('records', 'room'));
            return $pdf->download(date('d-m-Y') . '-temparature.pdf');
        }
        return view('ajax.temp.record', compact('records'));
    }


    public function add(Request $request)
    {

        $errors = Validator::make($request->all(), [
            'room_id' => 'required',
            'created_at' => 'required',
            'period' => 'required',
        ]);
        if (!$request->expectsJson()) {
            if ($errors->fails()) {
                return back()->withErrors($errors);
            }
            $records = Temparature::where([
                ['user_id', auth()->user()->id],
                ['room_id', $request->room_id],
            ])->whereDate('created_at', $request->created_at)->with('people')->get();
            $room = Room::where('id', $request->room_id)->first()->value('room_no');
            $pdf = PDF::loadView('pdf.temp.record', compact('records', 'room'));
            return $pdf->download(date('d-m-Y') . '-temparature.pdf');
        }
        if ($errors->fails()) {
            return response()->json([
                'errors' => 'Select all the fields.'
            ]);
        }
        $records = People::where([
            ['user_id', auth()->user()->id],
            ['room_id', $request->room_id],
        ])->get();

        if (!$request->expectsJson()) {
            $records = Temparature::where([
                ['user_id', auth()->user()->id],
                ['room_id', $request->room_id],
            ])->whereDate('created_at', $request->created_at)->with('people')->get();
            $room = Room::where('id', $request->room_id)->first()->value('room_no');
            $pdf = PDF::loadView('pdf.temp.record', compact('records', 'room'));
            return $pdf->download(date('d-m-Y') . '-temparature.pdf');
        }

        $date = $request->created_at;
        $period = $request->period;
        return view('ajax.temp.add', compact('records', 'date', 'period'));
    }

    public function store(Request $request)
    {

        if ($request->has('morning')) {
            Temparature::updateOrCreate([
                'user_id' => auth()->user()->id,
                'room_id' => $request->room_id,
                'people_id' => $request->people_id,
                'created_at' => $request->created_at
            ], [
                'morning' => $request->morning
            ]);
            return response()->json([
                'message' => "Record added"
            ]);
        } elseif ($request->has('evenning')) {
            Temparature::updateOrCreate([
                'user_id' => auth()->user()->id,
                'room_id' => $request->room_id,
                'people_id' => $request->people_id,
                'created_at' => $request->created_at
            ], [
                'evenning' => $request->evenning
            ]);
            return response()->json([
                'message' => "Record added"
            ]);
        }
        else {
            return response()->json([
                'message' => "Empty Value can not be added"
            ]);
        }
    }
}
