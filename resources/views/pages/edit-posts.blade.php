@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Existing Blog Post</div>

                <div class="card-body">
                  <form action="{{ route('posts.update', $post->id) }}" method="POST">
						{{ csrf_field() }}

						{{--
							HTML forms do not support PUT, PATCH or DELETE actions.
							So, when defining PUT, PATCH or  DELETE routes that are called from an HTML form,
							you will need to add a hidden _method field to the form.
						--}}
						{{ method_field('PUT') }}


						<div class="form-group{{ $errors->has('post_title') ? ' has-error' : '' }}">
							<label for="post_title">Title</label> <br/>
							<input type="text" name="post_title" id="post_title" value="{{ $post->post_title }}" />

							@if ($errors->has('post_title'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('post_title') }}</strong>
	                            </span>
	                        @endif
						</div>

						<div class="form-group{{ $errors->has('post_slug') ? ' has-error' : '' }}">
							<label for="post_slug">Slug</label> <br/>
							<input type="text" name="post_slug" id="post_slug" value="{{ $post->post_slug }}" />

							@if ($errors->has('post_slug'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('post_slug') }}</strong>
	                            </span>
	                        @endif
						</div>

						<div class="form-group{{ $errors->has('post_content') ? ' has-error' : '' }}">
							<label for="post_content">Content</label> <br/>
							<textarea name="post_content" id="post_content" cols="80" rows="6">{{ $post->post_content }}</textarea>

							@if ($errors->has('post_content'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('post_content') }}</strong>
	                            </span>
	                        @endif
						</div>

						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="Update" />
							<a class="btn btn-primary" href="{{ route('posts.index') }}">Cancel</a>
						</div>
					</form>
          <form action="{{ route('posts.update', $post->id) }}" method="POST">
						{{ csrf_field() }}

						{{--
							HTML forms do not support PUT, PATCH or DELETE actions.
							So, when defining PUT, PATCH or  DELETE routes that are called from an HTML form,
							you will need to add a hidden _method field to the form.
						--}}
						{{ method_field('DELETE') }}
            <div class="form-group">
							<input type="submit" class="btn btn-alert" value="Delete" />
							<a class="btn btn-primary" href="{{ route('posts.destroy', $post->id) }}">Delete</a>
						</div>
          </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
