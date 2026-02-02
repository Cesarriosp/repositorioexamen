<!DOCTYPE html>
<html>
<head>
    <title>Blog - Todos los Posts</title>
</head>
<body>
    <h1>Blog de César Bra</h1>
    
    <h2>Todos los Posts</h2>
    
    @foreach($posts as $post)
        <div style="border: 1px solid black; margin: 10px; padding: 10px;">
            <h3>{{ $post->title }}</h3>
            <p>Autor: {{ $post->user->name }}</p>
            <p>Fecha: {{ $post->created_at->format('d/m/Y H:i') }}</p>
            <p>{{ Str::limit($post->content, 200) }}</p>
            <p>Comentarios: {{ $post->comments->count() }}</p>
            <a href="{{ route('posts.show', $post->id) }}">Ver post completo</a>
        </div>
    @endforeach
    
    <hr>
    <h3>Estadísticas</h3>
    <p>Total de posts: {{ $posts->count() }}</p>
    <p>Total de comentarios: {{ $posts->sum(function($post) { return $post->comments->count(); }) }}</p>
</body>
</html>
