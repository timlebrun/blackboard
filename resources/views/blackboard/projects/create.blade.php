@extends('layout.app')


@section('back-link')

    <a class="navbar-brand" href="{{ route('projects.index') }}"><i class="fa fa-chevron-left"></i>Projects</a>

@endsection

@section('content')

    <h1>Nouveau projet</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST">

        {{ csrf_field() }}

        <input name="name" type="text" class="form-control form-control-lg mb-1" placeholder="Nom du projet" required>
        <textarea name="description" class="form-control mb-2" id="" cols="30" placeholder="Description du projet (facultatif)"></textarea>

        <div class="form-row mb-2">
            <div class="col">
                <input name="production_url" type="text" class="form-control form-control-sm mb-1" placeholder="Url de Production">
                <input name="github_url" type="text" class="form-control form-control-sm mb-1" placeholder="Url Github">
                <input name="facebook_url" type="text" class="form-control form-control-sm" placeholder="Url Facebook">
            </div>
            <div class="col">
                <input name="development_url" type="text" class="form-control form-control-sm mb-1" placeholder="Url de développement">
                <input name="twitter_url" type="text" class="form-control form-control-sm mb-1" placeholder="Url Twitter">
                <input name="thumbnail_url" type="text" class="form-control form-control-sm" placeholder="Url Miniature">
            </div>
        </div>
        <input type="submit" value="{{ __('Create') }}" class="btn btn-primary btn-block btn-lg">
    </form>

@endsection