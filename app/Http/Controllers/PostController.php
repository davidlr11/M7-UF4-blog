<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\Post;
use App\User;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        /*if($user=Auth::user()){
            $posts=Post::where('user_id',$user->id)->get();
        } else {
            $posts=Post::all();
        }
        return view('posts',compact('posts'));*/
        $posts=Post::all();
        //ddd($posts);
        //$user=Auth::user();
        //$posts=$user->posts;

        return view('home',compact('posts'));
    }
    
    public function buscador(Request $request)
    {

        $buscadorInput = $request->get('buscador');
        $posts = Post::where('title', 'like', "%{$buscadorInput}%")->get();
        $posts = Post::where('contents', 'like', "%{$buscadorInput}%")->get();
        if($buscadorInput!=$posts){
            return redirect(404);
        }
        return view('home', compact('posts'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        /*if($user->can('create',Post::class)){
            Response::allow();
        } else {
            Response::deny('No se puede');
        }*/

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $user = Auth::user();
        $post = new Post();
        $post->title = $request->get('title');
        $post->contents = $request->get('contents');
        $post->user_id = $user->id;
        $post->save();

        if($request->get('tags')!=null){
            
            $tags=explode(',', $request->get('tags'));
            foreach($tags as $tag){
            $tagpost=Tag::create(['tag'=>$tag]);
            $post->tags()->attach($tagpost);
            
            }
        } else {
            return redirect('/');
        }
        return redirect('/');

        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $validateData=$request->validate([
            'title' => 'string|unique:posts|max:90',
            'contents' => 'string'
        ]);
        
        //$validateData['contents']=$request->contents;
        //$validateData['user_id']=Auth::user()->id;
        
        
        $post->update($validateData);
        return redirect('/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return back();    

    }

    
}
