<?php

namespace App\Http\Controllers\API;

use App\Models\CompanyRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyRoom\CompanyRoomCollection;
use App\Http\Resources\CompanyRoom\CompanyRoomResource;
use Exception;

class CompanyRoomController extends Controller
{

    public function index()
    {
        return CompanyRoomCollection::collection(CompanyRoom::paginate(10));
    }

    public function store(Request $request)
    {
        $data = $this->validation($request);

        try {
            $data['user_id'] = auth()->user()->id;
            $res = CompanyRoom::create($data);
            return new CompanyRoomResource($res);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Something went to be wrong"
            ]);
        }
    }


    public function validation($request)
    {
        $room = CompanyRoom::where([
            ['user_id', auth()->user()->id],
            ['room_id', $request->room_id],
            ['company_id', $request->company_id]
        ])->get();
        return $errors = $request->validate([
            'company_id' => 'required',
            'room_id' => 'required',
            'already_exists' => $room->count() > 0 ? 'required' : 'nullable'
        ], [
            'already_exists.required' => 'This room allready exists to this company'
        ]);
    }



    public function show($id)
    {
        return new CompanyRoomResource(CompanyRoom::findOrFail($id));
    }


    public function update(Request $request, $id)
    {
        $data = $this->validation($request);

        try {
            $data['user_id'] = auth()->user()->id;
            $res = CompanyRoom::findOrFail($id)->update($data);
            return new CompanyRoomResource(CompanyRoom::findOrFail($id));
        } catch (Exception $e) {
            return response()->json([
                "message" => "Something went to be wrong"
            ]);
        }
    }

    public function destroy($id)
    {
        CompanyRoom::findOrFail($id)->delete();
        return response()->json([
            "message" => "Data has been deleted"
        ]);
    }
}
