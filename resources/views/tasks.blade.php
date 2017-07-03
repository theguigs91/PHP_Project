@extends('template')

@section('contenu')
<h1> Toutes les tâches</h1>
<br>
<br>

<div class="col-sm-2">
<ul class="collection with-header">
    <li class="collection-header"><h4>Projets <span class="pull-right"><a href={{route('addProject')}}>+</a></span></h4></li>
    @foreach($projects as $project)
        <a href="{{url('tasks/project/'.$project->id)}}" class="collection-item {{ Request::is('*/project/'.$project->id) ? 'active' : ''}}">{{$project->name}}</a>
    @endforeach
</ul>
</div>
<div class="col-sm-3">
<ul class="collection with-header">
    <li class="collection-header"><h4>Catégories <span class="pull-right">
                @if(Request::is('tasks'))
                    <a href="#">+</a>
                @else
                    <a href={{ Request::is('*/project/*') ? route('addCategory', Request::segment(3)) : route('addCategorySameProject', Request::segment(3)) }}>+</a>
                @endif
            </span></h4>
    </li>
    @foreach($categories as $category)
        <div class="collection-item col-sm-12 {{ Request::is('*/category/'.$category->id) ? 'active' : ''}}">
            <div class="col-sm-10">
                <a href="{{url('tasks/category/'.$category->id)}}" class="pull-left ">{{$category->name}}</a>
            </div>
            <div class="col-sm-1">
                 {{ Form::open(['route' => ['deleteCategory', $category->id], 'method' => 'delete']) }}
                    <button type="submit"><i class="material-icons pull-right" type="submit">delete</i></button>
                 {{ Form::close() }}
            </div>
        </div>
    @endforeach
</ul>
</div>

<div class="col-sm-6 col-lg-6">
<ul class="collection with-header">
    <li class="collection-header"><h4>Tâches <span class="pull-right">
                 @if(Request::is('tasks'))
                    <a href="#">+</a>
                @else
                    <a href={{ Request::is('*/project/*') ? route('addTask', Request::segment(3)) : route('addTaskSameProject', Request::segment(3)) }}>+</a>
                @endif
            </span></h4>
    </li>
    @foreach($tasks as $task)
        <li class="collection-item">
            <h4><b>{{ $task->description }}</b>
                <span class="pull-right">
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
            <span class="pull-right">Priority:
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
            <span class="pull-right"><i class="material-icons"><a href={{route('editTask', $task->id)}}>mode_edit</a></i></span>
        </li>
    @endforeach
</ul>
</div>

@endsection