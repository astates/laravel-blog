@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">Welcome!</div>
                <div class="card-body">
                    @guest
                    <p>Please sign in to create or edit your posts.</p>
                    @else
                    <p>Welcome {{ Auth::user()->name }},</p>
                    @endguest
                    <p>This is the homepage, please click <a href="/posts">here</a> to see all blog posts.</p>
                    <hr/>
                    <h5>REQUIREMENTS:</h5>
                    <ul>
                      <li>User can create an account.</li>
                      <li>User can login.</li>
                      <li>User can logout.</li>
                      <li>User can create a new blog post.</li>
                      <li>User can edit a blog post.</li>
                      <li>User can delete a blog post.</li>
                      <li>User can view all blog posts.</li>
                      <li>User can only edit, update & delete their own blog posts.</li>
                      <li>A user can click on another user’s profile link and see that user’s blog articles.</li>
                      <li>Use database migrations.</li>
                      <li>Use testing for each feature and model.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
