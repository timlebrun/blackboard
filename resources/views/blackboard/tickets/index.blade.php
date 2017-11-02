@extends('layout.app')

@push('styles')

    <link rel="stylesheet" href="/css/paper.css">

@endpush


@section('back-link')

    <a class="navbar-brand" href="{{ route('projects.show', $project->id) }}"><i class="fa fa-chevron-left"></i>{{ $project->name }}</a>

@endsection

@section('content')

    <h1>Recherche</h1>

    <form action=""></form>

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

    {{ $tickets->links() }}

@endsection