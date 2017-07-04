@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-sm-2">
        <h4>Projets <span class="right"><a href={{route('addProject')}}>+</a></span></h4>

        <ul class="collapsible popout" data-collapsible="accordion">
            @if (count($projects) == 0)
                <div class="row">
                    <img src="images/empty.png" class="empty">
                    <h4 class="center">Aucun projet disponible actuellement</h4>
                </div>

                <div class="row">
                    <a href="{{ route('addProject') }}" class="waves-effect waves-light btn-large purple darken-4" id="addButton2"><i class="material-icons left">add</i>Ajouter un projet<i class="material-icons right">add</i></a>
                </div>
            @else
                @foreach($projects as $project)
                    <li>
                        <div class="collapsible-header"><i class="material-icons">filter_drama</i>{{$project->name}}
                        </div>
                        <div class="collapsible-body">
                            @if (count($categories[$project->id]) == 0)
                                <div class="col s12">
                                    <div class="row">
                                        <img src="images/empty.png" class="empty">
                                        <h4 class="center">Aucune catégorie disponible pour ce projet</h4>
                                    </div>

                                    <div class="row">
                                        <a href="{{ route('addCategory', $project->id) }}" class="waves-effect waves-light btn-large purple darken-4" id="addButton2"><i class="material-icons left">add</i>Ajouter une catégorie<i class="material-icons right">add</i></a>
                                    </div>
                                </div>
                            @else
                                <div class="collection">
                                    @foreach($categories[$project->id] as $category)
                                        <a href="{{url('tasks/category/'.$category->id)}}" class="collection-item purple-text text-darken-4">
                                            {{ $category->name }}

                                            {{ Form::open(['route' => ['deleteCategory', $category->id], 'method' => 'delete', 'class' => 'right']) }}
                                            <button type="submit" class="deleteBtn red-text">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            {{ Form::close() }}
                                        </a>
                                    @endforeach
                                </div>
                                <br>
                                <div class="row">
                                    <a href="{{ route('addCategory', $project->id) }}" class="btn-floating btn waves-effect waves-light right purple darken-4"><i class="material-icons">add</i></a>
                                </div>
                            @endif
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>

@endsection