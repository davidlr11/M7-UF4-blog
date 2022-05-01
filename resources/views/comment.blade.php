@extends('layouts.app')

@section('content')
<div class="container">
   
    <div class="p-2">  


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                <div class="card" style="padding: 15px;">
                    <h3>{{$post->title}}</h3>
                    <p>{{$post->contents}}</p>
                    <?php $usuarios = $post->user()->get();
                        date_default_timezone_set('Europe/Madrid');
                        $today = date('Y-m-d h:i:s');
                        $date1 = new DateTime($today);
                        $date2 = new DateTime($post->created_at);
                        $diff_date = $date1->diff($date2);
                        
                    ?>
                    <div style="display:flex; float: right;">
                    @foreach($usuarios as $usuario)
                    
                        <?php 
                            if(Auth::user()->username==$usuario->username){
                                echo"Creado por ti | ";
                            } else {
                                echo"Creado por ".$usuario->username." | Hace &nbsp";
                            }
                        ?>
                    
                    

                    @if($diff_date->format('%d') == '0' && $diff_date->format(intval('%h') == '0' && $diff_date->format('%i') == '0'))
                    <p> {{$diff_date->format('%s segundos')}}</p>

                    @elseif($diff_date->format('%d') == '0' && $diff_date->format(intval('%h')) == '0')
                    <p> {{$diff_date->format('%i minutos')}}</p>

                    @elseif($diff_date->format('%d') == '0' )
                    <p> {{$diff_date->format('%h horas')}}</p>

                    @else
                    <p> {{$diff_date->format('%d días')}}</p>
                    @endif
                    
                    @endforeach

                </div>

                <form method="POST" action="{{ route('comment.store') }}">
                    @csrf
                    
                    
                    <div style="display: flex; flex-direction: row;">
                        <input class="form-control" type="text" name="idpost" value="{{$post->id}}" hidden>
                        <input class="form-control" type="text" name="comment" ><button type="submit"  class="btn btn-success" style="margin:0px 0px 0px 15px; ">Comentar</button>   
                    </div>
                </form>
                
                </div>
            </div>
        </div>
        <br>
       
        <div class="row justify-content-center">
            <div class="col-md-8">
                @php
                $comments = $post->comments()->get();
                @endphp
            
                @foreach($comments->sortBy('id',SORT_REGULAR, true) as $comment) 
                    <hr>
                    <h6>{{$comment->comment}}</h6>
                    

                    @foreach($comment->user()->get() as $user)
                
                <?php 
                    if($comment->user_id==Auth::user()->id){
                        echo"Creado por ti";
                    } else {
                        echo"Creado por ".$user->username;
                    }
                ?>
                @if((Auth::user()->id==$comment->user_id))
                <form action="{{ route('comment.destroy',$comment)}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
                @endif
                @endforeach
                @endforeach
                
            </div>
        </div>
    </div>
    </div>
</div>

@endsection
