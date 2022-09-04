<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function profile()
    {
        $data = Auth::user();
        return view('page.profile.index', compact('data'));
    }

    public function editProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:2',
            'email' => 'required|min:1',
        ]);
        $input = $request->all();
        $data = user::find($id);
        $data->update($input);

        toastr()->success('Selamat! Data Profile berhasil diperbaharui.');
        return redirect()->back();
    }


    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:2',
            'confirm_password' => 'required|min:2|same:password'
        ]);

        $data = User::find($id);
        $data->update([
            'password' => Hash::make($request->password)
        ]);

        toastr()->success('Selamat! Password berhasil diperbaharui.');
        return redirect()->back();
    }
}
