@extends('layout.app')

@push('styles')

<link rel="stylesheet" href="/css/paper.css">

<style>
    .ticket h2 a {color:inherit;}
</style>

@endpush

@section('back-link')

    <a class="navbar-brand" href="{{ route('projects.index') }}"><i class="fa fa-chevron-left"></i>Projects</a>

@endsection

@section('content')

    <div class="project">

        <img src="" alt="" style="height: 150px; width: 150px; background: #000; display: block;" class="project-thumbnail">
        <h1 class="project-title">{{ $project->name }}</h1>

        <a href="{{ route('projects.tickets.create', $project->id) }}" class="text-primary">Nouveau Ticket</a>
    </div>


        @foreach($tickets as $ticket)

            <div class="ticket card paper mb-3">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h2 style="color: #{{ $ticket->status->color }}"><a href="{{ route('projects.tickets.show', [$project->id, $ticket->id]) }}">{{ $ticket->title }}</a></h2>
                        <p class="text-muted">{{ $ticket->updates()->first()->content }}</p>
                    </div>
                    <div>
                        <span class="badge {{ is_null($ticket->status->class) ? '' : 'badge-'.$ticket->status->class }}">{{ $ticket->status->name }}</span>
                    </div>
                </div>
            </div>

        @endforeach


@endsection