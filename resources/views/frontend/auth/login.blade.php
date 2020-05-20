@extends('frontend.layouts.app_login')

@section('title', 'Radio CMS' . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
            <div class="kt-login__container">
                <div class="kt-login__logo">
                    <a href="#">
                        <img src="img/frontend/Logo.png" class="img-responsive" height="40" />
                    </a>
                </div>
                <div class="kt-login__signin">
                    <div class="kt-login__head">
                        <h3 class="kt-login__title">Sign In To Radio CMS</h3>
                    </div>
                      {{ html()->form('POST', route('frontend.auth.login.post'))->open() }}
                        <div class="kt-form">
                            <div class="input-group">
                                {{ html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                            </div><!--form-group-->
                    
                            <div class="form-group">
                                 {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                            </div><!--form-group-->
                            <div class="row kt-login__extra">
                                <div class="col">
                                    <label class="kt-checkbox">
                                        {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            <!--<div class="row kt-login__extra" style="margin-top:6px">
                                <div class="col">
                                    <a href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</a>
                                </div>
                            </div>-->
                            <div class="kt-login__actions">
                            <button class="btn btn-brand btn-elevate kt-login__btn-primary kt_login_signin_submit" style="color: #fff;background-color: #5d78ff;border-color: #5d78ff;" type="submit">Login</button>
                            </div>
                        </div>
                    {{ html()->form()->close() }}
                </div>
				
@endsection
