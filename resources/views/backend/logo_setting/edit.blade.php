@extends('backend.layouts.app')

@section('title', __('Logo Setting') . ' | ' . __('labels.backend.access.roles.edit'))

@section('content')

	

{{ html()->modelForm($logo_setting, 'PATCH', route('admin.logo_setting.update', $logo_setting))->attribute('enctype','multipart/form-data')->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Logo Setting
                        <small class="text-muted">Update Logo</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr/>

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label('Key')
                            ->class('col-md-2 form-control-label')
                            ->for('key') }}

                        <div class="col-md-10">                       
                            <input type='text' class="form-control" name="key" value="{{ $logo_setting->key }}" readonly/>
                        </div><!--col-->
                    </div><!--form-group-->
                    
                </div><!--col-->
            </div><!--row-->

           
            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label('Logo Image')
                            ->class('col-md-2 form-control-label')
                            ->for('logo_image') }}
                        <div class="col-md-10">
                            <input type="file" name="logo_image">
                            <img src="{{ asset('upload/Logo_Images/289_56_'.$logo_setting->logo_image) }}" style="background-color:grey" height="100px" width="300px">
                        </div><!--col-->
                    </div><!--form-group-->                    
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">

                    <div class="form-group row">
                        {{ html()->label('Status')
                            ->class('col-md-2 form-control-label')
                            ->for('status') }}

                        <div class="col-md-10">                            
                            <div class="checkbox d-flex align-items-center">
                                <input type="radio" class="radio-inline" name="status" value="1"
                                @if($logo_setting->status == 1)
                                    checked
                                @endif
                                >Publish
                                <input type="radio" class="radio-inline" name="status" value="0"
                                @if($logo_setting->status == 0)
                                    checked
                                @endif
                                >Unpublish                           
                            </div>                              
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.logo_setting'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
  