@extends('backend.layouts.app')

@section('title', 'Camokakis Music Stations' . ' | ' . __('strings.backend.dashboard.news'))

@section('pagestyles')
<style>
    .informBlock {
      display:none;
      position: fixed;
      z-index: 1000;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      padding-top: 200px;
      background: rgba( 255, 255, 255, .8 );
    }
    .informBlock .icon-spinner {
      font-size: 80px;
      text-align: center;
      animation: spin 2s linear infinite;
      display: block;
    }
    .informMessage {
      font-size: 30px;
      text-align: center;
    }
    .successMessage {
      color: #009900;
    }

    .errorMessage {
      color: #cd201f;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>@lang('strings.backend.dashboard.news')</strong>
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
                    <form class="form-inline" action="{{route('admin.update-news-label')}}" method="POST">
                        @csrf
                        <div class="form-group mx-sm-3 mb-3">
                                <input name="label" type="text" class="form-control" value="{{$newsLabel->name ?? ''}}">
                        </div>
                        <button type="submit" class="btn btn-primary mb-3">
                            {{ __('Change Label') }}
                        </button>
                    </form>
                    <br><br>
                    <a href="{{url('/admin/news/create')}}" class="btn btn-info">Add news</a>
                    <a href="{{url('/admin/news/update-ordering')}}" class="update-ordering btn btn-success">Update news order</a>
                    <br><br>
                    
                    <table id="postsTable" class="table table-bordered table-hover">
                      <thead class="thead-dark">
                        <tr>
                          <th>Order</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($news as $singleNews)
                        <tr class="news-row">
                            <td class="ordering-row" dataid="{{$singleNews->id}}">{{$singleNews->ordering}}</td>
                            <td><a href="/admin/news/{{$singleNews->id}}/edit">{{$singleNews->title}}</a></td>
                            <td>{{$singleNews->category->name ?? ''}}</td>
                            <td>{{$singleNews->getFormattedDate($singleNews->date)}}</td>
                            <td><a href="/admin/news/{{$singleNews->id}}" class="btn btn-xs btn-danger deletebtn"><i class="fa fa-times"></i></a></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div><!--card-body-->
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
    <form id="delete-news-form" action="" method="POST" class="d-none">
        <input name="_method" type="hidden" value="DELETE">
        @csrf
    </form>
    <div class="informBlock">
        <i class="icon-reload icon-spinner" aria-hidden="true"></i>
        <p class="informMessage"></p>
    </div>
@endsection

@section('pagescripts')

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script> 
<script type="text/javascript">
$(document).ready(function() {

    $("tbody" ).sortable({
        stop: function( ) {
            for(let i = 0; i < $( "tbody .news-row" ).length; i++) {
                let currentRow = $( "tbody .news-row" )[i];
                $(currentRow).find('.ordering-row').text(i + 1);
            }
        }
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.update-ordering').on('click', function (e) {
        e.preventDefault();

        var newsData = [];
        $( "tbody .ordering-row" ).each(function () {
            let newsObj = {id: $(this).attr('dataid'), ordering: $(this).text()};
            newsData.push(newsObj);
        });

        var url = $(this).attr('href');
        $('.informBlock').fadeIn(300);
        $('.icon-spinner').fadeIn(100);
        var btn = $(this);
        var id = btn.data('pid');
        $.ajax({
            url: url,
            data: {newsData: newsData},
            type: "POST",
            dataType: 'json',
        }).done(function(data) {
            if(data.status == 'success'){
                var voteClass = 'successMessage';
            } else {
                var voteClass = 'errorMessage';
                $('.informMessage').addClass(voteClass)
            }
            $('.icon-spinner').fadeOut(100, function() {
                $('.informMessage').addClass(voteClass).fadeIn(500).text(data.message);
                $('.informBlock').delay(2000).fadeOut(2000);
                $('.informMessage').delay(2000).fadeOut(2000, function() {
                    $('.informMessage').removeClass(voteClass).text('');
                });
            });
        });
    });

    $('.deletebtn').on('click', function(e){
        e.preventDefault();
        if(!confirm("Are you sure? The news will be deleted!")){
            return false;
        }
        var deletedPostHref = $(this).attr('href');
        $('#delete-news-form').attr('action', deletedPostHref);
        $('#delete-news-form').submit();
    });
} );
</script>
@endsection

