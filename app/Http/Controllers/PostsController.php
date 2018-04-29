<?php
namespace App\Http\Controllers;

use Auth;
use Session;
use Redirect;
use App\Post;
use App\User;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * Display all posts
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Return all post data and user data related to each post
      $posts = Post::with('user')->get();

      return view('pages.posts', ['posts' => $posts]);
    }

    /**
     * Method for creating new post
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // Send user back with a note that they shouldn't be there if they arent logged in
      if( !Auth::check() ) {
        return Redirect::back()->withErrors(['You are not logged in and cannot access this.']);
      }
      return view('pages.create-post');
    }

    /**
     * Store new posts
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // Send user back with a note that they shouldn't be there if they arent logged in
      if( !Auth::check() ) {
        return Redirect::back()->withErrors(['You are not logged in and cannot access this.']);
      }

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

      // Redirect to page with all of this users post's
      return redirect()->route('posts.show', Auth::user()->id);
    }

    /**
     * Show all posts for this user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = [];
      $userId = '';
      $posts = '';

      // Determine if user is logged in, assign value to variable
      if(Auth::check())
      {
        $userId = Auth::user()->id;
      } else {
        $userId = '';
      }

      // Fetch all of this user's posts data
      $posts = Post::with('user')
      ->where( 'author_ID', $id )
      ->get();

      if($posts->isEmpty()) {
        return Redirect::back()->withErrors(['This User does not exist, or they have not created any posts yet.']);
      }

      // If user is logged in and requesting their posts, set variable so
      // they can edit post on that view.
      if($userId == $id ) {
        $user['isUser'] = true;
      }else {
        $user['isUser'] = false;
        $user['name'] = $posts[0]->user->name;
      }

      return view('pages.show', [ 'posts' => $posts, 'user' => $user ]);
    }

    /**
     * Method for editing existing post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::findOrFail( $id );

      if( Auth::user()->id != $post->author_ID ) {
        return Redirect::back()->withErrors(['You\'re not allowed to edit someone elses post.']);
      }

      return view('pages.edit-posts', [ 'post' => $post ]);
    }

    /**
     * Update post from edit method
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

      $post->post_title   = $request->input('post_title');
      $post->post_slug    = $request->input('post_slug');
      $post->post_content = $request->input('post_content');

      $post->save();

      return view('pages.show', [ 'post' => $post ]);
    }

    /**
     * Delete post method and redirect back to users posts
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::findOrFail( $id );

      $post->delete();

      return redirect()->route('posts.show', Auth::user()->id);
    }
}
