<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdateUserSettings extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function handleAvatar(Request $request): RedirectResponse
    {
        $request->validate(['avatar' => 'required|image|mimes:jpg,jpeg,png']);
        $direction = $request->file('avatar')->store('uploads', ['disk' => 'public']);

        $user = Auth::user();
        $user->avatar = pathinfo($direction, PATHINFO_BASENAME);
        $user->save();

        return redirect()->route('home')->with([
            'success' => __('.success_update_avatar')
        ]);
    }
}
