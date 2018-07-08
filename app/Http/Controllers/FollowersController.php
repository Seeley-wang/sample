<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        if (\Auth::user()->id === $user->id){
            return redirect('/');
        }
         if (!\Auth::user()->isfollow($user->id)){
            \Auth::user()->follow($user->id);
         }
        return redirect()->route('users.show', $user->id);
    }

    public function destroy(User $user)
    {
        if (\Auth::user()->id === $user->id){
            return redirect('/');
        }
        if (\Auth::user()->isfollow($user->id)){
            \Auth::user()->unfollow($user->id);
        }
        return redirect()->route('users.show', $user->id);
    }
}
