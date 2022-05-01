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
        <form action="{{ route('buscador') }}" method="GET">
            <div style="display: flex; flex-direction:row;">
                <input class="form-control" type="text" name="buscador" placeholder="Buscar...">
                <button type="submit"  class="btn btn-primary" style="margin:0px 0px 0px 15px; ">Buscar</button> 
            </div>
        </form>
        <br><a href="{{ route('posts.create') }}" class="btn btn-primary">Crear nuevo post</a><br><br>
        @foreach ($posts->sortBy('id',SORT_REGULAR, true) as $post)    


        <div class="container " style="overflow-wrap: break-word;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                <div class="card" style="padding: 15px;">
                    <h3>{{$post->title}}</h3>
                    <div>{{$post->contents}}</div>
                    
                    <div style="display: flex; flex-direction:row; margin:10px 0px 10px 0px;">
                        
                     
                    @foreach($post->tags()->get() as $tag)
                        <form action="{{ route('tags.destroy', $tag)}}" method="POST"> 
                            @csrf 
                            @method("DELETE")

                            <div style="overflow-wrap: break-word; display: flex; flex-direction:row; width: 150px; height: auto; padding: 0px 10px 0px 5px; background-color:#87fa70; text-align: center; margin:0px 10px 0px 0px; border-radius: 5px; justify-content:space-between;" >
                                <div style="width: 130px;">{{$tag->tag}}</div>
                                @if(Auth::user()->id==$post->user_id)
                                <button style="padding: 0px 5px 0px 0px; outline:none; text-align:center; border:none; background-color: #87fa70">x</button>
                                @endif
                            </div>

                            
                        </form>
                    
                    @endforeach
                    </div>

                

                  
                    <?php $usuarios = $post->user()->get();
                        date_default_timezone_set('Europe/Madrid');
                        $today = date('Y-m-d h:i:s');
                        $date1 = new DateTime($today);
                        $date2 = new DateTime($post->created_at);
                        $diff_date = $date1->diff($date2);
                        
                    ?>

                    @foreach($usuarios as $usuario)
                    <?php 
                        if(Auth::user()->username==$usuario->username){
                            echo" <p>Creado por ti</p>";
                        } else {
                            echo" <p>Creado por ".$usuario->username."</p>";
                        }
                    ?>
                    

                    @if($diff_date->format('%d') == '0' && $diff_date->format(intval('%h') == '0' && $diff_date->format('%i') == '0'))
                    <p>{{$diff_date->format('%s segundos')}}</p>

                    @elseif($diff_date->format('%d') == '0' && $diff_date->format(intval('%h')) == '0')
                    <p>{{$diff_date->format('%i minutos')}}</p>

                    @elseif($diff_date->format('%d') == '0' )
                    <p>{{$diff_date->format('%h horas')}}</p>

                    @else
                    <p>{{$diff_date->format('%d días')}}</p>
                    @endif
                    
                    @endforeach
                    <div style="display: flex; flex-direction: row;">
                        @if (Auth::user()->id==$post->user_id)
                        <a href="{{route('posts.edit',$post)}}" class="btn btn-info">Editar</a>
                        
                        <form action="{{ route('posts.destroy', $post)}}" method="POST">
                                @csrf
                                @method("DELETE")
                            <button type="submit" class="btn btn-danger" style="margin:0px 10px 0px 10px">Eliminar</button>
                        </form>
                        @endif  
                        <form action="{{ route('comment', $post)}}" method="POST">
                            @csrf
                            @method("GET")
                        <button type="submit" class="btn btn-success" style="margin:0px 10px 0px 0px">Comentar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div>
        </div>       
    </div>
        <br>
        @endforeach
        
        @else
        <div style="display:flex; flex-direction:row; justify-content:center;">
            <a href="{{ route('adminpost.index') }}" style="border-radius:5px;background-color:#399fe3; padding: 30px 20px 30px 20px; color: white; margin: 0px 50px 0px; text-decoration: none;">Administrar posts</a><br><br>
            <a href="{{ route('users.index') }}" style="border-radius:5px;background-color:#399fe3; padding: 30px 20px 30px 20px; color: white;text-decoration: none;">Administrar users</a><br><br>
        </div>
        @endif
        
    </div>




</div>
@endsection
