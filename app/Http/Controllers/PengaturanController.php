<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaturanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pengaturan.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Perubahan berhasil disimpan!');

        {
    return view('settings.update', [
        'user' => Auth::user()
    ]);
}


{
    $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email'
    ]);

    $user = Auth::user();
    $user->update($request->only('name','email'));

    return back()->with('success', 'Perubahan berhasil disimpan!');
}
    }
}
