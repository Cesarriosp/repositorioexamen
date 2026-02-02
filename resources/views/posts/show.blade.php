<!DOCTYPE html>
<html>
<head>
    <title>{{ $post->title }}</title>
</head>
<body>
    <a href="{{ route('posts.index') }}">← Volver a todos los posts</a>
    
    <h1>{{ $post->title }}</h1>
    
    <p>Autor: {{ $post->user->name }}</p>
    <p>Email del autor: {{ $post->user->email }}</p>
    <p>Fecha de publicación: {{ $post->created_at->format('d/m/Y H:i') }}</p>
    
    <hr>
    
    <div>
        <p>{{ $post->content }}</p>
    </div>
    
    <hr>
    
    <h2>Comentarios ({{ $post->comments->count() }})</h2>
    
    @foreach($post->comments as $comment)
        <div style="border: 1px solid gray; margin: 10px; padding: 10px; background: #f5f5f5;">
            <p><strong>{{ $comment->user->name }}</strong> comentó:</p>
            <p>{{ $comment->content }}</p>
            <p><small>{{ $comment->created_at->format('d/m/Y H:i') }}</small></p>
        </div>
    @endforeach
    
    @if($post->comments->count() == 0)
        <p>No hay comentarios aún.</p>
    @endif
</body>
</html>
