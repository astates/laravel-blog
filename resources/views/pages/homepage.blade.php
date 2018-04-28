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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
