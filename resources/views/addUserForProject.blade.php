@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s6 offset-s3">
                <div class="panel">
                    <div class="panel-heading add">Ajouter un utilisteur à {{$project->name}}</div>
                    <div class="panel-body">
                        {!! Form::open(['url' => 'projects/addUser/'.$project->id]) !!}
                        <div class="input-field {!! $errors->has('userEmail') ? 'has-error' : '' !!}">
                            {!! Form::text('userEmail', null, ['class' => 'validate', 'placeholder' => 'Email de l\'utilisateur à ajouter']) !!}
                            {!! $errors->first('userEmail', '<small class="help-block">:message</small>') !!}
                        </div>
                        <div class="row">
                            {!! Form::submit('Ajouter', ['class' => 'btn blue right']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
