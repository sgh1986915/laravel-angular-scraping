@extends('layouts.logged_out')

{{-- Web site Title --}}
@section('title')
{{trans('pages.login')}}
@stop

{{-- Content --}}
@section('content')

    <div class="flip-container">
        <div class="flipper">
            <div class="front">
                <!-- front content -->
                <div class="holder">
                {{ Form::open(['action' => 'SessionController@store', 'class' => 'form-horiz']) }} 

                    <h1 class="heading">{{trans('pages.login')}}</h1>    

                    {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => trans('users.email'), 'autofocus')) }}
                    {{ ($errors->has('email') ? $errors->first('email') : '') }}
                    
                    {{ Form::password('password', array('class' => 'form-control', 'placeholder' => trans('users.pword')))}}
                    {{ ($errors->has('password') ?  $errors->first('password') : '') }}

                    <div class="bottom_info">                        
                        <!-- <a class="pull-right" href="{{ route('forgotPasswordForm') }}">{{trans('users.forgot')}}?</a> -->
                        <a href="#" class="pull-right" data-toggle="modal" data-target="#forgot">forgot password?</a>
                        
                        <!-- <div class="form-group check-radio">
                            <input type="checkbox" aid="c1a" class="form-control" name="rememberMe"/>
                            <label for="c1a"><span></span>{{ trans('users.remember') }}?</label>
                        </div> -->
                        <!-- {{ Form::checkbox('rememberMe', 'rememberMe', ['class' => 'checkbox']) }} {{trans('users.remember')}}? -->
                        <!-- <div class="checkbox pull-left">
                            <label>
                                {{ Form::checkbox('rememberMe', 'rememberMe', ['class' => 'checkbox']) }} {{trans('users.remember')}}?
                            </label>
                        </div> -->
                    </div>      

                    <div class="clearfix"></div>    

                    <button type="submit" class="btn btn-primary btn-block">{{ trans('pages.login') }}</button> 

                {{ Form::close() }}                   
                </div>
            </div>          
        </div>      
    </div>

    
    <!-- Modal -->
    <div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="">
        <div class="modal-dialog">
            <div class="modal-content">
            {{ Form::open(array('action' => 'UserController@forgot', 'method' => 'post')) }}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="ion-android-settings"></i> Reset password</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <!-- <input type="text" class="form-control" placeholder="Enter Email here"> -->
                        {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => trans('users.email'), 'autofocus')) }}
                        {{ ($errors->has('email') ? $errors->first('email') : '') }}
                        <h6 class="note"><i class="ion-android-mail"></i> password will be sent to your email</h6>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-red" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ trans('users.resendpword') }}</button>
                    
                </div>
            {{ Form::close() }}
            </div>
        </div>
    </div>



@stop