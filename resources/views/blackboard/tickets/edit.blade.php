@extends('layout.app')

@section('back-link')

    <a class="navbar-brand" href="{{ route('projects.show', $project->id) }}"><i class="fa fa-chevron-left"></i>{{ $project->name }}</a>

@endsection

@section('content')

    <h1>Modifier ticket</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ Form::model($ticket, ['route' => ['projects.tickets.update', $project->id, $ticket->id], 'method' => 'patch']) }}

        {{ Form::text('title') }}
        {{ Form::submit() }}

    {{ Form::close() }}

@endsection