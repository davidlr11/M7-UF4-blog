@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pefil') }}</div>

                <div class="card-body">
                    <p>
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <input class="form-control" type="text" name="username" value="{{$users->username}}" readonly>
                    </p>
            
                    <p>
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input  class="form-control" type="text" name="email" value="{{$users->email}}" readonly>
                    </p>
                    <br>
                    <a href="{{route('profile.edit',$users)}}" class="btn btn-info">Editar</a>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
