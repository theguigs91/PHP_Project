@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-sm-6 col-lg-6">
        <ul class="collection with-header">
            <li class="collection-header">
                <h4>Tâches <span style="font-size: 1.64rem">--- Catégorie : {{$category->name}}</span>
                    <span class="right"><a href={{ route('addTaskSameProject', $category->id) }}>+</a></span>
                </h4>
            </li>
            @if(count($tasks) == 0)
                <div class="col s12">
                    <div class="row">
                        <img src="../../images/empty.png" class="empty">
                        <h4 class="center">Aucune tâche disponible pour cette catégorie</h4>
                    </div>

                    <div class="row">
                        <a href="{{ route('addTaskSameProject', $category->id) }}" class="waves-effect waves-light btn-large purple darken-4" id="addButton2"><i class="material-icons left">add</i>Ajouter une tâche<i class="material-icons right">add</i></a>
                    </div>
                </div>
            @else
                @foreach($tasks as $task)
                    <li class="collection-item">
                        <h4><b>{{ $task->description }}</b>
                            <span class="right">
                            {!! Form::open(array('route' => array('finishTask', $task->id, $task->category_id, 'method' => 'post'))) !!}
                                @if($task->finished)
                                    {!! Form::button('<i class="material-icons">done</i>', ['type' => 'submit', 'class' => 'btn-floating waves-effect waves-light']) !!}
                                @else
                                    {!! Form::button('<i class="material-icons">done</i>', ['type' => 'submit', 'class' => 'btn-floating waves-effect waves-light grey']) !!}
                                @endif
                                {!! Form::close() !!}
                        </span>
                        </h4>
                        <br>
                        <p>Echéance: {{$task->deadline}}
                            <span class="right">Priority:
                                @for($i = 0; $i < $task->priority; $i++)
                                    <i class="material-icons">star</i>
                                @endfor
                        </span>
                        </p>
                        <i class="material-icons">perm_identity</i>
                        @foreach($contributors as $contributor)
                            @if($contributor->id == $task->id)
                                <div class="chip">{{$contributor->name}}</div>
                            @endif
                        @endforeach
                        {{ Form::open(['route' => ['deleteTask', $task->id, $category->id], 'method' => 'delete', 'class' => 'right']) }}
                        <button type="submit" class="deleteBtn red-text">
                            <i class="material-icons">delete</i>
                        </button>
                        {{ Form::close() }}
                        <span class="right"><i class="material-icons"><a href={{route('editTask', $task->id)}}>mode_edit</a></i></span>
                    </li>
                @endforeach
            @endif

        </ul>
    </div>
</div>

@endsection