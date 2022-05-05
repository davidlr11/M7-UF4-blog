@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-2">
        
        <a href="{{ route('users.create') }}" class="btn btn-primary">Crear nuevo usuario</a><br><br>
        @foreach ($users as $user)    
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                <div class="card" style="padding: 15px; margin: 0px 0px 25px 0px;">
                    <h3>{{$user->username}}</h3>
                    <p>{{$user->email}}</p>
                    <div style="display: flex; flex-direction: row;">
                        <a href="{{route('users.edit',$user->id)}}" class="btn btn-info">Editar</a>
                        @if($user->role_id==1)
                            <button type="submit" class="btn btn-danger" style="margin:0px 0px 0px 10px" disabled>Eliminar</button> 
                        @else
                            <form action="{{ route('users.destroy', $user->id)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger" style="margin:0px 0px 0px 10px">Eliminar</button>
                            </form> 
                        @endif 
                    </div>
                </div>
            </div>
        </div>
        <div>
        </div>       
    </div>
        @endforeach
        
    </div>
</div>
@endsection
