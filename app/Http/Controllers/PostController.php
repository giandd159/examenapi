<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Método para obtener todos los posts
    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    // Método para crear un nuevo post
    public function store(Request $request)
    {
        // Validar la solicitud
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        // Crear un nuevo post
        $post = Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => $request->input('user_id'),
        ]);

        return response()->json($post, 201); // Devuelve el post creado con el código de estado 201
    }
}