@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <div class="card" style="padding: 15px;">
                <h3> Editar post</h3>
                <form method="POST" action="{{ route('posts.update',$post->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <p>
                        <label for="title" class="form-label">Title</label>
                        <input class="form-control" type="text" name="title" value="{{$post->title}}">
                    </p>

                    <p>
                        <label for="contents" class="form-label">Contents</label>
                        <input  class="form-control" type="text" name="contents" value="{{$post->contents}}">
                    </p>
                        <button type="submit" class="btn btn-info">Guardar</button>
                        <a href="{{ route('home', $post->id) }}" class="btn btn-danger">Cancelar</a>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
