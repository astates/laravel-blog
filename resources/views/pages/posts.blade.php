@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Enjoy These Blog Posts:</div>
        <div class="card-body">

          @foreach( $posts as $post)
            Author: <a href="/posts/{{$post->user->id}}">{{ $post->user->name }}</a> <br />

            @if (Auth::check())
              @if( $post->author_ID == Auth::user()->id )
                <a href="/posts/{{ $post->id}}/edit">Edit this post</a><br />
              @endif
            @endif
            <h4>{{ $post->post_title }}</h4>
            <p>{{ $post->post_content }}</p>
            <hr /><br />
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
