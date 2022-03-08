<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$users = User::all();
        $users=Auth::user();
        return view('profile')->with('users',$users);
    }
    public function edit(User $user)
    {
        $user=Auth::user();
        return view('profile.edit',['user'=>$user]);
    }

    public function update(Request $request, User $user){
        
        $validateData=$request->validate([
            'username' => 'string|unique:users',
            'email'=>'string|unique:users'
            
        ]);
        $validateData['username']=$request->username;
        $validateData['email']=$request->email;
        //$users->password=Hash::make($request->password);
        //$validateData['user_id']=Auth::user()->id;
     
        //ddd($validateData);
        $user->update($validateData);
        return redirect('/profile');
    }

}
