@extends('layouts.piluku')

{{-- Web site Title --}}
@section('title')
@parent
Edit Profile
@stop

{{-- Content --}}
@section('content')

<!-- edit your profile -->
<div class="row" >
    <div class="col-md-12">
        <!-- panel -->
        <div class="panel panel-piluku panel-users">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {{trans('pages.actionedit')}} 
                    @if ($user->email == Sentry::getUser()->email)
                        {{trans('users.yours')}}
                    @else 
                        {{ $user->email }} 
                    @endif 
                    {{trans('pages.profile')}}
                    <span class="panel-options">
                        <a href="#" class="panel-refresh">
                            <i class="icon ti-reload"></i> 
                        </a>
                        <a href="#" class="panel-minimize">
                            <i class="icon ti-angle-up"></i> 
                        </a>
                        <a href="#" class="panel-close">
                            <i class="icon ti-close"></i> 
                        </a>
                    </span>
                </h3>
            </div>
            <div class="panel-body">
                <!--form-heading-->
                {{ Form::open(array(
                'action' => array('UserController@update', $user->id), 
                'method' => 'put',
                'class' => 'form form-horizontal', 
                'role' => 'form'
                )) }}
                
                    <div class="form-group {{ ($errors->has('firstName')) ? 'has-error' : '' }}" for="firstName">
                        {{ Form::label('edit_firstName', trans('users.fname'), array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                          {{ Form::text('firstName', $user->first_name, array('class' => 'form-control', 'placeholder' => trans('users.fname'), 'id' => 'edit_firstName'))}}
                        </div>
                        {{ ($errors->has('firstName') ? $errors->first('firstName') : '') }}                
                    </div>

                    <div class="form-group {{ ($errors->has('lastName')) ? 'has-error' : '' }}" for="lastName">
                        {{ Form::label('edit_lastName', trans('users.lname'), array('class' => 'col-sm-2 control-label')) }}
                        <div class="col-sm-10">
                          {{ Form::text('lastName', $user->last_name, array('class' => 'form-control', 'placeholder' => trans('users.lname'), 'id' => 'edit_lastName'))}}
                        </div>
                        {{ ($errors->has('lastName') ? $errors->first('lastName') : '') }}                
                    </div>

                    @if (Sentry::getUser()->hasAccess('admin'))
                    <div class="form-group">
                        {{ Form::label('edit_memberships', trans('users.group_membership'), array('class' => 'col-sm-2 control-label'))}}
                        <div class="col-sm-10">
                            <ul class="list-inline checkboxes-radio">
                                @foreach ($allGroups as $group)
                                    <li>
                                        <input type="checkbox" id="cgroups[{{ $group->id }}]" name="groups[{{ $group->id }}]" value='1' 
                                        {{ (in_array($group->name, $userGroups) ? 'checked="checked"' : '') }} />
                                        <label for="cgroups[{{ $group->id }}]"><span></span>{{ $group->name }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            {{ Form::hidden('id', $user->id) }}
                            {{ Form::submit(trans('pages.actionedit'), array('class' => 'btn btn-primary'))}}
                        </div>
                    </div>
                {{ Form::close()}}
            </div>
        </div>
        <!-- /panel -->
    </div>
</div>


<!-- change password -->
<div class="row" >
    <div class="col-md-12">
        <!-- panel -->
        <div class="panel panel-piluku panel-users">
            <div class="panel-heading">
                <h3 class="panel-title">
                    {{trans('users.change_passwort')}}
                    <span class="panel-options">
                        <a href="#" class="panel-refresh">
                            <i class="icon ti-reload"></i> 
                        </a>
                        <a href="#" class="panel-minimize">
                            <i class="icon ti-angle-up"></i> 
                        </a>
                        <a href="#" class="panel-close">
                            <i class="icon ti-close"></i> 
                        </a>
                    </span>
                </h3>
            </div>
            <div class="panel-body">
                <!--form-heading-->
                {{ Form::open(array(
                'action' => array('UserController@change', $user->id), 
                'class' => 'form form-inline', 
                'role' => 'form'
                )) }}
                
                    <div class="form-group {{ $errors->has('newPassword') ? 'has-error' : '' }}">
                        {{ Form::label('newPassword', trans('users.newpassword_lbl'), array('class' => 'sr-only')) }}
                        {{ Form::password('newPassword', array('class' => 'form-control', 'placeholder' => trans('users.newpassword_lbl'))) }}
                    </div>

                    <div class="form-group {{ $errors->has('newPassword_confirmation') ? 'has-error' : '' }}">
                        {{ Form::label('newPassword_confirmation', trans('users.newcompassword_lbl'), array('class' => 'sr-only')) }}
                        {{ Form::password('newPassword_confirmation', array('class' => 'form-control', 'placeholder' => trans('users.newcompassword_lbl'))) }}
                    </div>

                    {{ Form::submit(trans('users.change_passwort'), array('class' => 'btn btn-primary'))}}
                        
                    {{ ($errors->has('oldPassword') ? '<br />' . $errors->first('oldPassword') : '') }}
                    {{ ($errors->has('newPassword') ?  '<br />' . $errors->first('newPassword') : '') }}
                    {{ ($errors->has('newPassword_confirmation') ? '<br />' . $errors->first('newPassword_confirmation') : '') }}

                {{ Form::close() }}
            </div>
        </div>
        <!-- /panel -->
    </div>
</div>


@stop