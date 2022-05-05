@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="card" style="padding: 15px;">
                <h3> Editar usuario</h3>
                <form method="POST" action="{{ route('users.update',$user->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <p>
                        <label for="username" class="form-label">Username</label>
                        <input class="form-control" type="text" name="username" value="{{$user->username}}">
                    </p>

                    <p>
                        <label for="email" class="form-label">Email</label>
                        <input  class="form-control" type="text" name="email" value="{{$user->email}}">
                    </p>
                        <button type="submit" class="btn btn-info">Guardar</button>
                        <a href="{{ route('users.index', $user->id) }}" class="btn btn-danger">Cancelar</a>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
