@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 <div class="card-header">{{ __('Editar Contraseña') }}</div>
 
                 <div class="card-body">
                    <form method="POST" action="{{ route('profile.changePasswordUpdate', Auth::user()->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <p>
                            <label for="passwordactual" class="form-label">Contraseña actual:</label>
                            <input class="form-control" type="password" name="passwordactual">
                        </p>
                
                        <p>
                            <label for="newpassword" class="form-label">Nueva contraseña:</label>
                            <input  class="form-control" type="password" name="newpassword">
                        </p>
                        <p>
                            <label for="newpassword2" class="form-label">Confirma la nueva contraseña:</label>
                            <input  class="form-control" type="password" name="newpassword2">
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
