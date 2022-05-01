@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="card" style="padding: 15px;">
                <h3> Crear post</h3>
                <form method="POST" action="{{ route('adminpost.store') }}">
                    @csrf                    
                    <p>
                        <label for="title" class="form-label">Title</label>
                        <input class="form-control" type="text" name="title">
                    </p>

                    <p>
                        <label for="contents" class="form-label">Contents</label>
                        <input  class="form-control" type="text" name="contents">
                    </p>
                    <label>Tag</label><br>
                    <input class="form-control" type="text" name="tags" style="width:50%;"><br>
                        <button type="submit" class="btn btn-info">Crear</button>
                        <a href="{{ route('adminpost.index') }}" class="btn btn-danger">Cancelar</a>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
