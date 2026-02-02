<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Mostrar todos los posts con carga ansiosa
    public function index()
    {
        $posts = Post::with(['user', 'comments.user'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('posts.index', compact('posts'));
    }

    // Mostrar un post específico con carga ansiosa
    public function show($id)
    {
        $post = Post::with(['user', 'comments.user'])
            ->findOrFail($id);
        
        return view('posts.show', compact('post'));
    }
}
