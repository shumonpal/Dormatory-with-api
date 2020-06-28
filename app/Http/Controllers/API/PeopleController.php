<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\People\PeopleCollection;
use App\Http\Resources\People\PeopleResource;
use App\Models\People;
use Exception;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return request()->query();
        $people = People::where('room_id', request()->room_id)->get();
        if ($people->isEmpty()) {
            return response()->json([
                "message" => "Data not found!"
            ]);
        }
        return PeopleCollection::collection($people);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request);
        try {
            $res = People::updateOrCreate(
                [
                    'user_id' => auth()->user()->id,
                    'company_id' => $data['company'],
                    'indentity' => $data['identity']
                ],

                [
                    'room_id' => $data['room'],
                    'name' => $data['name'],
                    'others' => $data['others']
                ]
            );
            return new PeopleResource($res);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Something went to be wrong"
            ]);
        }
    }


    public function validation($request)
    {
        return $errors = $request->validate([
            'room' => 'required',
            'company' => 'required',
            'name' => 'required|max:50',
            'identity' => 'required|max:50',
            'others' => 'nullable|max:100',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function show(People $people)
    {
        //return new PeopleResource($people);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        try {
            $people = People::findOrFail($id);
            $res = $people->update([
                'room_id' => $data['room'],
                'company_id' => $data['company'],
                'name' => $data['name'],
                'indentity' => $data['identity'],
                'others' => $data['others']
            ]);
            return new PeopleResource($people);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Something went to be wrong"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\People  $people
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        People::findOrFail($id)->delete();
        return response()->json([
            "message" => "Data has been deleted"
        ]);
    }
}
