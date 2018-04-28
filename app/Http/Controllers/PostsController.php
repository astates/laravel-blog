<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Post;
use App\User;
use Session;
use Carbon\Carbon;
use Redirect;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Fetch data in pagination so only 10 posts per page
      // To get all data you may use get() method
      $posts = Post::with('user')->get();

      return view('pages.posts', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('pages.create-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      // Validate and filter user inputted data
        $this->validate($request, [
            'post_title'        => 'required',
            'post_slug'         => 'required|alpha_dash|max:200|unique:posts,post_slug',
            'post_content'      => 'required',
        ]);

        // Create a new Post Model initialization
        $post = new Post;

        $post->author_ID      = Auth::user()->id;
        $post->post_title     = $request->post_title;
        $post->post_slug      = $request->post_slug;
        $post->post_content   = $request->post_content;

        $post->save();

        // Store data for only a single request and destory
        Session::flash( 'sucess', 'Post published.' );

        // Redirect to `posts.show` route
        // Use route:list to view the `Action` or where this routes going to
        return redirect()->route('posts.show', Auth::user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $posts = Post::with('user')
      ->where( 'author_ID', $id )
      ->get();

      if($posts->isEmpty()) {
        return Redirect::back()->withErrors(['This User does not exist']);
      }

        $user = [];
      if( Auth::user()->id == $id ) {
        $user['isUser'] = true;
      }else {
        $user['isUser'] = false;
        $user['name'] = $posts[0]->user->name;
      }


        return view('pages.show', [ 'posts' => $posts, 'user' => $user ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::findOrFail( $id );

      if( Auth::user()->id != $post->author_ID ) {
        return Redirect::back()->withErrors(['You tried to access Something you shouldn\'t...']);
        //return redirect('/')->with('flash_message', 'You tried to access Something you shouldn\'t...');
      }
      return view('pages.edit-posts', [ 'post' => $post ]);
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
      $this->validate($request, [
          'post_title'        => 'required',
          'post_slug'         => 'required|alpha_dash|max:200|unique:posts,post_slug,'.$id,
          'post_content'      => 'required',
      ]);

      $post = Post::findOrFail($id);

      $post->post_title       = $request->input('post_title');
      $post->post_slug        = $request->input('post_slug');
      $post->post_content     = $request->input('post_content');

      $post->save();

      Session::flash('success', 'Post updated.');
        return view('pages.show', [ 'post' => $post ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::findOrFail( $id );

      $post->delete();

      Session::flash('success', 'Post deleted.');

      return redirect()->route('posts.index');
    }
}
