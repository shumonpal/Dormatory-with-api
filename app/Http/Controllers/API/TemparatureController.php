<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Temparature\TemparatureCollection;
use App\Http\Resources\Temparature\TemparatureResource;
use App\Models\People;
use App\Models\Temparature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TemparatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Temparature::where([
            ['user_id', auth()->user()->id],
            ['room_id', request()->room_id],
        ])->whereDate('created_at', request()->created_at)->get();
        return TemparatureCollection::collection($records);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Temparature  $temparature
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $errors = Validator::make(request()->all(), [
            'room_id' => 'required',
        ]);
        if ($errors->fails()) {
            return response()->json([
                'errors' => "Please add 'room_id' parameters"
            ]);
        }
        $records = People::where([
            ['user_id', auth()->user()->id],
            ['room_id', request()->room_id],
        ])->get();

        $data = $records->map(function ($item, $key) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'identity' => $item->indentity
            ];
        });

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'room_id' => 'required',
            'people_id' => 'required',
            'time' => 'required',
            'created_at' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'errors' => "Please add 'room_id', 'time' & 'created_at' parameters."
            ]);
        }

        if ($request->query('time') == 'morning') {
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
        } elseif ($request->query('time') == 'evenning') {
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
    }
}
