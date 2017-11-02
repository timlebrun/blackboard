@extends('layout.app')

@section('back-link')

    <a class="navbar-brand" href="{{ route('projects.show', $project->id) }}"><i class="fa fa-chevron-left"></i>{{ $project->name }}</a>

@endsection

@section('content')

    <h1>Nouveau Ticket</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('projects.tickets.store', $project->id) }}" method="POST">

        {{ csrf_field() }}

        <div class="form-row form-group mb-2 align-items-center">
            <div class="col-sm-9">
                <input type="text" name="title" class="form-control form-control-lg" placeholder="Titre">
            </div>
            <div class="col-sm-3">
                <select name="priority" class="form-control form-control-lg" id="">
                    <option disabled selected>Priorité</option>
                    @foreach(\App\Models\Blackboard\Ticket\Priority::all() as $priority)
                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <textarea name="content" id=""></textarea>
        <input type="hidden" name="status" value="open">
        <input type="submit" class="btn btn-primary">

    </form>

    <link rel="stylesheet" href="/css/simplemde.min.css">
    <script src="/js/simplemde.min.js"></script>

    <script>
        var simplemde = new SimpleMDE();
    </script>

@endsection