<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Role;

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
        $users = Auth::user();
        //ddd($users);
        //$users=Auth::user()->id;
        return view('profile.edit',['user'=>$users]);
    }

    public function update(Request $request, User $user){
        
        
        $validateData=$request->validate([
            'username' => 'string',
            'email' => 'string'
            
        ]);
        //$validateData['username']=$request->username;
        $validateData['email']=$request->email;
        //$users->password=Hash::make($request->password);
        //$validateData['role_id']=Auth::user()->role_id;
     
        /*ddd($validateData);
        ddd($user);*/
        $user->update($validateData);
        return redirect('/profile');
        return back();
    }

}
