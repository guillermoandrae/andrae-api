@extends('main')

@section('title', $post['title'])

@section('description', $post['description'])

@section('image', $post['image'])

@section('url', sprintf('https://guillermoandraefisher.com/%s', $post['uri']))

@section('type', 'article')

@section('nav')
    <li><a href="/">Home</a></li>
@endsection

@section('content')
    <!-- Meta Header -->
    <header class="meta container text-center">
        <div class="row">
            <div class="post-source">
                <i class="fa fa-5x fa-<?php echo $post['source']; ?>"></i>
            </div>
            <time datetime="<?php echo $post['datetime']; ?>">Posted <?php echo $post['time']; ?></time>
        </div>
    </header>

    <!-- Post Section -->
    <section id="post" class="container text-center">
        <div class="row">
            <div class="section-content <?php echo $post['source']; ?> col-lg-8 col-lg-offset-2">
                <div class="post-thumbnail"><img src="<?php echo $post['image']; ?>"></div>
                <?php echo $post['body']; ?>
            </div>
        </div>
    </section>
@endsection
