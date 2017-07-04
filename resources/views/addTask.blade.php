@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s6 offset-s3">
                <div class="panel">
                    <div class="panel-heading add">Ajouter une tâche à <b>{{ $project }}</b></div>
                    <div class="panel-body">
                        {!! Form::open(['url' => 'tasks/add']) !!}
                        <div class="row">
                            <div class="input-field {!! $errors->has('description') ? 'has-error' : '' !!}">
                                <label>Description de la tâche</label>
                                {!! Form::text('description', null, ['class' => 'validate', 'placeholder' => 'Entrer sa description']) !!}
                                {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>


                        <div class="row">
                            <div class="input-field {!! $errors->has('category') ? 'has-error' : '' !!}">
                                {{--<select name="category">
                                    <option value="-1" disabled selected>Aucune catégorie</option>
                                    @foreach($categories as $category)
                                        <option value={{$category->id}}>{{$category->name}}</option>
                                    @endforeach
                                </select>--}}

                                {{ Form::select('category', $list, $item_selected->id, ['placeholder' => 'Sélectionner une catégorie...']) }}
                                <label>Catégorie</label>
                                {!! $errors->first('category', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>


                        <div class="row">
                            <div class="input-field {!! $errors->has('deadline') ? 'has-error' : '' !!}">
                                {{ Form::date('deadline', null, ['placeholder' => 'Choisir une date d\'échéance', 'class' => 'datepicker']) }}
                                <label>Date d'échéance</label>
                                {!! $errors->first('deadline', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>


                        <div class="row">
                            <div class="input-field {!! $errors->has('priority') ? 'has-error' : '' !!}">
                                <select name="priority">
                                    <option value=1 selected>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                </select>
                                <label>Priorité de la tâche</label>
                                {!! $errors->first('priority', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>


                        <div class="row">
                            <div class="input-field {!! $errors->has('contributors') ? 'has-error' : '' !!}">
                                <select multiple name="contributors[]">
                                    <option value="" disabled selected>Choisir les acteurs</option>
                                    @foreach($contributors as $contributor)
                                        <option value={{$contributor->id}}>{{$contributor->name}}</option>
                                    @endforeach
                                </select>
                                <label>Assigner la tâche à:</label>
                            </div>
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