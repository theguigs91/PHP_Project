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
            <div class="panel-heading">Modifier la tâche</div>
            <div class="panel-body">
                {!! Form::open(array('url' => 'tasks/edit/'.$task->id, 'method' => 'post')) !!}
                <div class="form-group {!! $errors->has('description') ? 'has-error' : '' !!}">
                    <label>Description de la tâche</label>
                    {!! Form::text('description', $task->description, ['class' => 'form-control', 'placeholder' => 'Entrer sa description']) !!}
                    {!! $errors->first('description', '<small class="help-block">:message</small>') !!}
                </div>
                <div class="form-group {!! $errors->has('category') ? 'has-error' : '' !!}">
                    <label>Catégorie</label>
                    <select name="category">
                        <option value="" selected>Aucune catégorie</option>
                        @foreach($categories_project as $category)
                            <option value={{$category->id}} @if($task->category_id == $category->id) selected @endif >{{$category->name}}</option>
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
                        @for($i = 0; $i < 4; $i++)
                            <option value={{$i}} @if($task->priority == $i) selected @endif>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group {!! $errors->has('contributors') ? 'has-error' : '' !!}">
                    <div class="col-sm-2"><label>Assigner la tâche à:</label></div>
                    <div class="col-sm-6">
                    @foreach($contributors_project as $contributor)
                        <p><input type="checkbox" id={{ $contributor->id }} name="contributors[]" value="{{$contributor->id}}" @if(in_array($contributor->id, $contributors_task)) checked="checked"@endif class="filled-in form-control"/>
                            <label for={{$contributor->id}}>{{$contributor->name}}</label>
                        </p>
                    @endforeach
                    </div>
                </div>
                {!! Form::submit('Valider', ['class' => 'btn btn-info pull-left']) !!}
                {!! Form::close() !!}

                {{ Form::open(['route' => ['deleteTask', $task->id], 'method' => 'delete']) }}
                    <button type="submit" class="btn red pull-right">Supprimer</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection