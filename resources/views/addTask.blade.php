@extends('template')

@section('contenu')
<script>
    $( document ).ready(function() {
        $('.datepicker').pickadate({
            format: 'mm-dd-yyyy',
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
        });
    });
    $(document).ready(function() {
        $('select').material_select();
        $(".caret").hide()
    });
</script>

    <br>
    <div class="col-sm-offset-3 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">Ajouter une tâche à <b>{{ $project }}</b></div>
            <div class="panel-body">
                {!! Form::open(['url' => 'tasks/add']) !!}
                <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                    <label>Description de la tâche</label>
                    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Entrer sa description']) !!}
                    {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('category') ? 'has-error' : '' !!}">
                    <label>Catégorie</label>
                    <select name="category">
                        <option value="" selected>Aucune catégorie</option>
                        @foreach($categories as $category)
                            <option value={{$category->id}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('category', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('deadline') ? 'has-error' : '' !!}">
                    <label>Date d'échéance</label>
                    <input name="deadline" type="date" class="datepicker form-control" placeholder="Choisir une date">
                    {!! $errors->first('deadline', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('priority') ? 'has-error' : '' !!}">
                    <label>Priorité de la tâche</label>
                    <select name="priority">
                        <option value=0 selected>0</option>
                        <option value=1>1</option>
                        <option value=2>2</option>
                        <option value=3>3</option>
                    </select>
                    {!! $errors->first('priority', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('contributors') ? 'has-error' : '' !!}">
                    <label>Assigner la tâche à:</label>
                    <select multiple name="contributors[]">
                        <option value="" disabled selected>Personne</option>
                        @foreach($contributors as $contributor)
                            <option value={{$contributor->id}}>{{$contributor->name}}</option>
                        @endforeach
                    </select>
                </div>
                {!! Form::submit('Ajouter', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection