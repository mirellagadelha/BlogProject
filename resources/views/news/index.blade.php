@extends('layouts.app')
@section('content')
<body class="theme">
    <header class="header-blog" style="background-image: url('/images/header.png');">
        <div class="container">
            <div class="d-flex header-nav">
                <a class="nav-icon-logo" href="/news"><i class="icon ion-md-list"></i></a>
                <ul class="nav">
                    <li class="nav-item active"><a class="nav-link" href="/news">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin">Conteúdo</a></li>
                </ul>
            </div>
            <div class="header-content">
                <h1 class="header-title">Blog</h1>
                <div class="site-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            </div>
        </div>
    </header>
</body>
<div class="container">
    <div class="news-feed">
        <div class="row">
            @foreach ($news as $value)
                <div class="content-news-card col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <span class="post-card-tags">{{ $value->category }}</span>
                            <a class="blog-link" href="{{ URL::to('news/' . $value->id) }}"><h2 class="blog-post-title">{{ $value->title }}</h2></a>
                            <p class="card-text">{{ str_limit($value->body, $limit = 500, $end = '...') }}</p>
                            <a href="{{ URL::to('news/' . $value->id) }}" class="link-see-more">Continue Lendo <i class="icon ion-md-arrow-round-forward"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection