@extends('layout.app')

@push('styles')

<link rel="stylesheet" href="/css/simplemde.min.css">

<style>

    .CodeMirror, .CodeMirror-scroll {
        min-height: 100px;
    }

    select.form-control {height: 100%;}

    div.editor-statusbar {display: none;}
    .editor-toolbar {border: none; background: #222; border-radius: 0; color: #fff;}
    .editor-toolbar a {color: inherit !important;}
    .CodeMirror {border: none; border-radius: 0;}

</style>

@endpush

@section('back-link')

    <a class="navbar-brand" href="{{ route('projects.show', $project->id) }}"><i class="fa fa-chevron-left"></i>{{ $project->name }}</a>

@endsection

@section('content')

    <div class="title d-flex justify-content-between align-items-center">
        <h1>
            {{ $ticket->title }}
            <small>
                <span class="badge badge-{{ $ticket->status->class }}">{{ $ticket->status->name }}</span>
            </small>
        </h1>
        @if($ticket->is_updatable())
            <a data-toggle="collapse" href="#update-form"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        @endif
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if($ticket->is_updatable())

        <div class="collapse" id="update-form">

            {{ Form::open(['route' => ['projects.tickets.update', $project->id, $ticket->id], 'method' => 'patch']) }}


            <textarea name="content" id="update-content"></textarea>

            <div class="form-row mt-2 mb-3">
                <div class="col">

                    @php
                        $current = $ticket->updates()->orderByDesc('created_at')->first()->status_id;
                    @endphp

                    <select name="status" id="" class="form-control">
                        @foreach(\App\Models\Blackboard\Ticket\Status::all() as $status)
                            <option value="{{ $status->id }}" {{ ($current == $status->id) ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <input type="submit" class="btn btn-primary btn-block btn-lg">
                </div>
            </div>

            {{ Form::close() }}

        </div>

    @endif


    @foreach($updates as $update)

        <article class="card update mb-2">
            <div class="card-body">
                {!!  $update->html  !!}
            </div>
            <div class="card-header text-secondary">
                <small>Posted by {{ $update->user->name }} at {{ $update->created_at }}</small>
            </div>
        </article>

    @endforeach

@endsection

@push('scripts')

<script src="/js/simplemde.min.js"></script>

<script>
    var simplemde = new SimpleMDE();

    $('select').selectpicker();
</script>

@endpush