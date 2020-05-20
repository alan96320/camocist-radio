@extends('backend.layouts.app')

@section('title', 'Camokakis Music Stations' . ' | ' . __('strings.backend.dashboard.posts'). ' | Edit')

@section('pagestyles')
<style>
    .mce-notification,.bootstrap-datetimepicker-widget.dropdown-menu {
       display: none; 
    }
    .custom-file-label {
        height: 35px;
        line-height: 27px;
    }
    .custom-file-label:after {
        height: 33px !important;
        line-height: 26px;
    }
    .custom-file .invalid-feedback {
        margin-top: 20px; 
    }
</style>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('strings.backend.dashboard.posts') | Edit</strong>
                </div><!--card-header-->
                <div class="card-body">
                    <form method="post" action="{{route('admin.posts.update', $post->id)}}" enctype="multipart/form-data">
                        @csrf
                        <input name="_method" type="hidden" value="PUT">
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') ?? $post->title }}" required placeholder="Title">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description (Max 255 characters)') }}</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') ?? $post->description }}" required placeholder="Description">
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
                            <div class="col-md-6">
                                <textarea id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content">{{old('content') ?? $post->content}}</textarea>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                            <div class="col-md-6">
                                <select id="category_id" name="category_id" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" required>
                                  <option value="">Choose category</option>
                                  @foreach($categories as $category)
                                    <option {{($category->id == (old('category_id') ?? $post->category_id)) ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
                                  @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
							
                            <div class="col-md-6">
								
                                <div class="custom-file">
                                    <input name="image" type="file" class="custom-file-input {{ $errors->has('image') ? ' is-invalid' : '' }}" id="validatedCustomFile" >
                                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                    @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                                </div>
								<div class="my-2">
							@if ($post->image_url)
									@if($post->video && strpos($post->image_url,'img.youtube.com/vi'))
							<img src="{{$post->image_url}}" width="170" height="170">
							<span>youtube image</span>			
									@else
								<div id="targetLayer">
	<img src="{{asset('images/posts').'/'.$post->image_url}}" width="170" height="170">
									<a href="javascript:void(0)" onclick="deleteimage('{{$post->id}}')">delete</a>
									</div>
									<script>
function deleteimage(id){
	$.ajax({
		headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
		url: "../../posts/deleteimage",
		type: "POST",
		data:  {'id':id},
		success: function(data){
			if(data.status==true){
			$("#targetLayer").html('<div class="no-image">No Image</div>');
			}
		},
		error: function(){} 	        
	});
}
</script>
									@endif
    @else
            <p>No image found</p>
    @endif</div>

                            </div>
							
                        </div>
						
						  <div class="form-group row">
                            <label for="video" class="col-md-4 col-form-label text-md-right">{{ __('Video') }}</label>
                            <div class="col-md-6">
                                <input id="video" type="text" class="form-control{{ $errors->has('video') ? ' is-invalid' : '' }}" name="video" value="{{ old('video') ?? $post->video }}" placeholder="Embedded Video Link">
                                @if ($errors->has('video'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('video') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
                        <div class="form-group row">
                            <label for="date'" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>
                            <div class="col-md-6">
                                <div class='input-group date'>
                                    <input id="date" type="text" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') ?? $post->date}}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Choose as featured') }}</label>
                            <div class="col-md-6">
                                <div class="form-check">
                                  <input class="form-check-input" name="featured" type="checkbox" value="Check" {{(count($errors) > 0 && old('featured') || $post->featured == 1) ? 'checked' : ''}} id="featured-checkbox">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit post') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection

@section('pagescripts')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>

    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    
    tinymce.init({
        selector:'textarea#content',
        entity_encoding : "raw",
        extended_valid_elements : "iframe[src|frameborder|style|scrolling|class|width|height|name|align]",
        menubar: false,
        image_uploadtab: true,
        image_title: true,
        automatic_uploads: true,
        images_upload_url: '/admin/posts/upload',

        plugins: [
            'code','image','advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks fullscreen',
            'contextmenu paste code wordcount'
          ],
        toolbar: 'undo redo | image | formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link | code'
    });
</script>
@endsection
