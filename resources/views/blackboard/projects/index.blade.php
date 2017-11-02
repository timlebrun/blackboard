@extends('layout.app')

@section('title', 'Projects')

@push('styles')

<style>
    .table {background: #fff;}
</style>

@endpush

@section('content')

    <h1>My Projects</h1>

    <table class="table">
        <tbody>
        @foreach($projects as $project)

            <tr>
                <th scope="row">
                    <a href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a>
                </th>
                <td>{{ $project->tickets()->count() }}</td>
            </tr>

        @endforeach
        </tbody>
    </table>

    <div class="text-center">
        <a href="{{ route('projects.create') }}" class="text-primary">Add Project</a>
    </div>


@endsection