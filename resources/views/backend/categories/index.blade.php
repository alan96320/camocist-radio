@extends('backend.layouts.app')

@section('title', 'Camokakis Music Stations' . ' | ' . __('strings.backend.dashboard.categories'))

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('strings.backend.dashboard.categories')</strong>
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
                    <a href="{{url('/admin/categories/create')}}" class="btn btn-info">Add category</a>
                    <br><br>
                    <table id="categoriesTable" class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Color</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td><a href="/admin/categories/{{$category->id}}/edit">{{$category->name}}</a></td>
                            <td>{{ucfirst($category->type)}}</td>
                            <td style="background-color: {{$category->color}}"></td>
                            <td><a href="/admin/categories/{{$category->id}}" class="btn btn-xs btn-danger deletebtn"><i class="fa fa-times"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
    <form id="delete-category-form" action="" method="POST" class="d-none">
        <input name="_method" type="hidden" value="DELETE">
        @csrf
    </form>
@endsection

@section('pagescripts')

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#categoriesTable').DataTable();

    $('.deletebtn').on('click', function(e){
        e.preventDefault();
        if(!confirm("Are you sure? The category will be deleted!")){
            return false;
        }
        var deletedCategoryHref = $(this).attr('href');
        $('#delete-category-form').attr('action', deletedCategoryHref);
        $('#delete-category-form').submit();
    });
} );
</script>
@endsection
