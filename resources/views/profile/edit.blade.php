@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 <div class="card-header">{{ __('Editar Perfil') }}</div>
 
                 <div class="card-body">
                    <form method="POST" action="{{ route('profile.update', Auth::user()->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <p>
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <input class="form-control" type="text" name="username" value="{{Auth::user()->username}}">
                        </p>
                
                        <p>
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input  class="form-control" type="text" name="email" value="{{Auth::user()->email}}">
                        </p>
                
                            <button type="submit" class="btn btn-info">Guardar</button>
                            <a href="{{ route('profile') }}" class="btn btn-danger">Cancelar</a>
                    </form>
                 </div>
             </div>
         </div>
    </div>
    
   
    
   
 <!--<p>
            <label for="password" class="form-label">Nueva Contraseña</label>
            <input  class="form-control" type="password" name="password">
        </p>-->


    
   
    


    
</div>
@endsection
