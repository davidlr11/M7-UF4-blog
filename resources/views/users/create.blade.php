@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="card" style="padding: 15px;">
                <h3> Crear usuario</h3>
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf                    
                    <p>
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <input class="form-control" type="text" name="username">
                    </p>

                    <p>
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input  class="form-control" type="text" name="email">
                    </p>
                    <p>
                        <label for="password" class="form-label">Contraseña</label>
                        <input  class="form-control" type="password" name="password">
                    </p>
                    <br>
                        <button type="submit" class="btn btn-info">Crear</button>
                        <a href="{{ route('users.index') }}" class="btn btn-danger">Cancelar</a>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
