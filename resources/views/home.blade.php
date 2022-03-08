@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <!--<div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>-->
        </div>
    </div>
    <div class="p-2">
        @if (Auth::user()->role_id===2)
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Crear nuevo post</a><br><br>
        @foreach ($posts as $post)    

        <div>
            <h3>{{$post->title}}</h3>
            <p>{{$post->contents}}</p>
            <div style="display: flex; flex-direction: row;">
                <a href="{{route('posts.edit',$post)}}" class="btn btn-info">Editar</a>
                <form action="{{ route('posts.destroy', $post)}}" method="POST">
                        @csrf
                        @method("DELETE")
                    <button type="submit" class="btn btn-danger" style="margin:0px 0px 0px 15px">Eliminar</button>
                </form>

            </div>       
        </div>
        <br>
        @endforeach
        @endif

        @if (Auth::user()->role_id===1)
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Administrar Posts</a><br><br>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Administrar Usuarios</a><br><br>
    
        @endif
    </div>
</div>
@endsection
