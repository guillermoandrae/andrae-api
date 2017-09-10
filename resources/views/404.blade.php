@extends('main')

@section('title', 'Page not found')

@section('description', 'Page not found')

@section('image', '')

@section('url', 'https://guillermoandraefisher.com')

@section('type', 'website')

@section('nav')
    <li><a href="/">Home</a></li>
@endsection

@section('content')
    <!-- Meta Header -->
    <header class="meta container text-center">
        <div class="row">
            <div class="post-source">
                <i class="fa fa-5x fa-warning"></i>
            </div>
        </div>
    </header>

    <!-- Post Section -->
    <section id="post" class="container text-center">
        <div class="row">
            <div class="section-content error col-lg-8 col-lg-offset-2">
                Welcome to Nowhere. Enjoy.
                <iframe src="https://www.youtube.com/embed/rSeS9Oh1mds" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </section>
@endsection