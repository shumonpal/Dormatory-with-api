<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Room\RoomCollection;
use App\Http\Resources\Room\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RoomCollection::collection(Room::paginate(10));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $validate = Validator::make($request->all(), $this->rules());
        if ($validate->fails()) {
            return response()->json([
                'errors' => $validate->errors()
            ]);
        }
        $data = $validate->validated();
        $data['user_id'] = auth()->user()->id;
        $company = Room::create($data);
        return new RoomResource($company);
    }


    public function rules()
    {
        return [
            'room_no' => ['required', request()->isMethod('POST') ? 'unique:rooms' : '', 'max:50'],
            'capability' => 'required|integer|max:30',
            'others' => 'nullable'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return new RoomResource($room);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $validate = Validator::make($request->all(), $this->rules());
        if ($validate->fails()) {
            return response()->json([
                'errors' => $validate->errors()
            ]);
        }
        $data = $validate->validated();

        $room->update($data);
        return new RoomResource($room);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json([
            "message" => "Data has been deleted"
        ]);
    }
}
