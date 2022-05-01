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
        <form action="{{ route('buscadorAdmin') }}" method="GET">
            <div style="display: flex; flex-direction:row;">
                <input class="form-control" type="text" name="buscador" placeholder="Buscar...">
                <button type="submit"  class="btn btn-primary" style="margin:0px 0px 0px 15px; ">Buscar</button> 
            </div>
        </form><br>
        <a href="{{ route('adminpost.create') }}" class="btn btn-primary">Crear nuevo post</a><br><br>
        @foreach ($posts->sortBy('id',SORT_REGULAR, true) as $post)    


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                <div class="card" style="padding: 15px;">
                    <h3>{{$post->title}}</h3>
                    <p>{{$post->contents}}</p>
                    <div style="display: flex; flex-direction:row; margin:10px 0px 10px 0px;">
                        
                     
                        @foreach($post->tags()->get() as $tag)
                            <form action="{{ route('tags.destroy', $tag)}}" method="POST"> 
                                @csrf 
                                @method("DELETE")
                                
                                
                                <div style="overflow-wrap: break-word; display: flex; flex-direction:row; width: 150px; height: auto; padding: 0px 10px 0px 5px; background-color:#87fa70; text-align: center; margin:0px 10px 0px 0px; border-radius: 5px; justify-content:space-between;" >
                                    <div style="width: 130px;">{{$tag->tag}}</div>
                                    
                                    <button style="padding: 0px 5px 0px 0px; outline:none; text-align:center; border:none; background-color: #87fa70">x</button>
                                
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
                        <a href="{{route('adminpost.edit',$post)}}" class="btn btn-info">Editar</a>
                        @endif
                        <form action="{{ route('adminpost.destroy', $post)}}" method="POST">
                                @csrf
                                @method("DELETE")
                            <button type="submit" class="btn btn-danger" style="margin:0px 0px 0px 10px">Eliminar</button>
                        </form>
                        <form action="{{ route('comment', $post)}}" method="POST">
                            @csrf
                            @method("GET")
                        <button type="submit" class="btn btn-success" style="margin:0px 10px 0px 10px">Comentar</button>
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
        
    </div>
</div>
@endsection
