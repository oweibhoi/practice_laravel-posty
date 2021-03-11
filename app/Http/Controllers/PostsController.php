<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\storage;
use App\Post;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=> ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts=Post::all(); get all record
        $posts = Post::orderby('created_at','desc')->paginate(15);
       // return Post::where('title','Post Two')->get(); get the specific record
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_photo'=>'file|nullable|max:1999'
        ]);

        if($request->hasFile('cover_photo')){
            //get filename with extension
            $filenameWithExt = $request->file('cover_photo')->getClientOriginalName();
            // get filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            // get extension
            $extension = $request->file('cover_photo')->getClientOriginalExtension();
            // full filename
            $filenametoStore = $filename.'_'.time().'.'.$extension;
            // upload file
            $path = $request->file('cover_photo')->storeAs('public/cover_photos',$filenametoStore);
        }
        else{
            $filenametoStore='noimage.jpg';
        }

        //create post
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
        $post->cover_photo = $filenametoStore;
        $post->save();

        return redirect('posts')->with('success','Created Post Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts= Post::find($id);

        if(!auth()->guest()){
            if(auth()->user()->id !== $posts->user_id){
             return redirect('/posts')->with('error','Unathorized Page');
            }
        }

        return view('posts.show')->with('posts',$posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts= Post::find($id);

        if(!auth()->guest()){
            if(auth()->user()->id !== $posts->user_id){
             return redirect('/posts')->with('error','Unathorized Page');
            }
        }

        return view('posts.edit')->with('posts',$posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $this->validate($request,[
            'title'=>'required',
            'body'=>'required'
        ]);

           if($request->hasFile('cover_photo')){
            //get filename with extension
            $filenameWithExt = $request->file('cover_photo')->getClientOriginalName();
            // get filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            // get extension
            $extension = $request->file('cover_photo')->getClientOriginalExtension();
            // full filename
            $filenametoStore = $filename.'_'.time().'.'.$extension;
            // upload file
            $path = $request->file('cover_photo')->storeAs('public/cover_photos',$filenametoStore);
        }
       
        //create post
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        if($request->hasFile('cover_photo')){
            $post->cover_photo = $filenametoStore;
        }
         if(!auth()->guest()){
            if(auth()->user()->id !== $post->user_id){
             return redirect('/posts')->with('error','Unathorized Page');
            }
        }

        $post->save();

        return redirect('posts')->with('success','Update Post Successfully!');
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

         if(!auth()->guest()){
            if(auth()->user()->id !== $post->user_id){
             return redirect('/posts')->with('error','Unathorized Page');
            }
        }

        $post->delete();

        If($post->cover_photo != 'noimage.jpg'){
            storage::delete('public/cover_photos/'.$post->cover_photo);
        }

        return redirect('posts')->with('success','Post Deleted Successfully!');
    }

    
}
