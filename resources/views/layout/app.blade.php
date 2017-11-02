<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Blackboard') | Blackboard</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">

    @stack('styles')

</head>
<body>

@section('body')

    @section('header')
        <div class="container">
            @include('layout.header')
        </div>
    @show

    <div class="container">

        @section('content')
            <h1 class="display-3">Hi</h1>
            <a href="{{ route('projects.index') }}">Projects</a>
        @show

    </div>
@show

@section('footer')

    @include('layout.footer')

@show

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>

@stack('scripts')

</body>
</html>