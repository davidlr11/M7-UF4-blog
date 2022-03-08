<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $role_admin=Role::where('role','admin')->get();
        $role_user=Role::where('role','user')->get();
        $role_loader=Role::where('role','loader')->get();
        $role_guest=Role::where('role','guest')->get();

        $user=new User;
        $user->username='user';
        $user->email='user@gmail.com';
        $user->password=Hash::make('123456');
        $user->role_id=Role::where('role','user')->first()->id;
        $user->save();

        $user=new User;
        $user->username='admin';
        $user->email='admin@gmail.com';
        $user->password=Hash::make('123456');
        $user->role_id=Role::where('role','admin')->first()->id;
        $user->save();

        $user=new User;
        $user->username='loader';
        $user->email='loader@gmail.com';
        $user->password=Hash::make('123456');
        $user->role_id=Role::where('role','loader')->first()->id;
        $user->save();

        $user=new User;
        $user->username='guest';
        $user->email='guest@gmail.com';
        $user->password=Hash::make('123456');
        $user->role_id=Role::where('role','guest')->first()->id;
        $user->save();
    }
}
