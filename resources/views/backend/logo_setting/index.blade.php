@extends('backend.layouts.app')

@section('title', 'Radio CMS' . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Logo Settings <small class="text-muted">Logo</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="                                    @lang('labels.general.toolbar_btn_groups')">
                    <a href="{{ route('admin.logo_setting.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
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
                            <th>Key</th>                         
                            <th>Status</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logo_settings as $logo_setting)
                            <tr>
                                <td>{{ $logo_setting->id }}</td>
                                <td style="background-color:grey" align="center"> <img src="{{ asset('upload/Logo_Images/289_56_'.$logo_setting->logo_image) }}" height="70px" width="200px"></td>
                                
                                <td>{!! $logo_setting->key !!}</td>
                                <td>@if($logo_setting->status == 1)
                                        <span class="badge badge-success">Publish</span>
                                    @else
                                        <span class="badge badge-danger">Unpublish</span>
                                    @endif
                                </td>
                               
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="User Actions">
                                      <a href="{{ url('admin/logo_setting/edit/'.$logo_setting->id) }}" class="btn btn-primary"><i class="fas fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>
                                      <a href="{{ url('admin/logo_setting/delete/'.$logo_setting->id) }}"
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
                    {!! count($logo_settings) !!} {{ trans_choice('Logo Settings Total', count($logo_settings)) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $logo_settings->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

