<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\Post;
use App\User;

class AdminpostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$user=Auth::user();
        //$posts=$user->posts;
        $posts=Post::all();
        return view('admin.index',compact('posts'));
    }

    public function buscadorAdmin(Request $request)
    {

        $buscadorInput = $request->get('buscador');
        $posts = Post::where('title', 'like', "%{$buscadorInput}%")->get();
        return view('admin.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
            return redirect('/admin/posts');
        }
        return redirect('/admin/posts');

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
        return view('admin.edit',['post'=>$post]);
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
       
        $post->update($validateData);
        return redirect('/admin/posts');

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
