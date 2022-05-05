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
        return view('profile.edit',['user'=>$users]);
    }

    public function update(Request $request, User $user){
        
        $validateData=$request->validate([
            'username' => 'string',
            'email' => 'string'
            
        ]);
        //$validateData['username']=$request->username;
        //$validateData['email']=$request->email;
        //$users->password=Hash::make($request->password);
        //$validateData['role_id']=Auth::user()->role_id;
     
        /*ddd($validateData);
        ddd($user);*/

        $user->update($validateData);
        //return redirect('/profile');
        return redirect('/profile');
    }
    public function changePassword(){
        $users=Auth::user();
        return view('profile.changePassword')->with('users',$users);
    }
    public function changePasswordUpdate(Request $request){
        if(empty($request->get('passwordactual'))==false && empty($request->get('newpassword'))==false && empty($request->get('newpassword2'))==false){
            if(strlen($request->get('passwordactual')) >=6 && strlen($request->get('newpassword')) >=6 && strlen($request->get('newpassword2')) >=6){
                if($request->get('newpassword')==$request->get('newpassword2')){
                    if (Hash::check($request->get('passwordactual'), Auth::user()->password)){
                        $passwordUpdate=$request->get('newpassword');
                        User::whereId(Auth::user()->id)->update([
                            'password' => Hash::make($passwordUpdate)
                        ]);
                        
                        return redirect('/profile'); 
                    } else  {
                        return redirect(404); 
                    }     
                } else {
                    return redirect(404);
                }
            } else {
                return redirect(404);
            }
            
        } else {
            return redirect(404);
        }
        

        
    }
    
}
