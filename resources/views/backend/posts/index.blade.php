@extends('backend.layouts.app')

@section('title', 'Camokakis Music Stations' . ' | ' . __('strings.backend.dashboard.posts'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('strings.backend.dashboard.posts')</strong>
                </div><!--card-header-->
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong>Success!</strong> {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          <strong>Error!</strong> {{ session('error') }}
                        </div>
                    @endif
                    @if(count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible">
                            <ul class="mb-0 pl-0">
                                @foreach ($errors->all() as $error)
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                 <strong>{{$error}}</strong><br>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <br>
                    <form class="form-inline" action="{{route('admin.update-filters')}}" method="POST">
                        @csrf
                        @foreach($filters as $filter)
                        <div class="form-check m-2 mt-0">
                            <input type="checkbox" name="{{$filter->id}}" class="form-check-input" id="filter{{$filter}}" {{($filter->active == 1) ? 'checked' : ''}}>
                            <label class="form-check-label" for="filter{{$filter->name}}">{{$filter->name}}</label>
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary mb-2 ml-4">
                            {{ __('Update Filters') }}
                        </button>
                    </form>
                    <br>
                    <a href="{{url('/admin/posts/create')}}" class="btn btn-info">Add post</a>
                    <br><br>
                    <table id="postsTable" class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Featured</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td><a href="/admin/posts/{{$post->id}}/edit">{{$post->title}}</a></td>
                            <td>{{$post->description}}</td>
                            <td>{{$post->featured == 1 ? "Yes" : "No"}}</td>
                            <td>{{$post->category->name ?? ''}}</td>
                            <td>{{$post->getFormattedDate($post->date)}}</td>
                            <td><a href="/admin/posts/{{$post->id}}" class="btn btn-xs btn-danger deletebtn"><i class="fa fa-times"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
    <form id="delete-post-form" action="" method="POST" class="d-none">
        <input name="_method" type="hidden" value="DELETE">
        @csrf
    </form>
@endsection

@section('pagescripts')

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#postsTable').DataTable();

    $('.deletebtn').on('click', function(e){
        e.preventDefault();
        if(!confirm("Are you sure? The post will be deleted!")){
            return false;
        }
        var deletedPostHref = $(this).attr('href');
        $('#delete-post-form').attr('action', deletedPostHref);
        $('#delete-post-form').submit();
    });
} );
</script>
@endsection
