@extends('layout.app')

@push('styles')

<style>
    nav.navbar {top: -3em;}
    .jumbotron {padding-top: 3em;}
</style>

@endpush

@section('body')

    <div class="jumbotron bg-primary text-white text-light">
        <div class="container">

            @include('layout.header')


            <h1 class="display-3 mb-0">Ticketing</h1>
            <p class="lead">Stuff to manage your things</p>
        </div>
    </div>

    <div class="container">

        <p>This is just a simple script to manage countless projects with tickets for clients and so...</p>

    </div>

@endsection