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
                        <label for="title" class="form-label">Username</label>
                        <input class="form-control" type="text" name="username">
                    </p>

                    <p>
                        <label for="contents" class="form-label">Email</label>
                        <input  class="form-control" type="text" name="email">
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
