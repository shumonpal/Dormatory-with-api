<?php

namespace App\Http\Controllers;

use App\Models\CompanyRoom;
use Exception;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class CompanyRoomController extends VoyagerBaseController
{

    public function store(Request $request)
    {
        $this->validation($request);

        try {

            $res = CompanyRoom::create([
                'user_id' => $request->user_id,
                'room_id' => $request->room_id,
                'company_id' => $request->company_id,
            ]);
            $data = $res
                ? $this->alertSuccess(__('voyager::bread.success_created_bread'))
                : $this->alertError(__('voyager::bread.error_creating_bread'));

            return redirect()->route('voyager.company-rooms.index')->with($data);
        } catch (Exception $e) {
            return redirect()->route('voyager.company-rooms.index')->with($this->alertException($e, 'Saving Failed'));
        }
    }


    public function validation($request)
    {
        $room = CompanyRoom::where([
            ['user_id', auth()->user()->id],
            ['room_id', $request->room_id],
            ['company_id', $request->company_id]
        ])->get();
        $errors = $request->validate([
            'company_id' => 'required',
            'room_id' => 'required',
            'already_exists' => $room->count() > 0 ? 'required' : 'nullable'
        ], [
            'already_exists.required' => 'This room allready exists to this company'
        ]);
    }


    public function update(Request $request, $id)
    {
        $this->validation($request);

        try {

            $res = CompanyRoom::findOrFail($id)->update($request->all());
            $data = $res
                ? $this->alertSuccess(__('voyager::bread.success_created_bread'))
                : $this->alertError(__('voyager::bread.error_creating_bread'));

            return redirect()->route('voyager.company-rooms.index')->with($data);
        } catch (Exception $e) {
            return redirect()->route('voyager.company-rooms.index')->with($this->alertException($e, 'Saving Failed'));
        }
    }
}
