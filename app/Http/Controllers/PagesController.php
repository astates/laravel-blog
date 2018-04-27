<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    /**
    * Instantiate a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
      // If the user is not logged in, redirect them to the login/register page
      $this->middleware('auth');
    }

    /**
    * Home Page
    */
    public function getIndex() {
      return view('pages.index');
    }

    /**
    * Posts Page
    */
    public function getPosts() {
      return view('pages.posts');
    }

    /**
    * Backend Edit Posts Page
    */
    public function getEditPosts() {
      return view('pages.edit-posts');
    }

    /**
    * Backend Create Posts Page
    */
    public function getCreatePost() {
      return view('pages.create-post');
    }
}
