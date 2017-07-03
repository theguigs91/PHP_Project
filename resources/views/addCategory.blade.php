@extends('template')

@section('contenu')
    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">Ajouter une catégorie au projet <b>{{$project->name}}</b></div>
            <div class="panel-body">
                {!! Form::open(['url' => 'category/add']) !!}
                <div class="form-group {!! $errors->has('name') ? 'has-error' : '' !!}">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nom de la catégorie']) !!}
                    {!! $errors->first('name', '<small class="help-block">:message</small>') !!}
                </div>
                {{ Form::hidden('project', $project->id) }}
                {!! Form::submit('Ajouter', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
