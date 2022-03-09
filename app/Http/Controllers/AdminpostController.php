<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        /*if($user=Auth::user()){
            $posts=Post::where('user_id',$user->id)->get();
        } else {
            $posts=Post::all();
        }
        return view('posts',compact('posts'));*/
        //$user=Auth::user();
        //$posts=$user->posts;
        $posts=Post::all();
        return view('admin.index',compact('posts'));
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
       
       $validateData=$request->validate([
            'title' => 'string|unique:posts|max:90',
            'content' => 'string'

        ]);

        $validateData['user_id']=Auth::user()->id;
        //$validateData['category_id']='1';
        $validateData['contents']=$request->contents;

        Post::create($validateData);
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
        $validateData['title']=$request->title;
        $validateData['contents']=$request->contents;
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
