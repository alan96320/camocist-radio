@extends('backend.layouts.app')

@section('title', __('Timebelt Management') . ' | ' . __('labels.backend.access.roles.create'))

@section('content')
    

{{ html()->form('POST', route('admin.timebelt.store'))->class('form-horizontal')->attribute('enctype','multipart/form-data')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Timebelt Management 
                        <small class="text-muted">Create Timebelt</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        {{ html()->label('Start Time')
                            ->class('col-md-2 form-control-label')
                            ->for('start_time') }}

                        <div class="col-md-10">
                           
                            <div class='input-group date' id='datetimepicker'>
                                <input type='text' class="form-control" name="start_time" />
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
                           <!-- {{ html()->text('end_time')
                                ->class('form-control')
                                ->placeholder('End Time')
                                ->required() }}-->

                            <div class='input-group date' id='datetimepicker_end'>
                                <input type='text' class="form-control" name="end_time" />
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
                                    <option value="883JIA">883JIA</option>
                                    <option value="883JIA WEBHITS">883JIA WEBHITS</option>     
                                    <option value="883JIA KPOP">883JIA KPOP</option>
                                    <option value="POWER98">POWER98 RAW</option>
                                    <option value="POWER98 HITS">POWER98 HITS</option>
                                    <option value="POWER98 LOVE SONGS">POWER98 LOVE SONGS</option>                             
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
                                <select multiple id="select_days"  class="form-control" name="days[]">
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
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
                            <input type="file" name="banner_image" required>
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
                            <div class="checkbox d-flex align-items-center">
                                <input type="radio" class="radio-inline" name="is_active" value="1">Yes
                                <input type="radio" class="radio-inline" name="is_active" value="0">No                           
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
                            <div class="checkbox d-flex align-items-center">
                                <input type="radio" class="radio-inline" name="is_default" value="1">Yes
                                <input type="radio" class="radio-inline" name="is_default" value="0">No                           
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
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection
