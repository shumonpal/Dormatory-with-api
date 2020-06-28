<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class UserController extends VoyagerBaseController
{

    public function store(Request $request)
    {
        $validation = Validator::make( $request->all(), $this->rules());
        if ($validation->fails())
        {
            session()->flash('regi_failed', 'Registration Failed!');
            return back()->withInput()->withErrors($validation);
        }
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        User::create($data);
        $registrationSuccess = "registrationSuccess";
        return redirect(route('voyager.login'))->with('registrationSuccess', 'Registration Success!!!');
    }

    public function rules()
    {
       return [
            'name' => 'required|max:100',
            'email' => 'required|unique:users|max:100',
            'password' => 'required|max:100',
            'country' => 'required|max:100',
            'city' => 'required|max:100',
            'post_code' => 'required|max:100',
            'address' => 'required|max:200',
            'phone' => 'required|max:100',
        ]; 
    }
}    



