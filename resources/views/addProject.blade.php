@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s6 offset-s3">
                <div class="panel">
                    <div class="panel-heading add">Ajouter un projet</div>
                    <div class="panel-body">
                        {!! Form::open(['url' => 'projects/add']) !!}
                        <div class="input-field {!! $errors->has('name') ? 'has-error' : '' !!}">
                            {!! Form::text('name', null, ['class' => 'validate', 'placeholder' => 'Nom du projet']) !!}
                            {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
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
