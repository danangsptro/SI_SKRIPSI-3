<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class registerPegawaiController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('page.register-pegawai.index', compact('data'));
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->position = $request->position;
        $user->password = Hash::make($request->password);

        $user->save();

        if ($user) {
            toastr()->success('Data has been saved successfully!');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        if (!$id) {
            toastr()->error('Data not found');
        } else {
            $data = User::find($id);
            if ($data) {
                $data->delete();
                toastr()->success('Data has been delete successfully!');
                return redirect()->back();
            }
        }
    }
}
