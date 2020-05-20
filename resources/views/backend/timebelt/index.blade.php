@extends('backend.layouts.app')

@section('title', 'Radio CMS' . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Timebelt Management <small class="text-muted">Active Timebelt</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="                                    @lang('labels.general.toolbar_btn_groups')">
                    <a href="{{ route('admin.timebelt.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
                </div><!--btn-toolbar-->

            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Days</th>
                            <th>Player Name</th>
                            <th>Active</th>
                            <th>Default Image</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($timebelts as $timebelt)
                            <tr>
                                <td>{{ $timebelt->id }}</td>
                                <td style="background-color:grey" align="center"> <img src="{{ asset('upload/timebelt/1200_800_'.$timebelt->banner_image) }}" height="70px" width="200px"></td>
                                <td>{{ $timebelt->start_time }}</td>
                                <td>{!! $timebelt->end_time !!}</td>
                                <td>{!! $timebelt->days !!}</td>
                                <td>{!! $timebelt->player_name !!}</td>
                                <td>@if($timebelt->is_active == 1)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </td>
                                <td>@if($timebelt->is_default == 1)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="User Actions">
                                      <a href="{{ url('admin/timebelt/edit/'.$timebelt->id) }}" class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                      <a href="{{ url('admin/timebelt/delete/'.$timebelt->id) }}"
                                 data-method="delete"
                                 data-trans-button-cancel="Cancel"
                                 data-trans-button-confirm="Delete"
                                 data-trans-title="Are you sure you want to do this?"
                                 class="btn btn-danger"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a> 
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! count($timebelts) !!} {{ trans_choice('Timebelts Total', count($timebelts)) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $timebelts->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

