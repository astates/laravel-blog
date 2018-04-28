@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              @if (count($posts) > 0)
                @if($user['isUser'])

                  <div class="card-header">These are your Blog Posts:</div>
                @else
                  <div class="card-header">These are {{ $user['name'] }}'s Blog Posts:</div>

                @endif

                <div class="card-body">
                  @foreach ($posts as $post)
                  <div>
                    <h3>{{ $post->post_title }}</h3>
                    <h6>{{ $post->created_at }} @if($user['isUser'])- <a href="/posts/{{ $post->id }}/edit">EDIT</a> | <a href="#">DELETE</a> @endif </h6>
                    <p>{{ $post->post_content }}</p>
                  </div>
                  <hr/>
                  @endforeach
                </div>
              @else
                <div class="card-header">You have yet to create any Blog Posts</div>

                <div class="card-body">
                  Click <a href="/posts/create">here</a> to create a new post!
                </div>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
