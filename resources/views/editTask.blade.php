@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col s6 offset-s3">
                <div class="panel">
                    <div class="panel-heading update">Modifier la tâche</div>
                    <div class="panel-body">
                        {!! Form::open(array('url' => 'tasks/edit/'.$task->id, 'method' => 'post')) !!}

                        <div class="row">
                            <div class="input-field {!! $errors->has('description') ? 'has-error' : '' !!}">
                                {!! Form::text('description', $task->description, ['class' => 'validate', 'placeholder' => 'Entrer sa description']) !!}
                                <label>Description de la tâche</label>

                                {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field {!! $errors->has('category') ? 'has-error' : '' !!}">
                                {{ Form::select('category', $listCategory, $item_selected, ['placeholder' => 'Sélectionner une catégorie...']) }}
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
                                    @for($i = 1; $i < 4; $i++)
                                        <option value={{$i}} @if($task->priority == $i) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                                <label>Priorité de la tâche</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field {!! $errors->has('contributors') ? 'has-error' : '' !!}">
                                <select multiple name="contributors[]">
                                    <option value="" disabled>Choisir les acteurs</option>
                                    @foreach($contributors_project as $contributor)
                                        @if(in_array($contributor->id, $contributors_task))
                                            <option value={{$contributor->id}} selected>{{$contributor->name}}</option>
                                        @else
                                            <option value={{$contributor->id}}>{{$contributor->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label>Assigner la tâche à :</label>
                            </div>
                        </div>

                        <div class="row">
                            {!! Form::submit('Modifier', ['class' => 'btn btn-form orange right']) !!}
                            {{ Form::open(['route' => ['deleteTask', $task->id, $item_selected], 'method' => 'delete']) }}
                                <button type="submit" class="btn red right">Supprimer</button>
                            {{ Form::close() }}
                        </div>
                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection