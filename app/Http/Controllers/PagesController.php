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
    public function getHomePage() {
      return view('pages.homepage');
    }

    
}
