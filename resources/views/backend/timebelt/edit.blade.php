@extends('backend.layouts.app')

@section('title', __('Timebelt Management') . ' | ' . __('labels.backend.access.roles.edit'))

@section('content')

	

{{ html()->modelForm($timebelt, 'PATCH', route('admin.timebelt.update', $timebelt))->attribute('enctype','multipart/form-data')->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Timebelt Management 
                        <small class="text-muted">Update Timebelt</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <!--row-->

            <hr/>

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                       {{ html()->label('Start Time')
                            ->class('col-md-2 form-control-label')
                            ->for('start_time') }}

                        <div class="col-md-10">
                            <div class='input-group date' id='datetimepicker_edit'>
                                <input type='text' class="form-control" name="start_time" value="{{ $timebelt->start_time }}" />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->                    
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label('End Time')
                            ->class('col-md-2 form-control-label')
                            ->for('end_time') }}

                        <div class="col-md-10">
                             <div class='input-group date' id='datetimepicker_end_edit'>
                                <input type='text' class="form-control" name="end_time" value="{{ $timebelt->end_time }}" />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->                    
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label('Select Player')
                            ->class('col-md-2 form-control-label')
                            ->for('player_name') }}

                        <div class="col-md-10">
                             <div class='input-group'>
                                <select class="form-control" name="player_name">
                                    <option value="883JIA" 
                                    @if($timebelt->player_name == '883JIA')
                                        selected
                                    @endif
                                    >883JIA</option>
                                     <option value="883JIA WEBHITS" 
                                    @if($timebelt->player_name == '883JIA WEBHITS')
                                        selected
                                    @endif
                                    >883JIA WEBHITS</option>
                                     <option value="883JIA KPOP" 
                                    @if($timebelt->player_name == '883JIA KPOP')
                                        selected
                                    @endif
                                    >883JIA KPOP</option>
                                    <option value="POWER98 RAW"
                                    @if($timebelt->player_name == 'POWER98 RAW')
                                        selected
                                    @endif
                                    >POWER98 RAW</option>
                                     <option value="POWER98 HITS" 
                                    @if($timebelt->player_name == 'POWER98 HITS')
                                        selected
                                    @endif
                                    >POWER98 HITS</option>
                                     <option value="POWER98 LOVE SONGS" 
                                    @if($timebelt->player_name == 'POWER98 LOVE SONGS')
                                        selected
                                    @endif
                                    >POWER98 LOVE SONGS</option>                                  
                                </select>
                            </div>
                            
                        </div><!--col-->
                    </div><!--form-group-->                    
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label('Select Days')
                            ->class('col-md-2 form-control-label')
                            ->for('end_time') }}

                        <div class="col-md-10">
                            <div class='input-group'>
                                <select multiple id="select_days" class="form-control" name="days[]">
                                    <option value="Monday"
                                    @if (in_array('Monday', $days_array)) 
                                        selected
                                    @endif
                                     >Monday</option>
                                    <option value="Tuesday" 
                                    @if (in_array('Tuesday', $days_array)) 
                                        selected
                                    @endif
                                    >Tuesday</option>
                                    <option value="Wednesday"
                                    @if (in_array('Wednesday', $days_array)) 
                                        selected
                                    @endif
                                    >Wednesday</option>
                                    <option value="Thursday"
                                    @if (in_array('Thursday', $days_array)) 
                                        selected
                                    @endif
                                    >Thursday</option>
                                    <option value="Friday"
                                    @if (in_array('Friday', $days_array)) 
                                        selected
                                    @endif
                                    >Friday</option>
                                    <option value="Saturday"
                                    @if (in_array('Saturday', $days_array)) 
                                        selected
                                    @endif
                                    >Saturday</option>
                                    <option value="Sunday"
                                    @if (in_array('Sunday', $days_array)) 
                                        selected
                                    @endif
                                    >Sunday</option>
                                </select>
                            </div>
                        </div><!--col-->
                    </div><!--form-group-->                    
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label('Banner Image')
                            ->class('col-md-2 form-control-label')
                            ->for('banner_image') }}

                        <div class="col-md-10">
                            <!--{{ html()->file('banner_image') 
                                ->required() }}-->
                            <input type="file" name="banner_image">
                            <img src="{{ asset('upload/timebelt/1200_800_'.$timebelt->banner_image) }}" style="background-color:grey" height="100px" width="250px">
                        </div><!--col-->
                    </div><!--form-group-->                    
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">

                    <div class="form-group row">
                        {{ html()->label('Is Active')
                            ->class('col-md-2 form-control-label')
                            ->for('is_active') }}

                        <div class="col-md-10">                            
                            <div class="form-group">
                            	<input type="radio" class="radio-inline" name="is_active" value="1"
                            	@if($timebelt->is_active === 1)
                            		checked
                            	@endif
                            	>Yes
                            	<input type="radio" class="radio-inline" name="is_active" value="0" 
                            	@if($timebelt->is_active === 0)
                            		checked
                            	@endif>No
                            </div>                              
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">

                    <div class="form-group row">
                        {{ html()->label('Is Default')
                            ->class('col-md-2 form-control-label')
                            ->for('is_default') }}

                        <div class="col-md-10">                            
                            <div class="form-group">
                            	<input type="radio" class="radio-inline" name="is_default" value="1"
                            	@if($timebelt->is_default === 1)
                            		checked
                            	@endif
                            	>Yes
                            	<input type="radio" class="radio-inline" name="is_default" value="0" 
                            	@if($timebelt->is_default === 0)
                            		checked
                            	@endif>No
                            </div>                              
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->

        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.timebelt'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
  