@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><a href="/edit-posts" class="button">Edit Existing Blog Posts</a></div>

                <div class="card-body">
                  <form action="{{ route('posts.store') }}" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="author_ID" value="{{ Auth::id() }}" />

						<div class="form-group{{ $errors->has('post_title') ? ' has-error' : '' }}">
							<label for="post_title">Title</label> <br/>
							<input type="text" name="post_title" id="post_title" value="{{ old('post_title') }}" />

							@if ($errors->has('post_title'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('post_title') }}</strong>
	                            </span>
	                        @endif
						</div>

						<div class="form-group{{ $errors->has('post_slug') ? ' has-error' : '' }}">
							<label for="post_slug">Slug</label> <br/>
							<input type="text" name="post_slug" id="post_slug" value="{{ old('post_slug') }}" />

							@if ($errors->has('post_slug'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('post_slug') }}</strong>
	                            </span>
	                        @endif
						</div>

						<div class="form-group{{ $errors->has('post_content') ? ' has-error' : '' }}">
							<label for="post_content">Content</label> <br/>
							<textarea name="post_content" id="post_content" cols="80" rows="6">{{ old('post_content') }}</textarea>

							@if ($errors->has('post_content'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('post_content') }}</strong>
	                            </span>
	                        @endif
						</div>

						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="Publish" />
							<a class="btn btn-primary" href="{{ route('posts.index') }}">Cancel</a>
						</div>
					</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
